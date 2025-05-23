<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DokumenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $dokumen = DB::table('dokumen')
            ->join('inovasi', 'dokumen.id_inovasi', '=', 'inovasi.id')
            ->select('dokumen.*', 'inovasi.nama as nama_inovasi')
            ->orderBy('dokumen.id', 'DESC')
            ->get();

        return view('admin.dokumen.index', ['dokumen' => $dokumen]);
    }

    public function add()
{
    // Ambil data inovasi dari database
    $inovasiAll = DB::table('inovasi')->orderBy('id', 'DESC')->get();

    // Kirim data ke view
    return view('admin.dokumen.tambah', [
        'inovasiAll' => $inovasiAll,
        'dokumen' => null
    ]);
}

    public function create(Request $request)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'id_inovasi' => 'required|integer',
            'unggah_file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
            'tanggal_upload' => 'required|date',
            'created_at' => now(),   
        ]);

        if ($request->hasFile('unggah_file')) {
            $file = $request->file('unggah_file');
            $filename = time() . '_' . $file->getClientOriginalName();

            $uploadPath = public_path('uploads/dokumen');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);

            DB::table('dokumen')->insert([
                'nama_file' => $request->nama_file,
                'id_inovasi' => $request->id_inovasi,
                'unggah_file' => $filename,
                'tanggal_upload' => $request->tanggal_upload,
                'created_at' => now(),   
            ]);

            return redirect('/admin/dokumen')->with('success', 'Data berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah file!');
    }

    public function edit($id)
    {
        $dokumen = DB::table('dokumen')->where('id', $id)->first();
        $inovasiAll = DB::table('inovasi')->orderBy('id', 'DESC')->get();

        return view('admin.dokumen.edit', [
            'dokumen' => $dokumen,
            'inovasiAll' => $inovasiAll
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'id_inovasi' => 'required|integer',
            'tanggal_upload' => 'required|date',
            'unggah_file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
            'updated_at' => now(),
        ]);

        $dokumen = DB::table('dokumen')->where('id', $id)->first();

        if (!$dokumen) {
            return redirect('/admin/dokumen')->with('error', 'Data tidak ditemukan!');
        }

        $filename = $dokumen->unggah_file;

        if ($request->hasFile('unggah_file')) {
            $oldPath = public_path('uploads/dokumen/' . $filename);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $file = $request->file('unggah_file');
            $filename = time() . '_' . $file->getClientOriginalName();

            $uploadPath = public_path('uploads/dokumen');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);
        }

        DB::table('dokumen')->where('id', $id)->update([
            'nama_file' => $request->nama_file,
            'id_inovasi' => $request->id_inovasi,
            'unggah_file' => $filename,
            'tanggal_upload' => $request->tanggal_upload,
            'updated_at' => now(),  
        ]);

        return redirect('/admin/dokumen')->with('success', 'Data berhasil diupdate!');
    }

    public function delete($id)
    {
        $dokumen = DB::table('dokumen')->where('id', $id)->first();

        if (!$dokumen) {
            return redirect('/admin/dokumen')->with('error', 'Data tidak ditemukan!');
        }

        $filePath = public_path('uploads/dokumen/' . $dokumen->unggah_file);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        DB::table('dokumen')->where('id', $id)->delete();

        return redirect('/admin/dokumen')->with('success', 'Data berhasil dihapus!');
    }
}

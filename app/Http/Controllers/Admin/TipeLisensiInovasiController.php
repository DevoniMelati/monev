<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipeLisensiInovasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $tipelisensiinovasi = DB::table('tipe_lisensi_inovasi')
        ->join('jenis_inovasi', 'tipe_lisensi_inovasi.id_jenis_inovasi', '=', 'jenis_inovasi.id')
        ->select('tipe_lisensi_inovasi.*', 'jenis_inovasi.nama as jenis_inovasi')
        ->orderBy('tipe_lisensi_inovasi.id', 'DESC')
        ->get();

    return view('admin.tipe_lisensi_inovasi.index', [
        'tipe_lisensi_inovasi' => $tipelisensiinovasi
    ]);

    }

    public function add()
    {
        $jenisinovasi = DB::table('jenis_inovasi')->orderBy('id', 'DESC')->get();
        return view('admin.tipe_lisensi_inovasi.tambah', [
            'jenis_inovasi' => $jenisinovasi
        ]);
    }

    public function create(Request $request)
    {
        DB::table('tipe_lisensi_inovasi')->insert([
            'nama' => $request->nama,
            'id_jenis_inovasi' => $request->id_jenis_inovasi
        ]);

        return redirect('/admin/tipe_lisensi_inovasi')->with("success", "Data Berhasil Ditambah !");
    }

    public function detail($id)
    {
        $tipelisensiinovasi = DB::table('tipe_lisensi_inovasi')->where('id', $id)->first();
        return view('admin.tipe_lisensi_inovasi.detail', [
            'tipe_lisensi_inovasi' => $tipelisensiinovasi
        ]);
    }

    public function edit($id)
    {
        $tipelisensiinovasi = DB::table('tipe_lisensi_inovasi')->where('id', $id)->first();
        $jenis_inovasiSelect = DB::table('jenis_inovasi')->find($tipelisensiinovasi->id_jenis_inovasi);
        $jenisinovasiAll = DB::table('jenis_inovasi')
            ->where('id', '!=', $jenis_inovasiSelect->id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.tipe_lisensi_inovasi.edit', [
            'tipe_lisensi_inovasi' => $tipelisensiinovasi,
            'jenis_inovasiSelect' => $jenis_inovasiSelect,
            'jenisinovasiAll' => $jenisinovasiAll
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::table('tipe_lisensi_inovasi')
            ->where('id', $id)
            ->update([
                'nama' => $request->nama,
                'id_jenis_inovasi' => $request->id_jenis_inovasi
            ]);

        return redirect('/admin/tipe_lisensi_inovasi')->with("success", "Data Berhasil Diupdate !");
    }

    public function delete($id)
    {
        DB::table('tipe_lisensi_inovasi')->where('id', $id)->delete();
        return redirect('/admin/tipe_lisensi_inovasi')->with("success", "Data Berhasil Dihapus !");
    }
}

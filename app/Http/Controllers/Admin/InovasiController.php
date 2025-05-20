<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;

class InovasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $inovasi = DB::table('inovasi')
            ->leftJoin('tipe_lisensi_inovasi', 'inovasi.id_tipe_lisensi_inovasi', '=', 'tipe_lisensi_inovasi.id')
            ->leftJoin('jenis_inovasi', 'inovasi.id_jenis_inovasi', '=', 'jenis_inovasi.id')
            ->select(
                'inovasi.*',
                'tipe_lisensi_inovasi.nama as tipe',
                'jenis_inovasi.nama as jenis'
            )
            ->orderBy('inovasi.id', 'DESC')
            ->get();

        return view('admin.inovasi.index', ['inovasi' => $inovasi]);
    }

    public function add()
    {
        $status = DB::table('users')->where('level', '2')->orderBy('name')->get();
    $url = DB::table('users')->where('level', '3')->orderBy('name')->get();

    // Urutkan berdasarkan ID agar struktur ID sejajar saat ditampilkan
    $tipe_lisensi_inovasi = DB::table('tipe_lisensi_inovasi')->orderBy('id', 'ASC')->get();
    $jenis_inovasi = DB::table('jenis_inovasi')->orderBy('id', 'ASC')->get();

    return view('admin.inovasi.tambah', [
        'url' => $url,
        'status' => $status,
        'tipe_lisensi_inovasi' => $tipe_lisensi_inovasi,
        'jenis_inovasi' => $jenis_inovasi,
    ]);
    }

    public function create(Request $request)
    {
        DB::table('inovasi')->insert([
            'nama' => $request->nama,
            'uraian_inovasi' => $request->uraian,
            'basis_inovasi' => $request->basis,
            'id_tipe_lisensi_inovasi' => $request->id_tipe_lisensi_inovasi,
            'id_jenis_inovasi' => $request->id_jenis_inovasi,
            'unit_pengembang' => $request->unit,
            'unit_operasional_teknologi' => $request->unit_operasional,
            'url' => $request->url,
            'status' => $request->status,
        ]);

        return redirect('/admin/inovasi')->with("success", "Data Berhasil Ditambah!");
    }

    public function edit($id)
    {
        $inovasi = DB::table('inovasi')->where('id', $id)->first();
        $tipe_lisensi_inovasi = DB::table('tipe_lisensi_inovasi')->get();
        $jenis_inovasi = DB::table('jenis_inovasi')->get();
        return view('admin.inovasi.edit', compact('inovasi', 'tipe_lisensi_inovasi', 'jenis_inovasi'));
    }

    public function update(Request $request, $id)
    {
        DB::table('inovasi')
            ->where('id', $id)
            ->update([
                'nama' => $request->nama,
                'url' => $request->url,
                'uraian_inovasi' => $request->uraian,
                'basis_inovasi' => $request->basis,
                'id_tipe_lisensi_inovasi' => $request->id_tipe_lisensi_inovasi,
                'id_jenis_inovasi' => $request->id_jenis_inovasi,
                'unit_pengembang' => $request->unit,
                'unit_operasional_teknologi' => $request->unit_operasional,
                'status' => $request->status,
            ]);

        return redirect('/admin/inovasi')->with("success", "Data Berhasil Diupdate!");
    }

    public function delete($id)
    {
        DB::table('inovasi')->where('id', $id)->delete();

        return redirect('/admin/inovasi')->with("success", "Data Berhasil Dihapus!");
    }
}

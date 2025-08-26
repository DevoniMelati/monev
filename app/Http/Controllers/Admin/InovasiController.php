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
            ->leftJoin('opd', 'inovasi.id_opd', '=', 'opd.id')
            ->leftJoin('unit_pengembang', 'inovasi.id_unit_pengembang', '=', 'unit_pengembang.id')
            ->select(
                'inovasi.*',
                'tipe_lisensi_inovasi.nama as tipe_lisensi_inovasi',
                'jenis_inovasi.nama as jenis_inovasi',
                'opd.nama as opd',
                'unit_pengembang.nama as unit_pengembang'
            )
            ->orderBy('inovasi.id', 'DESC')
            ->get();
        return view('admin.inovasi.index', ['inovasi' => $inovasi]);
    }

    public function add()
    {
        $status = DB::table('users')->where('level', '2')->orderBy('name')->get();
        $url = DB::table('users')->where('level', '3')->orderBy('name')->get();
        $tipe_lisensi_inovasi = DB::table('tipe_lisensi_inovasi')->orderBy('id', 'ASC')->get();
        $jenis_inovasi = DB::table('jenis_inovasi')->orderBy('id', 'ASC')->get();
        $opd = DB::table('opd')->orderBy('id', 'ASC')->get();
        $unit_pengembang = DB::table('unit_pengembang')->orderBy('id', 'ASC')->get();


    return view('admin.inovasi.tambah', [
        'url' => $url,
        'status' => $status,
        'tipe_lisensi_inovasi' => $tipe_lisensi_inovasi,
        'jenis_inovasi' => $jenis_inovasi,
        'opd' => $opd, 
        'unit_pengembang' => $unit_pengembang,

    ]);
    }

    public function create(Request $request)
    {
       DB::table('inovasi')->insert([
        'nama' => $request->nama,
        'url' => $request->url,
        'uraian_inovasi' => $request->uraian,
        'basis_inovasi' => $request->basis,
        'id_tipe_lisensi_inovasi' => $request->id_tipe_lisensi_inovasi,
        'id_jenis_inovasi' => $request->id_jenis_inovasi,
        'id_unit_pengembang' => $request->id_unit_pengembang,
        'id_opd' => $request->id_opd,
        'status' => $request->status,
        'created_at' => now(),   
    ]);

        return redirect('/admin/inovasi')->with("success", "Data Berhasil Ditambah!");
    }

    public function edit($id)
    {
       $inovasi = DB::table('inovasi')->where('id', $id)->first();
       $tipe_lisensi_inovasi = DB::table('tipe_lisensi_inovasi')->get();
       $jenis_inovasi = DB::table('jenis_inovasi')->get();
       $opd = DB::table('opd')->get();
       $unit_pengembang = DB::table('unit_pengembang')->orderBy('id', 'ASC')->get();

    return view('admin.inovasi.edit', [
        'inovasi' => $inovasi,
        'tipe_lisensi_inovasi' => $tipe_lisensi_inovasi,
        'jenis_inovasi' => $jenis_inovasi,
        'opd' => $opd,
        'unit_pengembang' => $unit_pengembang

    ]);
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
            'id_unit_pengembang' => $request->id_unit_pengembang,
            'id_opd' => $request->id_opd,
            'status' => $request->status,
            'updated_at' => now(),   
        ]);

        return redirect('/admin/inovasi')->with("success", "Data Berhasil Diupdate!");
    }

    public function delete($id)
    {
        DB::table('inovasi')->where('id', $id)->delete();

        return redirect('/admin/inovasi')->with("success", "Data Berhasil Dihapus!");
    }
    public function statusToggle($id)
    {
        $inovasi = DB::table('inovasi')->where('id', $id)->first();

        if (!$inovasi) {
            return redirect('/admin/inovasi')->with('error', 'Data tidak ditemukan!');
        }

        $newStatus = strtolower($inovasi->status) === 'aktif' ? 'Tidak Aktif' : 'Aktif';

        DB::table('inovasi')->where('id', $id)->update([
            'status' => $newStatus,
            'updated_at' => now()
        ]);

        return redirect('/admin/inovasi')->with('success', 'Status berhasil diperbarui!');
    }
}




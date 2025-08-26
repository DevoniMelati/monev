<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $monitoring = DB::table('monitoring')
            ->join('inovasi', 'monitoring.id_inovasi', '=', 'inovasi.id')
            ->select('monitoring.*', 'inovasi.nama as nama_inovasi')
            ->orderBy('monitoring.id', 'DESC')
            ->get();

        return view('admin.monitoring.index', ['monitoring' => $monitoring]);
    }

    public function add()
    {
        $inovasiAll = DB::table('inovasi')->orderBy('id', 'DESC')->get();

        return view('admin.monitoring.tambah', [
            'inovasiAll' => $inovasiAll,
            'monitoring' => null
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'tanggal_monitoring' => 'required|date',
            'id_inovasi' => 'required|integer',
            'keterangan' => 'required|string|max:255',
            'nilai_monitoring' => 'required|string|max:255',
            'status' => 'required|string|max:50',
        ]);

        DB::table('monitoring')->insert([
            'tanggal_monitoring' => $request->tanggal_monitoring,
            'id_inovasi' => $request->id_inovasi,
            'keterangan' => $request->keterangan,
            'nilai_monitoring' => $request->nilai_monitoring,
            'status' => $request->status,
            'created_at' => now()
        ]);

        return redirect('/admin/monitoring')->with('success', 'Data monitoring berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $monitoring = DB::table('monitoring')->where('id', $id)->first();
        $inovasiAll = DB::table('inovasi')->orderBy('id', 'DESC')->get();

        return view('admin.monitoring.edit', [
            'monitoring' => $monitoring,
            'inovasiAll' => $inovasiAll
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_monitoring' => 'required|date',
            'id_inovasi' => 'required|integer',
            'keterangan' => 'required|string|max:255',
             'nilai_monitoring' => 'required|string|max:255',
            'status' => 'required|string|max:50',
        ]);

        DB::table('monitoring')->where('id', $id)->update([
            'tanggal_monitoring' => $request->tanggal_monitoring,
            'id_inovasi' => $request->id_inovasi,
            'keterangan' => $request->keterangan,
            'nilai_monitoring' => $request->nilai_monitoring,
            'status' => $request->status,
            'updated_at' => now()
        ]);

        return redirect('/admin/monitoring')->with('success', 'Data monitoring berhasil diperbarui!');
    }

    public function delete($id)
    {
        $monitoring = DB::table('monitoring')->where('id', $id)->first();

        if (!$monitoring) {
            return redirect('/admin/monitoring')->with('error', 'Data tidak ditemukan!');
        }

        DB::table('monitoring')->where('id', $id)->delete();

        return redirect('/admin/monitoring')->with('success', 'Data monitoring berhasil dihapus!');
    }
}

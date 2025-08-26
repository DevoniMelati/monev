<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf; // Tambahan untuk cetak PDF

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read()
    {
        $laporan = DB::table('laporan')
            ->join('inovasi', 'laporan.id_inovasi', '=', 'inovasi.id')
            ->join('opd', 'laporan.id_opd', '=', 'opd.id')
            ->select(
                'laporan.*',
                'inovasi.nama as nama_inovasi',
                'opd.nama as nama_opd'
            )
            ->orderBy('laporan.id', 'ASC')
            ->get();

        return view('admin.laporan.index', ['laporan' => $laporan]);
    }

    public function add()
    {
        $inovasi = DB::table('inovasi')->get();
        $opd = DB::table('opd')->get();

        return view('admin.laporan.tambah', [
            'inovasi' => $inovasi,
            'opd' => $opd,
        ]);
    }

    public function create(Request $request)
{
    $request->validate([
        'id_inovasi' => 'required|integer',
        'id_opd' => 'required|integer',
        'periode_tahun' => 'required|integer',
        'status_laporan' => 'required|string|max:255',
        'nilai_monitoring' => 'required|string|max:255',
        'nilai_evaluasi' => 'required|string|max:255',
        'kesimpulan' => 'required|string',
        'tanggal_upload' => 'required|date',
    ]);

    // Simpan data dulu
    DB::table('laporan')->insert([
        'id_inovasi' => $request->id_inovasi,
        'id_opd' => $request->id_opd,
        'periode_tahun' => $request->periode_tahun,
        'status_laporan' => $request->status_laporan,
        'nilai_monitoring' => $request->nilai_monitoring,
        'nilai_evaluasi' => $request->nilai_evaluasi,
        'kesimpulan' => $request->kesimpulan,
        'tanggal_upload' => $request->tanggal_upload,
        'created_at' => now(),
    ]);

    return redirect('/admin/laporan')->with("success", "Data Laporan Berhasil Ditambahkan!");
}


    public function edit($id)
    {
        $laporan = DB::table('laporan')->where('id', $id)->first();
        $inovasi = DB::table('inovasi')->get();
        $opd = DB::table('opd')->get();

        return view('admin.laporan.edit', [
            'laporan' => $laporan,
            'inovasi' => $inovasi,
            'opd' => $opd,
        ]);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'id_inovasi' => 'required|integer',
        'id_opd' => 'required|integer',
        'periode_tahun' => 'required|integer',
        'status_laporan' => 'required|string|max:255',
        'nilai_monitoring' => 'required|string|max:255',
        'nilai_evaluasi' => 'required|string|max:255',
        'kesimpulan' => 'required|string',
        'tanggal_upload' => 'required|date',
    ]);

    // Update data dulu
    DB::table('laporan')->where('id', $id)->update([
        'id_inovasi' => $request->id_inovasi,
        'id_opd' => $request->id_opd,
        'periode_tahun' => $request->periode_tahun,
        'status_laporan' => $request->status_laporan,
        'nilai_monitoring' => $request->nilai_monitoring,
        'nilai_evaluasi' => $request->nilai_evaluasi,
        'kesimpulan' => $request->kesimpulan,
        'tanggal_upload' => $request->tanggal_upload,
        'updated_at' => now(),
    ]);

    return redirect()->route('admin.laporan.read')->with('success', 'Data berhasil diupdate');
}


    public function cetak()
    {
        $laporan = DB::table('laporan')
            ->join('inovasi', 'laporan.id_inovasi', '=', 'inovasi.id')
            ->join('opd', 'laporan.id_opd', '=', 'opd.id')
            ->select('laporan.*', 'inovasi.nama as nama_inovasi', 'opd.nama as nama_opd')
            ->get();

        $pdf = Pdf::loadView('admin.laporan.cetak', compact('laporan'));
        return $pdf->download('laporan.pdf');
    }
 public function delete($id)
    {
        DB::table('laporan')->where('id', $id)->delete();

        return redirect('/admin/laporan')->with("success", "Data Berhasil Dihapus !");
    }

}

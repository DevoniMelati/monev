@extends('admin.layouts.app', [
    'activePage' => 'laporan',
])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Tambah Data Laporan</h4>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                        <li class="breadcrumb-item"><a href="/admin/laporan">Data Laporan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Data Laporan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-2">
            <div class="pull-left">
                <h2 class="text-primary h2"><i class="icon-copy dw dw-add"></i>  Tambah Data Laporan</h2>
            </div>
            <div class="float-right">
                <a href="/admin/laporan" class="btn btn-sm btn-primary">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <hr>

        <form action="/admin/laporan/create" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Nama Inovasi</label>
                    <select name="id_inovasi" class="form-control" required>
                        <option value="">-- Pilih Inovasi --</option>
                        @foreach($inovasi as $data)
                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Nama OPD</label>
                    <select name="id_opd" class="form-control" required>
                        <option value="">-- Pilih OPD --</option>
                        @foreach($opd as $data)
                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Periode Tahun</label>
                    <input type="number" name="periode_tahun" required class="form-control" min="2000" max="2100"
                        value="{{ old('periode_tahun') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tanggal Upload</label>
                    <input type="date" name="tanggal_upload" required class="form-control"
                        value="{{ old('tanggal_upload') }}">
                </div>


                <div class="col-md-6 mb-3">
                    <label>Nilai Monitoring</label>
                    <input type="text" name="nilai_monitoring" required class="form-control"
                        placeholder="Masukkan nilai monitoring" value="{{ old('nilai_monitoring') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Nilai Evaluasi</label>
                    <input type="text" name="nilai_evaluasi" required class="form-control"
                        placeholder="Masukkan nilai evaluasi" value="{{ old('nilai_evaluasi') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Kesimpulan</label>
                    <input type="text" name="kesimpulan" required class="form-control"
                        placeholder="Masukkan kesimpulan" value="{{ old('kesimpulan') }}">
                </div>


                <div class="col-md-6 mb-3">
                    <label>Status Laporan</label>
                    <select name="status_laporan" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Selesai" {{ old('status_laporan') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Dalam Proses" {{ old('status_laporan') == 'Dalam_Proses' ? 'selected' : '' }}>Dalam Proses</option>
                        <option value="Pending" {{ old('status_laporan') == 'Pending' ? 'selected' : '' }}>Pending</option>
                       
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="ti-save"></i> Tambah Data
            </button>
        </form>
    </div>
</div>
@endsection

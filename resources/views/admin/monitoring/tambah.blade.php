@extends('admin.layouts.app', [
    'activePage' => 'dokumen',
])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Tambah Data Monitoring</h4>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                        <li class="breadcrumb-item"><a href="/admin/dokumen">Data Monitoring</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Data Monitoring</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-3">
            <div class="pull-left">
                <h5 class="text-primary"><i class="icon-copy dw dw-add"></i> Tambah Data Monitoring</h5>
            </div>
            <div class="float-right">
                <a href="/admin/dokumen" class="btn btn-sm btn-primary">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <hr>

        <form action="{{ route('admin.monitoring.create') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                   <label>Tanggal Monitoring</label>
                    <input type="date" name="tanggal_monitoring" required class="form-control" value="{{ old('tanggal_monitoring') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Nama Inovasi</label>
                    <select name="id_inovasi" class="form-control" required>
                        <option value="">-- Pilih Inovasi --</option>
                        @foreach($inovasiAll as $data)
                            <option value="{{ $data->id }}" {{ old('id_inovasi') == $data->id ? 'selected' : '' }}>
                                {{ $data->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" required class="form-control" value="{{ old('keterangan') }}" placeholder="Masukkan Keterangan">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Nilai Monitoring</label>
                    <input type="text" name="nilai_monitoring" required class="form-control" value="{{ old('nilai_monitoring') }}" placeholder="Masukkan Nilai Monitoring">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        <option value="Maintanance" {{ old('status') == 'Maintanance' ? 'selected' : '' }}>Maintanance</option>
                        <option value="Rusak" {{ old('status') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                        <option value="Suspend" {{ old('status') == 'Suspend' ? 'selected' : '' }}>Suspend</option>
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


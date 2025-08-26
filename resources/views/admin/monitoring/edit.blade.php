@extends('admin.layouts.app', [
    'activePage' => 'monitoring',
])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Edit Data Monitoring</h4>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                        <li class="breadcrumb-item"><a href="/admin/monitoring"> Data Monitoring</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Data Monitoring</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-2">
            <div class="pull-left">
                <h2 class="text-primary h2"><i class="icon-copy dw dw-edit2"></i> Edit Data Monitoring</h2>
            </div>
            <div class="float-right">
                <a href="/admin/monitoring" class="btn btn-sm btn-primary">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <hr>

        <form action="/admin/monitoring/update/{{ $monitoring->id }}" method="POST">
            @csrf
           <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Tanggal Monitoring</label>
                    <input type="date" name="tanggal_monitoring" required class="form-control"
                        value="{{ old('tanggal_monitoring', $monitoring->tanggal_monitoring) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Nama Inovasi</label>
                    <select name="id_inovasi" class="form-control" required>
                        <option value="">-- Pilih Inovasi --</option>
                        @foreach($inovasiAll as $inovasi)
                            <option value="{{ $inovasi->id }}" {{ $monitoring->id_inovasi == $inovasi->id ? 'selected' : '' }}>
                                {{ $inovasi->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

               <div class="col-md-6 mb-3">
                <label>Keterangan</label>
                <input type="text" name="keterangan" class="form-control" required value="{{ old('keterangan', $monitoring->keterangan ?? '') }}">
            </div>

             <div class="col-md-6 mb-3">
                <label>Nilai Monitoring</label>
                <input type="text" name="nilai_monitoring" class="form-control" required value="{{ old('nilai_monitoring', $monitoring->nilai_monitoring ?? '') }}">
            </div>

                <div class="col-md-6 mb-3">
                   <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                 <option value="aktif" {{ $monitoring->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                 <option value="tidak aktif" {{ $monitoring->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                 <option value="maintanance" {{ $monitoring->status == 'maintanance' ? 'selected' : '' }}>Maintanance</option>
                 <option value="rusak" {{ $monitoring->status == 'rusak' ? 'selected' : '' }}>Rusak</option>
                </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="ti-save"></i> Update Data
            </button>
        </form>
    </div>
</div>
@endsection

@extends('admin.layouts.app', [
    'activePage' => 'dokumen',
])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Tambah Data Dokumen</h4>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                        <li class="breadcrumb-item"><a href="/admin/dokumen">Data Dokumen</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Data Dokumen</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-2">
            <div class="pull-left">
                <h2 class="text-primary h2"><i class="icon-copy dw dw-add"></i> Tambah Data Dokumen</h2>
            </div>
            <div class="float-right">
                <a href="/admin/dokumen" class="btn btn-sm btn-primary">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <hr>

       <form action="/admin/dokumen/update/{{ $dokumen->id }}" method="POST" enctype="multipart/form-data">
            @csrf
           <div class="row mb-3">
                <div class="col-md-6">
                <label>Nama File</label>
                <input type="text" name="nama_file" class="form-control" required value="{{ old('nama_file', $dokumen->nama_file ?? '') }}">
            </div>
                <div class="col-md-6 mb-3">
                <label>Unggah File </label>
                <input type="file" name="unggah_file" class="form-control">
                 @if(!empty($dokumen->unggah_file))
             <small class="form-text text-muted">File sebelumnya: <strong>{{ $dokumen->unggah_file }}</strong></small>
             @endif
            </div>
                <div class="col-md-6 mb-3">
                    <label>Tanggal Upload</label>
                    <input type="date" name="tanggal_upload" required class="form-control"
                        value="{{ old('tanggal_upload', $dokumen->tanggal_upload) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Nama Inovasi</label>
                    <select name="id_inovasi" class="form-control" required>
                <option value="">-- Pilih Inovasi --</option>
                 @foreach($inovasiAll as $inovasi)
                <option value="{{ $inovasi->id }}" {{ $dokumen->id_inovasi == $inovasi->id ? 'selected' : '' }}>
                 {{ $inovasi->nama }}
                 </option>
                @endforeach
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

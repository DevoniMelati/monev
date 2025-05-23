@extends('admin.layouts.app', ['activePage' => 'inovasi'])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Data Inovasi</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                        <li class="breadcrumb-item"><a href="/admin/inovasi">Data Inovasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Data Inovasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-primary h2"><i class="icon-copy dw dw-edit2"></i> Edit Data Inovasi</h2>
            <a href="/admin/inovasi" class="btn btn-primary btn-sm">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>

        <form action="/admin/inovasi/update/{{ $inovasi->id }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Nama Inovasi</label>
                    <input type="text" name="nama" class="form-control" required value="{{ $inovasi->nama }}">
                </div>
                <div class="col-md-6">
                    <label>URL</label>
                    <input type="text" name="url" class="form-control" required value="{{ $inovasi->url }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Uraian Inovasi</label>
                    <input type="text" name="uraian" class="form-control" required value="{{ $inovasi->uraian_inovasi }}">
                </div>
                <div class="col-md-6">
                    <label>Basis Inovasi</label>
                    <input type="text" name="basis" class="form-control" required value="{{ $inovasi->basis_inovasi }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Tipe Lisensi Inovasi</label>
                    <select class="form-control" name="id_tipe_lisensi_inovasi" required>
                        <option value="">-- Pilih Tipe Lisensi --</option>
                        @foreach($tipe_lisensi_inovasi as $item)
                            <option value="{{ $item->id }}" {{ $inovasi->id_tipe_lisensi_inovasi == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Jenis Inovasi</label>
                    <select class="form-control" name="id_jenis_inovasi" required>
                        <option value="">-- Pilih Jenis Inovasi --</option>
                        @foreach($jenis_inovasi as $item)
                            <option value="{{ $item->id }}" {{ $inovasi->id_jenis_inovasi == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Unit pengembang</label>
                    <select class="form-control" name="id_unit_pengembang" required>
                        <option value="">-- Pilih Unit Pengembang --</option>
                        @foreach($unit_pengembang as $item)
                            <option value="{{ $item->id }}" {{ $inovasi->id_unit_pengembang == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>OPD</label>
                    <select name="id_opd" class="form-control" required>
                        <option value="">-- Pilih OPD --</option>
                        @foreach($opd as $item)
                            <option value="{{ $item->id }}" {{ $inovasi->id_opd == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Aktif" {{ $inovasi->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ $inovasi->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Data</button>
        </form>
    </div>
</div>
@endsection

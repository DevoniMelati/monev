@extends('admin.layouts.app', [
    'activePage' => 'tipe_lisensi_inovasi',
])
@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Data Tipe Lisensi Inovasi</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                        <li class="breadcrumb-item"><a href="/admin/tipe_lisensi_inovasi">Data Tipe Lisensi Inovasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Data Tipe Lisensi Inovasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-2">
            <div class="pull-left">
                <h2 class="text-primary h2"><i class="icon-copy dw dw-add-file-1"></i> Tambah Data Tipe Lisensi Inovasi</h2>
            </div>
            <div class="float-right">
                <a href="/admin/tipe_lisensi_inovasi" class="btn btn-primary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <hr style="margin-top: 0px">

        <form action="/admin/tipe_lisensi_inovasi/create" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6 mb-3">
                    <label>Nama Tipe Lisensi Inovasi</label>
                    <input type="text" name="nama" autofocus required class="form-control" placeholder="Masukkan Nama Tipe Lisensi Inovasi .....">

                    <!-- Tombol di bawah input nama -->
                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="icon-copy ti-save"></i> Tambah Data
                    </button>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Jenis Inovasi</label>
                        <select class="form-control" name="id_jenis_inovasi" required>
                            <option value="">-- Pilih Jenis Inovasi --</option>
                            @foreach($jenis_inovasi as $data)
                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                            @endforeach
                        </select> 
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Tambahkan margin bawah untuk memberi jarak dari footer -->
    <div style="margin-bottom: 25px;"></div>
</div>
@endsection

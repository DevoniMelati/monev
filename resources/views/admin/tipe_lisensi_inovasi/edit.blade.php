@extends('admin.layouts.app', [
    'activePage' => 'tipe_lisensi_inovasi',
])
@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Data Tipe Lisensi Inovasi</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                        <li class="breadcrumb-item"><a href="/admin/tipe_lisensi_inovasi">Data Tipe Lisensi Inovasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Data Tipe Lisensi Inovasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-2">
            <div class="pull-left">
                <h2 class="text-primary h2"><i class="icon-copy dw dw-edit-1"></i> Edit Data Tipe Lisensi Inovasi</h2>
            </div>
            <div class="float-right">
                <a href="/admin/tipe_lisensi_inovasi" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <hr style="margin-top: 0px">

        <form action="/admin/tipe_lisensi_inovasi/update/{{ $tipe_lisensi_inovasi->id }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <!-- Nama Tipe Lisensi Inovasi -->
                <div class="col-md-6 mb-2">
                    <label>Nama Tipe Lisensi Inovasi</label>
                    <input type="text" name="nama" value="{{ $tipe_lisensi_inovasi->nama }}" required autofocus class="form-control" placeholder="Masukkan Nama Tipe Lisensi Inovasi .....">

                    <!-- Tombol Tepat di Bawah Nama -->
                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="icon-copy ti-save"></i> Update Data
                    </button>
                </div>

                <!-- Jenis Inovasi Tetap di Kanan -->
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Jenis Inovasi</label>
                        <select class="form-control" name="id_jenis_inovasi" required>
                            <option value="{{ $jenis_inovasiSelect->id }}">{{ $jenis_inovasiSelect->nama }}</option>
                            @foreach($jenisinovasiAll as $data)
                                @if($data->id != $jenis_inovasiSelect->id)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endif
                            @endforeach
                        </select> 
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div style="margin-bottom: 25px;"></div>
</div>
@endsection

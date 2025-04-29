@extends('admin.layouts.app', ['activePage' => 'aplikasi'])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Data Aplikasi</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                        <li class="breadcrumb-item"><a href="/admin/aplikasi">Data Aplikasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Data Aplikasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Form Tambah Data Aplikasi -->
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h2 class="text-primary h2">
                    <i class="icon-copy dw dw-add-file-1"></i> Tambah Data Aplikasi
                </h2>
            </div>
            <div class="pull-right">
                <a href="/admin/aplikasi" class="btn btn-primary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <hr style="margin-top: 0px">

        <form action="/admin/aplikasi/create" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <div class="row">
                <div class="col-md-6">
                    <label>Nama Aplikasi</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Aplikasi ....." required autofocus>
                </div>
                <div class="col-md-6">
                    <label>URL</label>
                    <input type="text" name="url" class="form-control" placeholder="Masukkan URL Aplikasi ....." required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan Username ....." required>
                </div>
                <div class="col-md-6">
                    <label>Password</label>
                    <input type="text" name="password" class="form-control" placeholder="Masukkan Password ....." required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Aman">Aman</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Programmer</label>
                    <select name="programmer" class="form-control" required>
                        <option value="">-- Pilih Programmer --</option>
                        @foreach($programmer as $data)
                            <option value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
               <div class="row mt-3">
                  <div class="col-md-6">
                    <label>Penanggung Jawab</label>
                    <select name="pj" class="form-control" required>
                        <option value="">-- Pilih Penanggung Jawab --</option>
                        @foreach($pj as $data)
                            <option value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">
                <span class="icon-copy ti-save"></span> Tambah Data
            </button>
        </form>
    </div>
</div>
@endsection

@extends('admin.layouts.app', [
'activePage' => 'aplikasi',
])
@section('content')
<div class="min-height-200px">
   <div class="page-header">
      <div class="row">
         <div class="col-md-6 col-sm-12">
            <div class="title">
               <h4>Data Aplikasi</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                  <li class="breadcrumb-item"><a href="/admin/aplikasi">Data Aplikasi</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Data Aplikasi</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <div class="pd-20 card-box mb-30">
      <div class="clearfix">
         <div class="pull-left">
            <h2 class="text-primary h2"><i class="icon-copy dw dw-edit-1"></i> Edit Data Aplikasi</h2>
         </div>
         <div class="pull-right">
            <a href="/admin/aplikasi" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
         </div>
      </div>
      <hr style="margin-top: 0px">
      <form action="/admin/aplikasi/update/{{$aplikasi->id}}" method="POST" enctype="multipart/form-data">
         {{ csrf_field() }}
         <div class="row">
            <div class="col-md-6">
               <label>Nama Aplikasi</label>
               <input type="text" name="nama" required class="form-control" value="{{$aplikasi->nama}}" placeholder="Masukkan Nama Aplikasi .....">
            </div>
            <div class="col-md-6">
               <label>URL</label>
               <input type="text" name="url" required class="form-control" value="{{$aplikasi->url}}" placeholder="Masukkan URL Aplikasi .....">
            </div>
         </div>
         <div class="row mt-3">
            <div class="col-md-6">
               <label>Username</label>
               <input type="text" name="username" required class="form-control" value="{{$aplikasi->username}}" placeholder="Masukkan Username .....">
            </div>
            <div class="col-md-6">
               <label>Password</label>
               <input type="text" name="password" required class="form-control" value="{{$aplikasi->password}}" placeholder="Masukkan Password .....">
            </div>
         </div>
         <div class="row mt-3">
            <div class="col-md-6">
               <label>Status</label>
               <select name="status" class="form-control">
                  <option value="Aman" {{$aplikasi->status == 'Aman' ? 'selected' : ''}}>Aman</option>
                  <option value="Maintenance" {{$aplikasi->status == 'Maintenance' ? 'selected' : ''}}>Maintenance</option>
                  <option value="Rusak" {{$aplikasi->status == 'Rusak' ? 'selected' : ''}}>Rusak</option>
               </select>
            </div>
            <div class="col-md-6">
               <label>Programmer</label>
               <select class="form-control" name="programmer" required>
                  <option value="">-- Pilih Programmer --</option>
                  @foreach($programmer as $data)
                  <option value="{{$data->id}}" {{$aplikasi->programmer == $data->id ? 'selected' : ''}}>{{$data->name}}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="row mt-3">
            <div class="col-md-6">
               <label>Penanggung Jawab</label>
               <select class="form-control" name="pj" required>
                  <option value="">-- Pilih Penanggung Jawab --</option>
                  @foreach($pj as $data)
                  <option value="{{$data->id}}" {{$aplikasi->pj == $data->id ? 'selected' : ''}}>{{$data->name}}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <button type="submit" class="btn btn-primary mt-3"><span class="icon-copy ti-save"></span> Update Data</button>
      </form>
   </div>
</div>
@endsection

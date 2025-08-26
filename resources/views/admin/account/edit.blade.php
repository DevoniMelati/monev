@extends('admin.layouts.app', [
'activePage' => 'account',
])
@section('content')
<div class="min-height-200px">
   <div class="page-header">
      <div class="row">
         <div class="col-md-6 col-sm-12">
            <div class="title">
               <h4>Data User</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                  <li class="breadcrumb-item"><a href="/admin/account">Data User</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Data User</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <!-- Striped table start -->
   <div class="pd-20 card-box mb-30">
      <div class="clearfix">
         <div class="pull-left">
            <h2 class="text-primary h2"><i class="icon-copy dw dw-edit-1"></i> Edit Data User</h2>
         </div>
         <div class="pull-right">
            <a href="/admin/account" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
         </div>
      </div>
      <hr style="margin-top: 0px">
      <form action="/admin/account/update/{{$account->id}}" method="POST" enctype="multipart/form-data">
         {{ csrf_field() }}
         <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  <label>Nama</label>
                  <input type="text" autofocus name="name" required class="form-control" value="{{$account->name}}" placeholder="Masukkan Nama .....">
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" required class="form-control" value="{{$account->username}}" placeholder="Masukkan Username .....">
               </div>
            </div>
            <div class="col-md-4">
   <div class="form-group">
      <label>Type User</label>
      <select class="form-control" required name="level">
         <option value="">-- Pilih Type User --</option>
         <option value="1" {{ $account->level == 1 ? 'selected' : '' }}>Admin</option>
         <option value="2" {{ $account->level == 2 ? 'selected' : '' }}>Pegawai</option>
         <option value="3" {{ $account->level == 3 ? 'selected' : '' }}>Pimpinan</option>
      </select>
   </div>
</div>
         <button type="submit" class="btn btn-primary mt-1 mr-2"><span class="icon-copy ti-save"></span> Update Data</button>               
      </form>
   </div>
   <!-- Striped table End -->
</div>
@endsection
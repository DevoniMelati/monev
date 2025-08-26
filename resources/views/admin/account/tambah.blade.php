@extends('admin.layouts.app', [
'activePage' => 'Account',
])
@section('content')
<div class="min-height-200px">
   <div class="page-header">
      <div class="row">
         <div class="col-md-12 col-sm-12">
            <div class="title">
               <h4>Data User</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Data Input</a></li>
                  <li class="breadcrumb-item"><a href="/admin/account">Data User</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tambah Data User</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <!-- Striped table start -->
   <div class="pd-20 card-box mb-30">
      <div class="clearfix">
         <div class="pull-left">
            <h2 class="text-primary h2"><i class="icon-copy dw dw-add-file-1"></i> Tambah Data User</h2>
         </div>
         <div class="pull-right">
            <a href="/admin/account" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
         </div>
      </div>
      <hr style="margin-top: 0px">
      <form action="/admin/account/create" method="POST" enctype="multipart/form-data">
         {{ csrf_field() }}
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label>Nama</label>
                  <input type="text" autofocus name="name" required class="form-control" placeholder="Masukkan Nama .....">
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label>Type User</label>
                  <select class="form-control" required name="level">
                     <option value="">-- Pilih Type User --</option>
                     <option value="1">Admin</option>
                     <option value="2">Pegawai</option>
                     <option value="3">Pimpinan</option>
                  </select>
               </div>
            </div> 
            <div class="col-md-6">
               <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" required class="form-control" placeholder="Masukkan Username Account .....">
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label>PASSWORD</label>
                  <input type="text" name="password" required class="form-control" placeholder="Masukkan Password.....">
               </div>
            </div>
               <button type="submit" class="btn btn-primary mt-3">
                <span class="icon-copy ti-save"></span> Tambah Data
            </button>
        </form>
    </div>
</div>
   <!-- Striped table End -->
</div>
<script>
   function formatNumber(input) {
       // Menghapus semua karakter kecuali angka
       let value = input.value.replace(/\D/g, '');
       
       // Menambahkan format pemisah ribuan
       input.value = new Intl.NumberFormat().format(value);
   }
</script>
@endsection
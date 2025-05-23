@extends('admin.layouts.app', [
    'activePage' => 'opd',
])
@section('content')
<div class="min-height-200px">
   <div class="page-header">
      <div class="row">
         <div class="col-md-12 col-sm-12">
            <div class="title">
               <h4>Data OPD</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                  <li class="breadcrumb-item"><a href="/admin/opd">Data OPD</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tambah Data OPD</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>

   <!-- Form Start -->
   <div class="pd-20 card-box mb-5 shadow-sm bg-white rounded">
      <div class="clearfix mb-3">
         <div class="float-left">
            <h4 class="text-primary"><i class="icon-copy dw dw-add-file-1"></i> Tambah Data OPD</h4>
         </div>
         <div class="float-right">
            <a href="/admin/opd" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
         </div>
      </div>
      <hr>

      <form action="/admin/opd/create" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
         <div class="row">
            <div class="col-md-6 mb-3">
               <label>Nama OPD</label>
               <input type="text" name="nama" required autofocus class="form-control" placeholder="Masukkan Nama OPD .....">
            </div>
            <div class="col-md-6 mb-3">
               <label>Kontak</label>
               <input type="text" name="kontak" required class="form-control" placeholder="Masukkan Kontak .....">
            </div>
          <div class="col-md-6 mb-3">
               <label>Alamat</label>
               <input type="text" name="alamat" required class="form-control" placeholder="Masukkan Alamat .....">
            </div>
            <div class="col-md-6 mb-3">
               <label>Koordinat</label>
               <input type="text" name="koordinat" required class="form-control" placeholder="Masukkan Koordinat .....">
            </div>
         <div class="col-md-6">
        <button type="submit" class="btn btn-primary mt-1">
            <i class="icon-copy ti-save"></i> Tambah Data
        </button>
    </div>
</form>
   </div>
   <!-- Form End -->
</div>

<!-- Tambahkan margin bawah untuk memberi jarak dari footer -->
<div style="margin-bottom: 25px;"></div>
@endsection


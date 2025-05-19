@extends('admin.layouts.app', [
'activePage' => 'opd',
])
@section('content')
<div class="min-height-200px">
   <div class="page-header">
      <div class="row">
         <div class="col-md-6 col-sm-12">
            <div class="title">
               <h4>Data OPD</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                  <li class="breadcrumb-item"><a href="/admin/opd">Data OPD</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Data OPD</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <!-- Striped table start -->
   <div class="pd-20 card-box mb-30">
      <div class="clearfix">
         <div class="pull-left">
            <h2 class="text-primary h2"><i class="icon-copy dw dw-edit-1"></i> Edit Data OPD</h2>
         </div>
         <div class="float-right">
            <a href="/admin/opd" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
         </div>
      </div>
      <hr style="margin-top: 0px">
      <form action="/admin/opd/update/{{$opd->id}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Nama OPD</label>
            <input type="text" name="nama" required autofocus class="form-control" 
                   placeholder="Masukkan Nama OPD ....."
                   value="{{ old('nama', $opd->nama) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" required class="form-control" 
                   placeholder="Masukkan Alamat ....."
                   value="{{ old('alamat', $opd->alamat) }}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">
        <i class="icon-copy ti-save"></i> Update Data
    </button>
</form>
   </div>
   <!-- Form End -->
</div>

<!-- Tambahkan margin bawah untuk memberi jarak dari footer -->
<div style="margin-bottom: 25px;"></div>
@endsection

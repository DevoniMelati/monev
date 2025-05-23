@extends('admin.layouts.app', [
'activePage' => 'unit_pengembang',
])
@section('content')
<div class="min-height-200px">
   <div class="page-header">
      <div class="row">
         <div class="col-md-6 col-sm-12">
            <div class="title">
               <h4>Data Unit Pengembang</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                  <li class="breadcrumb-item"><a href="/admin/unit_pengembang">Data Unit Pengembang</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Data Unit Pengembang</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <!-- Striped table start -->
   <div class="pd-20 card-box mb-30">
      <div class="clearfix">
         <div class="pull-left">
            <h2 class="text-primary h2"><i class="icon-copy dw dw-edit-1"></i> Edit Data Unit Pengembang</h2>
         </div>
         <div class="float-right">
            <a href="/admin/unit_pengembang" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
         </div>
      </div>
      <hr style="margin-top: 0px">
      <form action="/admin/unit_pengembang/update/{{$unit_pengembang->id}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-md-6 mb-3">
        <label>Unit Pengembang</label>
        <input type="text" name="nama" required autofocus class="form-control" 
               placeholder="Masukkan Unit Pengembang ....."
               value="{{ old('nama', $unit_pengembang->nama) }}">
    </div>
    <div class="col-md-6">
        <button type="submit" class="btn btn-primary mt-1">
            <i class="icon-copy ti-save"></i> Update Data
        </button>
    </div>
</form>
   </div>
   <!-- Form End -->
</div>

<!-- Tambahkan margin bawah untuk memberi jarak dari footer -->
<div style="margin-bottom: 25px;"></div>
@endsection

@extends('admin.layouts.app', [
    'activePage' => 'dokumen',
])

@section('content')
<div class="min-height-200px">
   <div class="page-header">
      <div class="row">
         <div class="col-md-6 col-sm-12">
            <div class="title">
               <h4>Data Dokumen</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data Dokumen</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>

   <div class="pd-20 card-box mb-30">
      <div class="clearfix">
         <div class="pull-left">
            <h2 class="text-primary h2"><i class="icon-copy dw dw-list"></i> List Data Dokumen</h2>
         </div>

           @if(Auth::user()->level  == 2)
         <div class="pull-right">
            <a href="/admin/dokumen/add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
         </div>
         @endif
      </div>
      <hr>

      @if (session('error'))
      <div class="alert alert-primary alert-dismissible fade show" role="alert">
         {{ session('error') }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      @endif

      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
         {{ session('success') }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      @endif

      <table class="table table-striped table-bordered data-table hover">
         <thead class="bg-primary text-white">
            <tr>
               <th width="5%">No</th>
               <th>Nama Inovasi</th>
               <th>Nama File</th>
               <th>Unggah File</th>
               <th>Tanggal Upload</th>
               @if(Auth::user()->level == 2)
               <th class="text-center">Action</th>
                @endif
            </tr>
         </thead>
         <tbody>
            @foreach($dokumen as $index => $data)
            <tr>
               <td class="text-center">{{ $index + 1 }}</td>
               <td>{{ $data->nama_inovasi }}</td>
               <td>{{ $data->nama_file ?? '-' }}</td>
               <td>
                  @if($data->unggah_file)
                     <a href="{{ asset('uploads/dokumen/' . $data->unggah_file) }}" target="_blank">
                        {{ $data->unggah_file }}
                     </a>
                  @else
                     -
                  @endif
               </td>
              <td>{{ \Carbon\Carbon::parse($data->tanggal_upload)->translatedFormat('d F Y') }}</td>

               @if(Auth::user()->level == 2)
               <td class="text-center">
                  <a href="/admin/dokumen/edit/{{ $data->id }}" class="btn btn-success btn-xs">
                     <i class="fa fa-edit" data-toggle="tooltip" title="Edit Data"></i>
                  </a>
                  <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#data-{{ $data->id }}">
                     <i class="fa fa-trash" data-toggle="tooltip" title="Delete Data"></i>
                  </button>
               </td>
              @endif
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>

<!-- Modal Hapus -->
@foreach($dokumen as $data)
<div class="modal fade" id="data-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <h5 class="text-center font-weight-bold">Apakah Anda Yakin Menghapus Data Ini?</h5>
            <hr>
            <div class="form-group">
               <label>Nama Inovasi</label>
               <input class="form-control" value="{{ $data->nama_inovasi }}" readonly style="background-color: white;">
            </div>
            <div class="form-group">
               <label>Nama File</label>
               <input class="form-control" value="{{ $data->nama_file }}" readonly style="background-color: white;">
            </div>
            <div class="row mt-4">
               <div class="col-md-6">
                  <a href="/admin/dokumen/delete/{{ $data->id }}">
                     <button type="button" class="btn btn-primary btn-block">Ya</button>
                  </a>
               </div>
               <div class="col-md-6">
                  <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Tidak</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endforeach
@endsection

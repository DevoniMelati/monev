@extends('admin.layouts.app', [
'activePage' => 'inovasi',
])

@section('content')
<div class="min-height-200px">
   <div class="page-header">
      <div class="row">
         <div class="col-md-6 col-sm-12">
            <div class="title">
               <h4>Data Inovasi</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data Inovasi</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>

   <!-- Striped table start -->
   <div class="pd-20 card-box mb-30">
      <div class="clearfix">
         <div class="pull-left">
            <h2 class="text-primary h2"><i class="icon-copy dw dw-list"></i> List Data Inovasi</h2>
         </div>
         <div class="pull-right">
            <a href="/admin/inovasi/add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
         </div>
      </div>
      <hr style="margin-top: 0px;">

      @if (session('error'))
      <div class="alert alert-primary">
         {{ session('error')}}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      @endif

      @if (session('success'))
      <div class="alert alert-success">
         {{ session('success')}}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      @endif

      <table class="table table-striped table-bordered data-table hover">
    <thead class="bg-primary text-white">
        <tr>
            <th class="align-center" width="5%">No</th>
            <th class="align-center">Nama Inovasi</th>
            <th class="align-center">URL</th>
            <th class="align-center">Uraian Inovasi</th>
            <th class="align-center">Basis Inovasi</th>
            <th class="align-center">Tipe Lisensi Inovasi</th>
            <th class="align-center">Jenis Inovasi</th>
            <th class="align-center">Unit Pengembang</th>
            <th class="align-center">OPD</th>
            <th class="align-center">Status</th>
            <th class="table-plus datatable-nosort text-center align-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        @foreach($inovasi as $data)
        <tr>
            <td class="text-center">{{$no++}}</td>
            <td>{{$data->nama}}</td>
            <td>{{$data->url}}</td>
            <td>{{$data->uraian_inovasi}}</td>
            <td>{{$data->basis_inovasi}}</td>
            <td>{{$data->tipe_lisensi_inovasi}}</td>  
            <td>{{$data->jenis_inovasi}}</td> 
            <td>{{$data->unit_pengembang}}</td>
            <td>{{$data->opd}}</td>
            <td class="text-center">
                @if(strtolower($data->status) == 'aktif')
                <span 
                    class="badge px-3 py-2"
                    style="background-color: #28a745; color: #fff; border-radius: 20px; font-weight: 600; cursor: pointer;"
                    data-toggle="modal" 
                    data-target="#statusModal-{{$data->id}}">
                    Aktif
                </span>
                @else
                <span 
                    class="badge px-3 py-2"
                    style="background-color: #dc3545; color: #fff; border-radius: 20px; font-weight: 600; cursor: pointer;"
                    data-toggle="modal" 
                    data-target="#statusModal-{{$data->id}}">
                    Tidak Aktif
                </span>
                @endif
            </td>
            <td class="text-center" width="20%">
                <a href="/admin/inovasi/edit/{{$data->id}}" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Edit Data">
                    <i class="fa fa-edit"></i>
                </a>
                <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#data-{{$data->id}}" data-toggle="tooltip" data-placement="top" title="Delete Data">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

   </div>
   <!-- Striped table End -->
</div>

<!-- Modal for Status -->
@foreach($inovasi as $data)
<div class="modal fade" id="statusModal-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel-{{$data->id}}" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="statusModalLabel-{{$data->id}}">Keterangan Status Inovasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <p>Status Inovasi: <strong>{{$data->status}}</strong></p>
            <p>Deskripsi tentang status inovasi akan ditampilkan di sini. Misalnya: <strong>Aktif</strong> berarti inovasi sedang berjalan dengan baik.</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
         </div>
      </div>
   </div>
</div>
@endforeach

<!-- Modal for Delete -->
@foreach($inovasi as $data)
<div class="modal fade" id="data-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <h2 class="text-center">
            Apakah Anda Yakin Menghapus Data Ini ?
            </h2>
            <hr>
            <div class="form-group" style="font-size: 17px;">
               <label for="exampleInputUsername1">Nama Inovasi</label>
               <input class="form-control" value="{{$data->nama}}" readonly style="background-color: white;pointer-events: none;">
            </div>
            <div class="form-group" style="font-size: 17px;">
               <label for="exampleInputUsername1">URL</label>
               <input class="form-control" value="{{$data->url}}" readonly style="background-color: white;pointer-events: none;">
            </div>
            <div class="row mt-4">
               <div class="col-md-6">
                  <a href="/admin/inovasi/delete/{{$data->id}}" style="text-decoration: none;">
                  <button type="button" class="btn btn-primary btn-block">Ya</button>
                  </a>
               </div>
               <div class="col-md-6">
                  <button type="button" class="btn btn-danger btn-block" data-dismiss="modal" aria-label="Close">Tidak</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endforeach

@endsection

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

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h2 class="text-primary h2"><i class="icon-copy dw dw-list"></i> List Data Inovasi</h2>
            </div>
            @if(Auth::user()->level  == 1)
            <div class="pull-right">
                <a href="/admin/inovasi/add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
            @endif
        </div>
        <hr style="margin-top: 0px;">

        @if (session('error'))
        <div class="alert alert-primary">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
                    @if(Auth::user()->level == 1)
                    <th class="table-plus datatable-nosort text-center align-center">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach($inovasi as $data)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->url }}</td>
                    <td>{{ $data->uraian_inovasi }}</td>
                    <td>{{ $data->basis_inovasi }}</td>
                    <td>{{ $data->tipe_lisensi_inovasi }}</td>
                    <td>{{ $data->jenis_inovasi }}</td>
                    <td>{{ $data->unit_pengembang }}</td>
                    <td>{{ $data->opd }}</td>
                    <td class="text-center">
                        @if(strtolower($data->status) == 'aktif')
                        <span class="badge px-3 py-2"
                              style="background-color: #28a745; color: #fff; border-radius: 20px; font-weight: 600; cursor: pointer;"
                              data-toggle="modal" 
                              data-target="#statusModal-{{ $data->id }}">
                              Aktif
                        </span>
                        @else
                        <span class="badge px-3 py-2"
                              style="background-color: #dc3545; color: #fff; border-radius: 20px; font-weight: 600; cursor: pointer;"
                              data-toggle="modal" 
                              data-target="#statusModal-{{ $data->id }}">
                              Tidak Aktif
                        </span>
                        @endif
                    </td>
                    @if(Auth::user()->level == 1)
                    <td class="text-center" width="20%">
                        <a href="/admin/inovasi/edit/{{ $data->id }}" class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit Data">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#data-{{ $data->id }}" title="Delete Data">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<!-- Modal untuk Status -->
@foreach($inovasi as $data)
<div class="modal fade" id="statusModal-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel-{{ $data->id }}" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title font-weight-bold">
               Apakah Anda yakin ingin {{ strtolower($data->status) == 'aktif' ? 'menonaktifkan' : 'mengaktifkan' }} inovasi ini?
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 1.5rem;">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-group">
               <label><strong>Nama Inovasi</strong></label>
               <input type="text" class="form-control" value="{{ $data->nama }}" readonly>
            </div>
            <div class="form-group">
               <label><strong>OPD</strong></label>
               <input type="text" class="form-control" value="{{ $data->opd }}" readonly>
            </div>
         </div>
         <div class="modal-footer">
            <form action="{{ url('/admin/inovasi/status-toggle/'.$data->id) }}" method="POST">
               @csrf
               @method('PUT')
               <button type="submit" class="btn btn-{{ strtolower($data->status) == 'aktif' ? 'danger' : 'success' }}">
                  Ya, {{ strtolower($data->status) == 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
               </button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endforeach

<!-- Modal untuk Delete -->
@foreach($inovasi as $data)
<div class="modal fade" id="data-{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <h2 class="text-center">Apakah Anda yakin menghapus data ini?</h2>
            <hr>
            <div class="form-group">
               <label>Nama Inovasi</label>
               <input class="form-control" value="{{ $data->nama }}" readonly>
            </div>
            <div class="form-group">
               <label>URL</label>
               <input class="form-control" value="{{ $data->url }}" readonly>
            </div>
            <div class="form-group">
               <label>Status</label>
               <input class="form-control" value="{{ $data->status }}" readonly>
            </div>
            <div class="row mt-4">
               <div class="col-md-6">
                  <a href="/admin/inovasi/delete/{{ $data->id }}">
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

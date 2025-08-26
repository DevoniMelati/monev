@extends('admin.layouts.app', [
    'activePage' => 'laporan',
])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Data Laporan</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color:#1E90FF; font-weight:600;">Data Laporan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h2 class="h2 font-bold" style="color:#1E90FF;">
                    <i class="icon-copy dw dw-list"></i> List Data Laporan
                </h2>
            </div>

            <div class="pull-right">
                @if(Auth::user()->level == 1)
                    <a href="/admin/laporan/add" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah Data 
                    </a>
                @endif
                {{-- Tombol Cetak PDF --}}
                <a href="/admin/laporan/cetak" target="_blank" class="btn btn-danger btn-sm">
                    <i class="fa fa-file-pdf-o"></i> Cetak Laporan
                </a>
            </div>
        </div>
        <hr>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
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

        <table class="table table-hover table-bordered table-striped shadow-sm rounded-lg">
            <thead class="bg-gradient-primary text-white text-center">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Inovasi</th>
                    <th>Nama OPD</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th>Nilai Monitoring</th>
                    <th>Nilai Evaluasi</th>
                    <th>Kesimpulan</th>
                    <th>Tanggal Upload</th>
                    @if(Auth::user()->level == 1)
                        <th class="text-center">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($laporan as $index => $data)
                    <tr>
                        <td class="text-center font-weight-bold">{{ $index + 1 }}</td>
                        <td>{{ $data->nama_inovasi }}</td>
                        <td>{{ $data->nama_opd }}</td>
                        <td>{{ $data->periode_tahun }}</td>
                        <td>
                            <span class="badge 
                                @if($data->status_laporan == 'Selesai') badge-success 
                                @elseif($data->status_laporan == 'Proses') badge-warning 
                                @else badge-secondary @endif">
                                {{ $data->status_laporan }}
                            </span>
                        </td>
                        <td>{{ $data->nilai_monitoring }}</td>
                        <td>{{ $data->nilai_evaluasi }}</td>
                        <td>{{ $data->kesimpulan }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tanggal_upload)->translatedFormat('d F Y') }}</td>

                        @if(Auth::user()->level == 1)
                            <td class="text-center">
                                <a href="/admin/laporan/edit/{{ $data->id }}" class="btn btn-success btn-xs">
                                    <i class="fa fa-edit" data-toggle="tooltip" title="Edit Data"></i>
                                </a>
                                <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus-{{ $data->id }}">
                                    <i class="fa fa-trash" data-toggle="tooltip" title="Hapus Data"></i>
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
@foreach($laporan as $data)
<div class="modal fade" id="hapus-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <h5 class="text-center font-weight-bold">Apakah Anda Yakin Menghapus Data Ini?</h5>
            <hr>
            <div class="form-group">
               <label>Nama Inovasi</label>
               <input class="form-control" value="{{ $data->nama_inovasi }}" readonly>
            </div>
            <div class="form-group">
               <label>Nama OPD</label>
               <input class="form-control" value="{{ $data->nama_opd }}" readonly>
            </div>
            <div class="form-group">
               <label>Tahun</label>
               <input class="form-control" value="{{ $data->periode_tahun }}" readonly>
            </div>
            <div class="form-group">
               <label>Status</label>
               <input class="form-control" value="{{ $data->status_laporan }}" readonly>
            </div>
            <div class="form-group">
               <label>Nilai Monitoring</label>
               <input class="form-control" value="{{ $data->nilai_monitoring }}" readonly>
            </div>
            <div class="form-group">
               <label>Nilai Evaluasi</label>
               <input class="form-control" value="{{ $data->nilai_evaluasi }}" readonly>
            </div>
            
            <div class="form-group">
               <label>Tanggal Upload</label>
               <input class="form-control" value="{{ \Carbon\Carbon::parse($data->tanggal_upload)->translatedFormat('d F Y') }}" readonly>
            </div>
            <div class="row mt-4">
               <div class="col-md-6">
                  <a href="/admin/laporan/delete/{{ $data->id }}">
                     <button type="button" class="btn btn-primary btn-block">Ya, Hapus</button>
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

{{-- Tambahan CSS khusus tabel --}}
<style>
    .bg-gradient-primary {
        background: linear-gradient(90deg, #21d342ff, #07d800ff);
    }
    .table-hover tbody tr:hover {
        background-color: #f1faff !important;
        transition: 0.2s;
    }
    .table thead th {
        vertical-align: middle;
        font-size: 14px;
    }
    .table tbody td {
        vertical-align: middle;
        font-size: 13px;
    }
</style>
@endsection

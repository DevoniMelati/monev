@extends('admin.layouts.app', [
    'activePage' => 'monitoring',
])

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Data Monitoring</h4>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Monitoring</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-2">
            <div class="pull-left">
                <h2 class="text-primary h2"><i class="icon-copy dw dw-list"></i> List Data Monitoring</h2>
            </div>
            <div class="pull-right">
                <a href="/admin/monitoring/add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
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
                    <th>No</th>
                    <th>Tanggal Monitoring</th>
                    <th>Nama Inovasi</th>
                    <th>Keterangan</th>
                     <th>Nilai Monitoring</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monitoring as $index => $data)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal_monitoring)->translatedFormat('d F Y') }}</td>
                    <td>{{ $data->nama_inovasi }}</td>
                    <td>{{ $data->keterangan ?? '-' }}</td>
                    <td>{{ $data->nilai_monitoring ?? '-' }}</td>
                    <td class="text-center">
    @php
        $status = strtolower($data->status);
        $statusColors = [
            'aktif' => 'success',
            'tidak aktif' => 'danger',
            'maintanance' => 'warning',
            'rusak' => 'dark',
            'suspend' => 'secondary',
        ];
        $badgeColor = $statusColors[$status] ?? 'secondary';
        $modalId = 'statusModal-' . $data->id;
    @endphp

    <button type="button"
    class="badge badge-{{ $badgeColor }}"
    style="font-size: 12px; padding: 5px 12px; border-radius: 20px; border: none;"
    data-toggle="modal"
    data-target="#{{ $modalId }}">
    {{ ucfirst($data->status) }}
</button>

</td>


                    <td class="text-center">
                        <a href="/admin/monitoring/edit/{{ $data->id }}" class="btn btn-success btn-xs">
                            <i class="fa fa-edit" data-toggle="tooltip" title="Edit Data"></i>
                        </a>
                        <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#data-{{ $data->id }}">
                            <i class="fa fa-trash" data-toggle="tooltip" title="Hapus Data"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Hapus --}}
@foreach($monitoring as $data)
<div class="modal fade" id="data-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="text-center font-weight-bold">Apakah Anda Yakin Ingin Menghapus Data Ini?</h5>
                <hr>
                <div class="form-group">
                    <label>Nama Inovasi</label>
                    <input class="form-control" value="{{ $data->nama_inovasi }}" readonly>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input class="form-control" value="{{ $data->keterangan }}" readonly>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <input class="form-control" value="{{ ucfirst($data->status) }}" readonly>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="/admin/monitoring/delete/{{ $data->id }}">
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

{{-- Modal Keterangan Status --}}
@foreach($monitoring as $data)
@php
    $status = strtolower($data->status);
    $keterangan = [
        'aktif' => 'Inovasi saat ini aktif dan berjalan sesuai rencana.',
        'tidak aktif' => 'Inovasi sedang tidak berjalan atau dihentikan sementara.',
        'maintanance' => 'Inovasi sedang dalam proses perbaikan atau pemeliharaan.',
        'rusak' => 'Inovasi tidak dapat digunakan karena terdapat kerusakan.',
        'suspend' => 'Inovasi dihentikan sementara karena alasan tertentu atau kebijakan.',
    ];
@endphp
<div class="modal fade" id="statusModal-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel-{{ $data->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="statusModalLabel-{{ $data->id }}">Keterangan Status: {{ ucfirst($data->status) }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{ $keterangan[$status] ?? 'Keterangan tidak tersedia.' }}</p>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection

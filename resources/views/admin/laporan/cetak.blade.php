<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 5px; text-align: center; }
        h3 { text-align: center; margin-bottom: 15px; }
    </style>
</head>
<body>
    <h3>Laporan Data Inovasi</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Inovasi</th>
                <th>Nama OPD</th>
                <th>Tahun</th>
                <th>Status</th>
                <th>Nilai Monitoring</th>
                <th>Nilai Evaluasi</th>
                <th>Kesimpulan</th>
                <th>Tanggal Upload</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $i => $data)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $data->nama_inovasi }}</td>
                <td>{{ $data->nama_opd }}</td>
                <td>{{ $data->periode_tahun }}</td>
                <td>{{ $data->status_laporan }}</td>
                <td>{{ $data->nilai_monitoring }}</td>
                <td>{{ $data->nilai_evaluasi }}</td>
                <td>{{ $data->kesimpulan }}</td>
                <td>{{ \Carbon\Carbon::parse($data->tanggal_upload)->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

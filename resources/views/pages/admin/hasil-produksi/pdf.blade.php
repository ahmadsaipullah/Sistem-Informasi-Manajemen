<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Hasil Produksi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2 align="center">Laporan Hasil Produksi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Product</th>
                <th>Nama Komponen</th>
                <th>Operator</th>
                <th>Jam</th>
                <th>Shift</th>
                <th>Hasil</th>
                <th>Target</th>
                <th>Hambatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasilProduksis as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->produksi->orderRequest->komponen->kode_komponen ?? '-' }}</td>
                    <td>{{ $item->produksi->orderRequest->komponen->nama_komponen ?? '-' }}</td>
                    <td>{{ $item->produksi->orderRequest->operator->name ?? '-' }}</td>
                    <td>{{ $item->jam }}</td>
                    <td>{{ $item->shift }}</td>
                    <td>{{ $item->hasil }}</td>
                    <td>{{ $item->target }}</td>
                    <td>{{ $item->hambatan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

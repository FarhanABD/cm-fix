<!DOCTYPE html>
<html>
<head>
    <title>Data Export PDF</title>
    <style>
        body { font-family: sans-serif; }
        h1, h3 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: center; }
    </style>
</head>
<body>
    <h1>Laporan dari ({{ $dari}} - {{ $sampai }})</h1>
    <table>
        <thead>
            <tr>
                <th class="">id</th>
                <th class="">id_perusahaan</th>
                <th class="">email</th>
                <th class="">nama_perusahaan</th>
                <th class="">phone</th>
                <th class="">alamat</th>
                <th class="">nama_pic</th>
                <th class="">action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orders as $item)
        <tr>
            <td class="">{{ $item->id_order }}</td>
            <td class="">{{ $item->formatRupiah('total') }}</td>
            <td class="">{{ $item->tanggal_langganan }}</td>
            <td class="">{{ $item->tanggal_habis }}</td> <!-- Menggunakan variabel yang sesuai -->
            <td class=""></td>
        </tr>
    @endforeach
        </tbody>
    </table>
</body>
</html>
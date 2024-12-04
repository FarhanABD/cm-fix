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
                  <th>No</th>
                  <th>id_maintenance</th>
                  <th>Jenis Maintenance</th>
                  <th>Tanggal Langganan</th>
                  <th>Tanggal Habis</th>
                  <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orders as $item)
        <tr>
            <td class="">{{ $item->id_maintenance }}</td>
            <td class="">{{ $item->jenis_maintenance}}</td>
            <td class="">{{ $item->tanggal_langganan }}</td>
            <td class="">{{ $item->tanggal_habis }}</td> <!-- Menggunakan variabel yang sesuai -->
            <td class="">
                <!-- Tindakan jika diperlukan -->
            </td>
        </tr>
    @endforeach
        </tbody>
    </table>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #fa6806;
            color: white;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <h1>Laporan Invoice</h1>
    {{-- <h3>Periode: {{ $dari }} - {{ $sampai }}</h3> --}}

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>id_invoice</th>
                <th>id_order</th>
                <th>nama customer</th>
                <th>jenis layanan</th>
                <th>jenis paket</th>
                <th>total</th>
                <th>tanggal_langganan</th>
                <th>tanggal_habis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $index => $item)
                <tr>
                    <td>{{ $index + 1}}</td>
                    <td>{{ $item->id_invoice }}</td>
                    <td>{{ $item->id_order }}</td>
                    <td>{{ $item->nama_perusahaan }}</td>
                    <td>{{ $item->jenis_layanan }}</td>
                    <td>{{ $item->jenis_paket }}</td>
                    <td>{{ $item->total }}</td>
                    <td>{{ $item->tanggal_langganan }}</td>
                    <td>{{ $item->tanggal_habis }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pindahkan footer di luar tag table -->
    <div class="footer">
        <p>Generated on: {{ \Carbon\Carbon::now()->format('d M Y H:i:s') }}</p>
    </div>

</body>
</html>
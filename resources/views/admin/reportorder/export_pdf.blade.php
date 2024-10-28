<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Order</title>
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
                <th class="">No</th>
                    <th class="">id_order</th>
                    <th class="">total</th>
                    <th class="">tanggal langganan</th>
                    <th class="">tanggal habis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $item )
                <tr>
                    <td class="">{{ $loop->iteration }}</td>
                    <td class="">{{ $item->id_order }}</td>
                    <td class="">{{ $item->formatRupiah('total') }}</td>
                    <td class="">{{ $item->tanggal_langganan }}</td>
                    <td class="">{{ $item->tanggal_langganan }}</td>
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
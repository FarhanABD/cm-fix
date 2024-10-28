<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Laporan Invoice</h1>
    <h3>Periode: {{ $dari }} - {{ $sampai }}</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>id_invoice</th>
                <th>id_order</th>
                <th>tanggal_langganan</th>
                <th>tanggal_habis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $index => $invoice)
                <tr>
                     <td>{{ $index + 1 }}</td>
                     <td>{{ $invoice->id_invoice }}</td>
                     <td>{{ number_format($invoice->total, 2, ',', '.') }}</td>
                     <td>{{ $invoice->tanggal_langganan }}</td>
                     <td>{{ $invoice->tanggal_habis }}</td>
                     <td><a href="{{ route('super-admin.invoice.showSuperAdmin', $invoice->id_invoice) }}">Detail</a></td>        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>

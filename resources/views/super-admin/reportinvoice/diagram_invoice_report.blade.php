<!DOCTYPE html>
<html>
<head>
    <title>Laporan Diagram Invoice</title>
    <style>
        body { font-family: sans-serif; }
        h1, h3 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: center; }
    </style>
</head>
<body>
    <h1>Laporan Diagram Invoice</h1>
    <h3>Rentang Tanggal: {{ $dari }} - {{ $sampai }}</h3>

    <h3>Invoice Harian</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dailyInvoices as $invoice)
                <tr>
                    <td>{{ $invoice->date }}</td>
                    <td>{{ $invoice->total_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Invoice Bulanan</h3>
    <table>
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($monthlyInvoices as $invoice)
                <tr>
                    <td>{{ $invoice->month }}</td>
                    <td>{{ $invoice->total_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Invoice Tahunan</h3>
    <table>
        <thead>
            <tr>
                <th>Tahun</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($yearlyInvoices as $invoice)
                <tr>
                    <td>{{ $invoice->year }}</td>
                    <td>{{ $invoice->total_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

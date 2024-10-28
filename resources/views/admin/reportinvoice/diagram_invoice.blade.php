<!DOCTYPE html>
<html>
<head>
    <title>Invoice Report PDF</title>
</head>
<body>
    <h1>Invoice Report</h1>

    <h3>Invoice Harian</h3>
    <ul>
        @foreach($dailyInvoices as $details)
            <li>{{ $details->date }}: Rp{{ number_format($details->total_amount, 2) }} invoiced</li>
        @endforeach
    </ul>

    <h3>Invoice Bulanan</h3>
    <ul>
        @foreach($monthlyInvoices as $details)
            <li>Bulan {{ $details->month }}: Rp{{ number_format($details->total_amount, 2) }} invoiced</li>
        @endforeach
    </ul>

    <h3>Invoice Tahunan</h3>
    <ul>
        @foreach($yearlyInvoices as $details)
            <li>Tahun {{ $details->year }}: Rp{{ number_format($details->total_amount, 2) }} invoiced</li>
        @endforeach
    </ul>
</body>
</html>

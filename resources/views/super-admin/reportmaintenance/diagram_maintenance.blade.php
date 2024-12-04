<!DOCTYPE html>
<html>
<head>
    <title>Maintenance Report PDF</title>
</head>
<body>
    <h1>Maintenance Report</h1>

    <!-- Maintenance Harian -->
    <h3>Maintenance Harian</h3>
    <ul>
        @foreach($dailyMaintenance as $details)
            <li>{{ $details->date }}: {{ $details->total_count }} maintenance actions</li>
        @endforeach
    </ul>

    <!-- Maintenance Bulanan -->
    <h3>Maintenance Bulanan</h3>
    <ul>
        @foreach($monthlyMaintenance as $details)
            <li>Bulan {{ $details->month }}: {{ $details->total_count }} maintenance actions</li>
        @endforeach
    </ul>

    <!-- Maintenance Tahunan -->
    <h3>Maintenance Tahunan</h3>
    <ul>
        @foreach($yearlyMaintenance as $details)
            <li>Tahun {{ $details->year }}: {{ $details->total_count }} maintenance actions</li>
        @endforeach
    </ul>
</body>
</html>

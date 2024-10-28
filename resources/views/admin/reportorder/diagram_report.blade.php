<!DOCTYPE html>
<html>
<head>
    <title>Diagram Report PDF</title>
</head>
<body>
    <h1>Order Report</h1>
    <h3>Order Harian</h3>
    <ul>
        @foreach($dailyOrders as $order)
            <li>{{ $order->date }}: {{ $order->total }} orders</li>
        @endforeach
    </ul>
    <h3>Order Bulanan</h3>
    <ul>
        @foreach($monthlyOrders as $order)
            <li>Bulan {{ $order->month }}: {{ $order->total }} orders</li>
        @endforeach
    </ul>
    <h3>Order Tahunan</h3>
    <ul>
        @foreach($yearlyOrders as $order)
            <li>Tahun {{ $order->year }}: {{ $order->total }} orders</li>
        @endforeach
@extends('admin.layouts.master')

@section('content')
<style>
    .chart-container {
        position: relative;
        height: 400px;
        width: 100%;
        border: 2px solid #333;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container mt-5">
    <h4 class="py-3 mb-4 fw-bold">
        <a href="{{ route('admin.reportcustomer.index') }}" class="text-muted me-2">
            <i class="bx bx-arrow-back"></i>
        </a>
        <span class="text-muted fw-light">Diagram /</span> Report Customer
    </h4>

    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-4 row">
                    <h4>Customer Hari ini</h4>
                    <div class="chart-container">
                        <canvas id="dailyChart"></canvas>
                    </div>
                </div>
                <div class="mb-4 row">
                    <h4>Customer Bulan ini</h4>
                    <div class="chart-container">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
                    <div class="mb-4 row">
                        <h4>Customer Tahun ini</h4>
                        <div class="chart-container">
                            <canvas id="yearlyChart"></canvas>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    window.onload = function() {
        const dailyData = @json($dailyCustomers);
        const monthlyData = @json($monthlyCustomers);
        const yearlyData = @json($yearlyCustomers);

        const dailyLabels = dailyData.map(item => item.date);
        const dailyCounts = dailyData.map(item => item.total);

        const dailyCtx = document.getElementById('dailyChart').getContext('2d');
        new Chart(dailyCtx, {
            type: 'bar',
            data: {
                labels: dailyLabels,
                datasets: [{
                    label: 'Customers per Day',
                    data: dailyCounts,
                    backgroundColor: 'rgba(58, 123, 213, 0.6)',
                    borderColor: 'rgba(58, 123, 213, 1)',
                    borderWidth: 2,
                    barThickness: 30,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const monthlyLabels = monthlyData.map(item => `Bulan ${item.month}`);
        const monthlyCounts = monthlyData.map(item => item.total);

        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Customers per Month',
                    data: monthlyCounts,
                    backgroundColor: 'rgba(246, 78, 96, 0.6)',
                    borderColor: 'rgba(246, 78, 96, 1)',
                    borderWidth: 2,
                    barThickness: 30,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const yearlyLabels = yearlyData.map(item => `Tahun ${item.year}`);
        const yearlyCounts = yearlyData.map(item => item.total);

        const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
        new Chart(yearlyCtx, {
            type: 'bar',
            data: {
                labels: yearlyLabels,
                datasets: [{
                    label: 'Customers per Year',
                    data: yearlyCounts,
                    backgroundColor: 'rgba(123, 237, 159, 0.6)',
                    borderColor: 'rgba(123, 237, 159, 1)',
                    borderWidth: 2,
                    barThickness: 30,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    };
</script>
@endpush

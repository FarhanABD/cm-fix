@extends('admin.layouts.master')

@section('content')
<style>
    .chart-container {
        position: relative;
        height: 400px;
        width: 100%;
        border: 2px solid #333; /* Tambahkan border */
        padding: 10px; /* Beri sedikit padding untuk jarak */
        border-radius: 10px; /* Opsional: buat border melengkung */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Tambahkan shadow agar lebih elegan */
    }
</style>

<div class="container mt-5">
    {{-- <h2 class="mb-4">Diagram Order</h2> --}}
    <h4 class="fw-bold py-3 mb-4">
        <a href="{{ route('admin.reportorder.index') }}" class="text-muted me-2">
          <i class="bx bx-arrow-back"></i>
        </a>
        <span class="text-muted fw-light">Diagram /</span> Report Order
      </h4>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <label for="dari" style="margin-bottom: 8px">Dari</label>
                    <input type="date" name="dari" value="{{ $dari }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="sampai" style="margin-bottom: 8px">Sampai</label>
                    <input type="date" name="sampai" value="{{ $sampai }}" class="form-control">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                <div class="col-md-3 d-flex align-items-end justify-content-end">
                    <a href="{{ route('admin.reportorder.diagram_print', ['dari' => $dari, 'sampai' => $sampai]) }}"
                        class="btn btn-danger">
                        Cetak PDF
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4 row">
                <div class="col-md-12">
                    <h4>Order Harian</h4>
                    <div class="chart-container">
                        <canvas id="dailyChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mb-4 row">
                    <h4>Order Bulanan</h4>
                    <div class="chart-container">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
                <div class="row">
                <div class="mb-4 row">
                    <h4>Order Tahunan</h4>
                    <div class="chart-container">
                        <canvas id="yearlyChart"></canvas>
                    </div>
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
        // Ambil data dari Blade (konversi ke JSON)
        const dailyData = @json($dailyOrders);
        const monthlyData = @json($monthlyOrders);
        const yearlyData = @json($yearlyOrders);

        // Data processing untuk diagram harian
        const dailyLabels = dailyData.map(item => item.date);
        const dailyCounts = dailyData.map(item => item.total);

        const dailyCtx = document.getElementById('dailyChart').getContext('2d');
        const dailyChart = new Chart(dailyCtx, {
            type: 'bar',
            data: {
                labels: dailyLabels, // Labels dari data harian
                datasets: [{
                    label: 'Orders per Day',
                    data: dailyCounts, // Data dari database
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
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const monthlyLabels = monthlyData.map(item => `Bulan ${item.month}`);
        const monthlyCounts = monthlyData.map(item => item.total);

        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: monthlyLabels, // Labels dari data bulanan
                datasets: [{
                    label: 'Orders per Month',
                    data: monthlyCounts, // Data dari database
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
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Data processing untuk diagram tahunan
        const yearlyLabels = yearlyData.map(item => `Tahun ${item.year}`);
        const yearlyCounts = yearlyData.map(item => item.total);

        const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
        const yearlyChart = new Chart(yearlyCtx, {
            type: 'bar',
            data: {
                labels: yearlyLabels, // Labels dari data tahunan
                datasets: [{
                    label: 'Orders per Year',
                    data: yearlyCounts, // Data dari database
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
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    };
</script>
@endpush
@extends('admin.layouts.master')

@section('content')
 <div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="mb-4 col-lg-14 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Selamat Datang Admin {{ Auth::user()->name }} 🎉</h5>
                <h5 class="mb-4">
                  @csrf
                  Anda Mempunnyai {{ $maintenancesCount }} data Maintenance Hari ini
              </h5>
              </div>
            </div>
          </div>
        </div>
      </div>

      <style>
        .custom-icon {
              width: 32px;
              height: 32px;
              object-fit: cover; /* Pastikan gambar terpotong proporsional */
              border-radius: 50%; /* Membuat gambar bulat */
          }
        .avatar-initial {
              background-color: #00a2e8; /* Ganti warna background sesuai keinginan */
              padding: 10px; /* Pastikan gambar tidak terlalu besar dalam avatar */
              display: flex;
              justify-content: center;
              align-items: center;
          }

        .bg-label-primary {
              background-color: #ffcc00; /* Contoh mengganti background jadi warna kuning */
          }
      </style>
    <div class="container">
    <div class="row justify-content-center align-items-center g-3">
        <!-- Card 1 -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card" style="background-color: #F26124; border: 1px solid #dee2e6; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); border-radius: 8px;">
                <div class="card-body">
                    <h2 class="pt-2 mb-2 text-center fw-semibold" style="color: #ffffff; font-size: 2.5rem;">{{ $totalCustomer }}</h2>
                    <div class="pt-2 mb-2 text-center fw-semibold" style="color: #ffffff; font-size: 1.2rem; letter-spacing: 0.8px;">Total Customer</div>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card" style="background-color: #F26124; border: 1px solid #dee2e6; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); border-radius: 8px;">
                <div class="card-body">
                    <h2 class="pt-2 mb-2 text-center fw-semibold" style="color: #ffffff; font-size: 2.5rem;">{{ $orderCount }}</h2>
                    <div class="pt-2 mb-2 text-center fw-semibold" style="color: #ffffff; font-size: 1.2rem; letter-spacing: 0.8px;">Total Order</div>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card" style="background-color: #F26124; border: 1px solid #dee2e6; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); border-radius: 8px;">
                <div class="card-body">
                    <h2 class="pt-2 mb-2 text-center fw-semibold" style="color: #ffffff; font-size: 2.5rem;">{{ $layananCount }}</h2>
                    <div class="pt-2 mb-2 text-center fw-semibold" style="color: #ffffff; font-size: 1.2rem; letter-spacing: 0.8px;">Total Invoice</div>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card" style="background-color: #F26124; border: 1px solid #dee2e6; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); border-radius: 8px;">
                <div class="card-body">
                    <h2 class="pt-2 mb-2 text-center fw-semibold" style="color: #ffffff; font-size: 2.5rem;">{{ $paketCount }}</h2>
                    <div class="pt-2 mb-2 text-center fw-semibold" style="color: #ffffff; font-size: 1.2rem; letter-spacing: 0.8px;">Total Pre Order</div>
                </div>
            </div>
        </div>
      <!-- Total Revenue -->
      <div class="order-2 mb-4 col-16 col-lg-20 order-md-2 order-lg-2">
        <div class="card">
          <div class="row row-bordered g-0">
            <div class="col-md-8">
              <h5 class="pb-3 m-0 card-header me-2">Total Pendapatan</h5>
              <div id="dashboard" style="width: 150%; height: 400px;" class="px-2"></div>
            </div>
            <!-- SweetAlert CDN -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://code.highcharts.com/11.4.8/highcharts.js"></script>
            <script type="text/javascript">
              var pendapatan = <?php echo json_encode(array_values($pendapatan)); ?>;
              var bulan = <?php echo json_encode(array_keys($pendapatan)); ?>;

              Highcharts.chart('dashboard', {
                chart: {
                type: 'line', // Atur tipe grafik (opsional)
                height: 400, // Tinggi grafik agar proporsional dengan lebar
                },
                  title: {
                      text: "Grafik Pendapatan Bulanan"
                  },
                  xAxis: {
                      categories: bulan // Bulan sekarang sudah urut sesuai kalender
                  },
                  yAxis: {
                      title: {
                          text: "Nominal pendapatan bulanan"
                      }
                  },
                  plotOptions: {
                      series: {
                          allowPointSelect: true
                      }
                  },
                  series: [{
                      name: 'Total Pendapatan',
                      data: pendapatan
                  }]
              });
          </script>
            </script>
          </div>
            </div>
          </div>
        </div>

<div class="row mt-4" style="margin-left: 12px; margin-bottom: 12px">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h5 class="m-0 card-title">Tabel Order Overdue</h5>
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Data 1</td>
              <td>Detail 1</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Data 2</td>
              <td>Detail 2</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Data 3</td>
              <td>Detail 3</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>


    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h5 class="m-0 card-title">Tabel Maintenance Order</h5>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Data A</td>
                <td>Detail A</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Data B</td>
                <td>Detail B</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Data C</td>
                <td>Detail C</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>



    <div class="row" style="margin-left: 12px">
      <div class="order-2 mb-4 col-6 col-lg-6 order-md-2 order-lg-2">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="m-0 card-title me-2">Report Invoice Terakhir </h5>
              <div class="dropdown">
              </div>
            </div>
            <div class="card-body">
              <ul class="p-0 m-0">
                  @foreach($latestInvoices as $invoice)
                  <li class="pb-1 mb-4 d-flex">
                      <div class="flex-shrink-0 avatar me-3">
                          <img src="{{ asset('backend/assets/img/up-arrow.png') }}" alt="Invoice" class="rounded" />
                      </div>
                      <div class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
                          <div class="me-2">
                              <small class="mb-1 text-muted d-block">{{ $invoice->nama_perusahaan }}</small>
                              <h6 class="mb-0">{{ $invoice->jenis_layanan }}</h6>
                          </div>
                          <div class="gap-1 user-progress d-flex align-items-center">
                              <h6 class="mb-0">{{ $invoice->formatRupiah('total') }}</h6>
                          </div>
                      </div>
                  </li>
                  @endforeach
              </ul>
          </div>

          </div>
        
        </div>

        <div class="order-2 mb-4 col-6 col-lg-6 order-md-2 order-lg-2">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="m-0 card-title me-2">Transaksi Terakhir Perusahaan</h5>
              <div class="dropdown">
              </div>
            </div>
            <div class="card-body">
              <ul class="p-0 m-0">
                  @foreach($latestInvoices as $invoice)
                  <li class="pb-1 mb-4 d-flex">
                      <div class="flex-shrink-0 avatar me-3">
                          <img src="{{ asset('backend/assets/img/up-arrow.png') }}" alt="Invoice" class="rounded" />
                      </div>
                      <div class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
                          <div class="me-2">
                              <small class="mb-1 text-muted d-block">{{ $invoice->nama_perusahaan }}</small>
                              <h6 class="mb-0">{{ $invoice->jenis_layanan }}</h6>
                          </div>
                          <div class="gap-1 user-progress d-flex align-items-center">
                              <h6 class="mb-0">{{ $invoice->formatRupiah('total') }}</h6>
                          </div>
                      </div>
                  </li>
                  @endforeach
              </ul>
          </div>

          </div>
        
        </div>
  </div>
@endsection

@push('scripts')
<script>
                @if($hasOrdersNearExpiry)
                    Swal.fire({
                        title: 'Perhatian!',
                        text: 'Ada order yang akan habis dalam 30 hari!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                @endif
            </script>
@endpush
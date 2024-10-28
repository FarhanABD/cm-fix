@extends('admin.layouts.master')

@section('content')
 <div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-14 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Selamat Datang Admin {{ Auth::user()->name }} 🎉</h5>
                <h5 class="mb-4">
                  @csrf
                  Anda Mempunyai {{ $maintenancesCount }} data Maintenance Hari ini
              </h5>              
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img
                  src="{{ asset('storage/img/logo.png') }}"
                  height="120"
                  alt="View Badge User"
                  style="margin-right: 12px"
                  data-app-dark-img="illustrations/man-with-laptop-dark.png"
                  data-app-light-img="illustrations/man-with-laptop-light.png"
                />
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

      <!-- Total Revenue -->
      <div class="col-12 col-lg-20 order-2 order-md-2 order-lg-2 mb-4">
        <div class="card">
          <div class="row row-bordered g-0">
            <div class="col-md-8">
              <h5 class="card-header m-0 me-2 pb-3">Total Pendapatan</h5>
              <div id="dashboard" class="px-2"></div>
            </div>
            <!-- SweetAlert CDN -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://code.highcharts.com/11.4.8/highcharts.js"></script>
            <script type="text/javascript">
              var pendapatan = <?php echo json_encode(array_values($pendapatan)); ?>;
              var bulan = <?php echo json_encode(array_keys($pendapatan)); ?>;
          
              Highcharts.chart('dashboard', {
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
            <div class="col-md-4">
              <div class="card-body">
                <div class="text-center">
                  <div class="dropdown">
                  </div>
                </div>
              </div>
              <div>
                <div class="card" style="width: 20rem; margin-left: 24px; background-color: #8576FF; border: 1px solid #dee2e6; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); border-radius: 8px;">
                  <div class="card-body-container" style="display: flex;">
                      <!-- Card Body 1 -->
                      <div class="card-body" style="flex:1; padding: 20px; border-right: 4px solid #ffffff;">
                          <h2 class="text-center fw-semibold pt-3 mb-2" style="color: #ffffff; font-size: 2.5rem;">{{ $totalCustomer }}</h2>
                          <div class="text-center fw-semibold pt-3 mb-2" style="color: #ffffff; font-size: 1.2rem; letter-spacing: 1px;">Total Customer</div>
                      </div>
                      <!-- Card Body 2 -->
                      <div class="card-body" style="flex: 1; padding: 20px; border-left: 4px solid #ffffff;">
                          <h2 class="text-center fw-semibold pt-3 mb-2" style="color: #ffffff; font-size: 2.5rem;">{{ $orderCount }}</h2>
                          <div class="text-center fw-semibold pt-3 mb-2" style="color: #ffffff; font-size: 1.2rem; letter-spacing: 1px;">Total Order</div>
                      </div>
                  </div>
              </div>

              <div class="card" style="width: 20rem; margin-left: 24px; margin-bottom: 20px; background-color: #8576FF; border: 1px solid #dee2e6; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); border-radius: 8px;">
                <div class="card-body-container" style="display: flex;">
                    
                  <div class="card-body" style="flex: 1; padding: 20px; border-top: 4px solid #ffffff; border-right: 4px solid #ffffff;">
                        <h2 class="text-center fw-semibold pt-3 mb-2" style="color: #ffffff; font-size: 2.5rem;">{{ $layananCount }}</h2>
                        <div class="text-center fw-semibold pt-3 mb-2" style="color: #ffffff; font-size: 1.2rem; letter-spacing: 1px;">Total Layanan</div>
                    </div>
            
                    <div class="card-body" style="flex: 1; padding: 20px; border-top: 4px solid #ffffff; border-left: 4px solid #ffffff;">
                        <h2 class="text-center fw-semibold pt-3 mb-2" style="color: #ffffff; font-size: 2.5rem;">{{ $paketCount }}</h2>
                        <div class="text-center fw-semibold pt-3 mb-2" style="color: #ffffff; font-size: 1.2rem; letter-spacing: 1px;">Total Paket</div>
                    </div>
                </div>
            </div>
            </div>
          </div>
          </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="row" style="margin-left: 12px">
        {{-- <div class="col-md-6 col-lg-6 order-2 mb-4"> --}}
        <div class="col-6 col-lg-6 order-2 order-md-2 order-lg-2 mb-4">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
              <div class="card-title mb-0">
                <h5 class="m-0 me-2">Report Paket</h5>
              </div>
            </div>
            <div class="card-body" style="margin-top: 24px">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex flex-column align-items-center gap-1">
                </div>
              </div>
              <ul class="p-0 m-0">

                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-primary">
                      <img src="{{ asset('backend/assets/img/silver.png') }}" alt="Custom Icon" class="custom-icon">
                      </span>
                  </div>

                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">Silver</h6>
                      <small class="text-muted">Jenis Paket Silver</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">{{ $paketSilverCount }}</small>
                    </div>
                  </div>
                </li>

                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-success">
                      <img src="{{ asset('backend/assets/img/gold.png') }}" alt="Custom Icon" class="custom-icon">
                      </span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">Gold</h6>
                      <small class="text-muted">Jenis Paket Gold</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">{{ $paketGoldCount }}</small>
                    </div>
                  </div>
                </li>

                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-info">
                      <img src="{{ asset('backend/assets/img/platinum.png') }}" alt="Custom Icon" class="custom-icon">
                    </span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">Platinum</h6>
                      <small class="text-muted">Jenis Paket Platinum</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">{{ $paketPlatinumCount }}</small>
                    </div>
                  </div>
                </li>

                <li class="d-flex">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-secondary">
                      <img src="{{ asset('backend/assets/img/custom.png') }}" alt="Custom Icon" class="custom-icon">
                    </span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <h6 class="mb-0">Custom</h6>
                      <small class="text-muted">Jenis Paket Custom</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">{{ $paketCustomCount }}</small>
                    </div>
                  </div>
                </li>
                
                <li class="d-flex mb-4 pb-1">
                  <div class="avatar flex-shrink-0 me-3" style="margin-top: 24px">
                    <span class="avatar-initial rounded bg-label-info">
                      <img src="{{ asset('backend/assets/img/brand.png') }}" alt="Custom Icon" class="custom-icon">
                    </span>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2" style="margin-top: 24px">
                    <div class="me-2">
                      <h6 class="mb-0">Branding</h6>
                      <small class="text-muted">Jenis Paket Branding</small>
                    </div>
                    <div class="user-progress">
                      <small class="fw-semibold">{{ $paketBrandingCount }}</small>
                    </div>
                  </div>
                </li>

              </ul>
            </div>
          </div>
        </div>

        <div class="col-6 col-lg-6 order-2 order-md-2 order-lg-2 mb-4">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="card-title m-0 me-2">Transaksi Terakhir Perusahaan</h5>
              <div class="dropdown">
              </div>
            </div>
            <div class="card-body">
              <ul class="p-0 m-0">
                  @foreach($latestInvoices as $invoice)
                  <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                          <img src="{{ asset('backend/assets/img/up-arrow.png') }}" alt="Invoice" class="rounded" />
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                          <div class="me-2">
                              <small class="text-muted d-block mb-1">{{ $invoice->nama_perusahaan }}</small>
                              <h6 class="mb-0">{{ $invoice->jenis_layanan }}</h6>
                          </div>
                          <div class="user-progress d-flex align-items-center gap-1">
                              <h6 class="mb-0">{{ $invoice->formatRupiah('total') }}</h6>
                          </div>
                      </div>
                  </li>
                  @endforeach
              </ul>
          </div>
          
          </div>
        </di>
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
@extends('super-admin.layouts.master')
@section('content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h4 class="card-header">Tabel Report Order
          <a href="{{ route('super-admin.reportorder.export_excelSuperAdmin') }}" class="btn btn-success float-end" style="margin-left: 20px"><i class="fa-solid fa-file-excel"></i></a>
          <a href="{{ route('super-admin.reportorder.export_excelSuperAdmin') }}" class="btn btn-danger float-end" style="margin-left: 20px"><i class="fa-solid fa-file-pdf"></i></a>
      </h4> 
      <div class="card-body">
           <div class="card">
            <h5 class="cart-header">Filter Report Order</h5>
             <!-- Filter Tanggal -->
             <form id="filterForm" method="GET" action="{{ route('super-admin.reportorder.cariSuperAdmin') }}" class="row mb-4">
              <div class="col-md-3">
                  <div class="form-group d-flex align-items-center">
                      <label style="margin-right: 8px" for="tanggalDari">Dari</label>
                      <input type="date" class="form-control" name="dari" id="tanggalDari" value="">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group d-flex align-items-center">
                      <label style="margin-right: 8px" for="tanggalSampai">Sampai</label>
                      <input type="date" class="form-control" name="sampai" id="tanggalSampai" value="">
                  </div>
              </div>
              <div class="col-md-3 d-flex align-items-center">
                  <button type="submit" class="btn btn-primary">Filter</button>
              </div>
          </form>  
            <div class="table-responsive text-nowrap">
              <table class="table" id="table">
                <thead>
                  <tr class="text-nowrap">
                    <th class="">No</th>
                    <th class="">id_order</th>
                    <th class="">total</th>
                    <th class="">tanggal langganan</th>
                    <th class="">tanggal habis</th>
                    <th class="">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $item )
                  <tr>
                    <td class="">{{ $loop->iteration }}</td>
                    <td class="">{{ $item->id_order }}</td>
                    <td class="">{{ $item->formatRupiah('total') }}</td>
                    <td class="">{{ $item->tanggal_langganan }}</td>
                    <td class="">{{ $item->tanggal_habis }}</td>
                    <td class="">
                      <div class="d-flex flex-column">
                        <a href="{{ route('super-admin.reportorder.showSuperAdmin', urlencode($item->id_order)) }}" class="btn btn-outline-info btn-sm mb-2">
                          <i class="fa-solid fa-eye"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
            </div>
          </div>
          <!--/ Responsive Table -->
      </div>
  </div>
    <!--/ Basic Bootstrap Table -->
  <div class="content-backdrop fade"></div>
</div>
@endsection

@push('scripts')
{{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}

<script>
  $(document).ready(function () {
      $('#table').DataTable();
  });

  // Mendapatkan elemen input tanggal
  var tanggal_dari = document.getElementById('tanggalDari');
  var tanggal_sampai = document.getElementById('tanggalSampai');

  // Mendapatkan tanggal hari ini
  var today = new Date();
  var year = today.getFullYear();
  var month = String(today.getMonth() + 1).padStart(2, '0'); // Tambahkan nol di depan jika bulan < 10
  var day = String(today.getDate()).padStart(2, '0'); // Tambahkan nol di depan jika tanggal < 10

  // Format tanggal sebagai "YYYY-MM-DD" (format yang diharapkan untuk input type="date")
  var formattedDate = year + '-' + month + '-' + day;

  // Set nilai input tanggal menjadi tanggal hari ini
  tanggal_dari.value = formattedDate;
  tanggal_sampai.value = formattedDate;
</script>
@endpush
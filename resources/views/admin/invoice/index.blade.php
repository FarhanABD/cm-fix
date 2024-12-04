@extends('admin.layouts.master')
@section('content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h4 class="card-header">Tabel Invoice
          <a href="{{ route('admin.invoice.create') }}" class="btn btn-danger float-end">Create</a>
      </h4> 
      <div class="card-body">
           <div class="card">
            <h5 class="cart-header">Filter Invoice Order</h5>
             <!-- Filter Tanggal -->
             <form id="filterForm" method="GET" action="{{ route('admin.invoice.cari') }}" class="mb-4 row" style="display: flex; flex-wrap: wrap; gap: 8px;">
              <div class="col-md-3">
              <label for="tanggalDari" class="form-label">Dari</label>
              <input type="date" class="form-control" name="dari" id="tanggalDari" value="">
            </div>
            <div class="col-md-3">
              <label for="tanggalSampai" class="form-label">Sampai</label>
              <input type="date" class="form-control" name="sampai" id="tanggalSampai" value="">
            </div>
            <div class="col-md-3 d-flex align-items-end">
              <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
          </form> 
            <div class="table-responsive text-nowrap">
              <table class="table" id="table">
                <thead>
                  <tr class="text-nowrap">
                    <th >No</th>
                    <th >id_invoice</th>
                    <th >id_order</th>
                    <th >nama customer</th>
                    <th >layanan</th>
                    <th >paket</th>
                    <th >deskripsi</th>
                    <th >total</th>
                    <th class="text-nowrap Aksi">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($invoices as $item )
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->id_invoice }}</td>
                    <td>{{ $item->id_order }}</td>
                    <td>{{ $item->nama_perusahaan }}</td>
                    <td>{{ $item->jenis_layanan }}</td>
                    <td>{{ $item->jenis_paket }}</td>
                    <td>{{ $item->item_desc }}</td>
                    <td>{{ $item->formatRupiah('total') }}</td>
                    <td>
                      <div class="gap-2 d-flex justify-content-between">
                          <a href="{{ route('admin.invoice.show', urlencode($item->id_invoice)) }}" class="btn btn-outline-info btn-sm">
                              <i class="fa-solid fa-eye"></i> Detail
                          </a>
                          <a href="{{ route('admin.invoice.edit', $item->id) }}" class="btn btn-outline-success btn-sm">
                              <i class="fa-solid fa-edit"></i> Edit
                          </a>
                          <a href="{{ route('admin.invoice.cetak', urlencode($item->id_invoice)) }}" target="_blank" class="btn btn-outline-danger btn-sm">
                              <i class="fa-solid fa-print"></i> Print PDF
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
<style>
  .Aksi .btn {
      display: inline-block;
      margin: 8px; /* Adjust margin as needed */
  }

  .Aksi .btn:first-child {
      margin: 0; /* Remove margin from the first button */
  }
</style>
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
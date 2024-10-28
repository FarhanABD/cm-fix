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
             <form id="filterForm" method="GET" action="{{ route('admin.invoice.cari') }}" class="row mb-4">
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
                    <th class="col-md-1">No</th>
                    <th class="col-md-2">id_invoice</th>
                    <th class="col-md-2">id_order</th>
                    <th class="col-md-2">nama customer</th>
                    <th class="col-md-2">layanan</th>
                    <th class="col-md-2">paket</th>
                    <th class="col-md-1">deskripsi</th>
                    <th class="col-md-1">total</th>
                    <th class="col-md-2">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($invoices as $item )
                  <tr>
                    <td class="col-md-1">{{ $loop->iteration }}</td>
                    <td class="col-md-2">{{ $item->id_invoice }}</td>
                    <td class="col-md-2">{{ $item->id_order }}</td>
                    <td class="col-md-2">{{ $item->nama_perusahaan }}</td>
                    <td class="text-wrap">{{ $item->jenis_layanan }}</td>
                    <td class="text-wrap">{{ $item->jenis_paket }}</td>
                    <td class="text-wrap">{{ $item->item_desc }}</td>
                    <td class="col-md-1">{{ $item->formatRupiah('total') }}</td>
                    <td class="col-md-2">
                      <div class="d-flex flex-column">
                        <a href="{{ route('admin.invoice.show', urlencode($item->id_invoice)) }}" class="btn btn-outline-info btn-sm mb-2">
                          <i class="fa-solid fa-eye"></i> Detail
                        </a>
                        <a href="{{ route('admin.invoice.edit', $item->id) }}" class="btn btn-outline-success btn-sm mb-2">
                          <i class="fa-solid fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.invoice.cetak', urlencode($item->id_invoice)) }}" target="_blank" class="btn btn-outline-danger btn-sm mb-2">
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
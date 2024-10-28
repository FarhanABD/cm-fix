@extends('super-admin.layouts.master')
@section('content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('super-admmin.invoice.indexSuperAdmin') }}">Invoice</a>
          </li>
          <li class="breadcrumb-item">
            <a href="">Laporan</a>
          </li>
        </ol>
      </nav>

    <div class="card">
      <h4 class="card-header">
        <div class="alert alert-primary">
            <p><span class="font-weight-bold">Laporan Tanggal: {{ $dari }}  Sampai : {{ $sampai }} </span></p>
        </div>
      </h4> 
      <div class="card-body">
           <!-- Responsive Table -->
           <div class="card">
            <h5 class="cart-header">Filter Invoice Order</h5>

             <!-- Filter Tanggal -->
             <form id="filterForm" method="GET" action="{{ route('super-admin.invoice.cariSuperAdmin') }}" class="row mb-4">
              <div class="col-md-3">
                  <div class="form-group d-flex align-items-center">
                      <label style="margin-right: 8px" for="tanggalDari">Dari</label>
                      <input type="date" class="form-control" name="dari" id="tanggalDari" value="{{ $dari }}">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group d-flex align-items-center">
                      <label style="margin-right: 8px" for="tanggalSampai">Sampai</label>
                      <input type="date" class="form-control" name="sampai" id="tanggalSampai" value="{{ $sampai }}">
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
                    <th class="col-md-3">nama customer</th>
                    <th class="col-md-2">layanan</th>
                    <th class="col-md-2">paket</th>
                    <th class="col-md-3">tanggal langganan</th>
                    <th class="col-md-3">tanggal habis</th>
                    <th class="col-md-1">total</th>
                    <th class="col-md-2">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($transaksi as $item )
                  <tr>
                    <td class="col-md-1">{{ $loop->iteration }}</td>
                    <td class="col-md-2">{{ $item->id_invoice }}</td>
                    <td class="col-md-2">{{ $item->id_order }}</td>
                    <td class="col-md-3">{{ $item->nama_perusahaan }}</td>
                    <td class="text-wrap">{{ $item->jenis_layanan }}</td>
                    <td class="text-wrap">{{ $item->jenis_paket }}</td>
                    <td class="text-wrap">{{ $item->tanggal_langganan }}</td>
                    <td class="text-wrap">{{ $item->tanggal_habis }}</td>
                    <td class="col-md-1">{{ $item->formatRupiah('total') }}</td>
                    <td class="col-md-2">
                      <div class="d-flex flex-column">
                        <a href="{{ route('super-admin.invoice.showSuperAdmin', urlencode($item->id_order)) }}" class="btn btn-outline-info btn-sm mb-2">
                          <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('super-admin.invoice.editSuperAdmin', $item->id) }}" class="btn btn-outline-success btn-sm mb-2">
                          <i class="fa-solid fa-edit"></i>
                        </a>
                        <a href="/{{auth()->user()->level}}/laporan/{{$item->id_order}}/print" target="_blank" class="btn btn-outline-danger btn-sm mb-2">
                          <i class="fa-solid fa-print"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            {{-- {{ $dataTable->table() }} --}}
          </div>
          <!--/ Responsive Table -->
      </div>
  </div>
    <!--/ Basic Bootstrap Table -->

  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->

@endsection

@push('scripts')

<script>
  $(document).ready(function () {
      $('#table').DataTable();
  });

</script>
@endpush
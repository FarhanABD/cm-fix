@extends('admin.layouts.master')
@section('content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.reportcustomer.index') }}">Report Customer</a>
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
            <h5 class="cart-header">Filter Report Customer</h5>

             <!-- Filter Tanggal -->
             <form id="filterForm" method="GET" action="{{ route('admin.reportorder.cari') }}" class="mb-4 row">
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
              <div class="col-md-3 d-flex float-end">
                <a href="{{ route('admin.perusahaan.export_excel') }}" class="btn btn-success float-end" style="margin-left: 20px"><i class="fa-solid fa-file-excel"></i></a>
                <a href="{{ route('admin.perusahaan.export_excel') }}" class="btn btn-danger float-end" style="margin-left: 20px"><i class="fa-solid fa-file-pdf"></i></a>
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
                    <td class="">{{ $item->tanggal_langganan }}</td>
                    <td class="">
                      <div class="d-flex flex-column">
                        <a href="{{ route('admin.invoice.show', urlencode($item->id_order)) }}" class="mb-2 btn btn-outline-info btn-sm">
                          <i class="fa-solid fa-eye"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>
  </div>
  <div class="content-backdrop fade"></div>
</div>
@endsection

@push('scripts')

<script>
  $(document).ready(function () {
      $('#table').DataTable();
  });

</script>
@endpush
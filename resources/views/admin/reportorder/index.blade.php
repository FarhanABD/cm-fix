@extends('admin.layouts.master')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h4 class="card-header">Tabel Report Order
        <a href="{{ route('admin.reportorder.export_excel', ['dari' => request('dari'), 'sampai' => request('sampai')]) }}" class="btn btn-success float-end" style="margin-left: 20px">
          <i class="fa-solid fa-file-excel" style="font-size: 1.2rem;"></i>
        </a>
        <a href="{{ route('admin.reportorder.export_pdf', ['dari' => request('dari'), 'sampai' => request('sampai')]) }}" class="btn btn-danger float-end" style="margin-left: 20px">
          <i class="fa-solid fa-file-pdf" style="font-size: 1.2rem;"></i>
        </a>
        <a href="{{ route('admin.reportorder.diagram') }}" class="btn btn-info float-end" style="margin-left: 20px">
          <i class="fa-solid fa-chart-simple" style="font-size: 1.2rem;"></i>
        </a>  
      </h4> 
      <div class="card-body">
        <div class="card">
        <h5 class="cart-header">Filter Report Order</h5>
             <!-- Filter Tanggal -->
            <form id="filterForm" method="GET" action="{{ route('admin.reportorder.index') }}" class="mb-4 row">
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
 
          <!-- Responsive Table -->
          <div class="table-responsive text-nowrap">
            <table class="table" id="table">
              <thead>
                <tr class="text-nowrap">
                  <th>No</th>
                  <th>id_order</th>
                  <th>Total</th>
                  <th>Tanggal Langganan</th>
                  <th>Tanggal Habis</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->id_order }}</td>
                  <td>{{ $item->formatRupiah('total') }}</td>
                  <td>{{ $item->tanggal_langganan }}</td>
                  <td>{{ $item->tanggal_habis }}</td>
                  <td>
                    <a href="{{ route('admin.reportorder.show', urlencode($item->id_order)) }}" class="btn btn-sm btn-outline-info">
                      <i class="fa fa-eye"></i> Detail
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!--/ Responsive Table -->
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->
    <div class="content-backdrop fade"></div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function () {
    $('#table').DataTable();
  });
</script>
@endpush
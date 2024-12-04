@extends('admin.layouts.master')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h4 class="card-header">Report Maintenance
        <a href="{{ route('admin.reportmaintenance.export_excel') }}" class="btn btn-success float-end" style="margin-left: 20px">
          <i class="fa-solid fa-file-excel" style="font-size: 1.2rem;"></i>
        </a>
        <a href="{{ route('admin.reportmaintenance.export_pdf', ['dari' => request('dari'), 'sampai' => request('sampai')]) }}" class="btn btn-danger float-end" style="margin-left: 20px">
          <i class="fa-solid fa-file-pdf" style="font-size: 1.2rem;"></i>
        </a>
        <a href="{{ route('admin.reportmaintenance.diagram') }}" class="btn btn-info float-end" style="margin-left: 20px">
          <i class="fa-solid fa-chart-simple" style="font-size: 1.2rem;"></i>
        </a>
      </h4> 
      <div class="card-body">
        <div class="card">
        <h5 class="cart-header">Filter Report Maintenance</h5>
             <!-- Filter Tanggal -->
             <form id="filterForm" method="GET" action="{{ route('admin.reportmaintenance.index') }}" class="mb-4 row">
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
                  <th>id_invoice</th>
                  <th>id_order</th>
                  <th>tanggal langganan</th>
                  <th>tanggal habis</th>
                  <th>tanggal dibuat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($details as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->id_invoice }}</td>
                  <td>{{ $item->id_order }}</td>
                  <td>{{ $item->tanggal_langganan }}</td>
                  <td>{{ $item->tanggal_habis }}</td>
                  <td>{{ $item->created_at }}</td>
                  <td>
                    <a href="{{ route('admin.reportmaintenance.show', $item->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i> Detail</a>
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
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function () {
    $('#table').DataTable();
  });
</script>
@endpush
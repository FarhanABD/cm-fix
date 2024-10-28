@extends('admin.layouts.master')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h4 class="card-header">Tabel Report Maintenance
        <a href="{{ route('admin.reportmaintenance.export_excel') }}" class="btn btn-success float-end" style="margin-left: 20px">
          <i class="fa-solid fa-file-excel"></i>
        </a>
        <a href="{{ route('admin.reportmaintenance.export_pdf', ['dari' => request('dari'), 'sampai' => request('sampai')]) }}" class="btn btn-danger float-end" style="margin-left: 20px">
          <i class="fa-solid fa-file-pdf"></i>
        </a>
        <a href="{{ route('admin.reportmaintenance.diagram') }}" class="btn btn-info float-end" style="margin-left: 20px">
          <i class="fa-solid fa-chart-simple"></i>
        </a>
      </h4> 
      <div class="card-body">
        <div class="card">
        <h5 class="cart-header">Filter Report Maintenance</h5>
             <!-- Filter Tanggal -->
             <form id="filterForm" method="GET" action="{{ route('admin.reportmaintenance.index') }}" class="mb-4 row">
    <div class="col-md-3">
        <div class="form-group d-flex align-items-center">
            <label style="margin-right: 8px" for="tanggalDari">Dari</label>
            <input type="date" class="form-control" name="dari" id="tanggalDari" value="{{ request('dari') }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group d-flex align-items-center">
            <label style="margin-right: 8px" for="tanggalSampai">Sampai</label>
            <input type="date" class="form-control" name="sampai" id="tanggalSampai" value="{{ request('sampai') }}">
        </div>
    </div>
    <div class="col-md-3 d-flex align-items-center">
        <button type="submit" class="btn btn-primary">Filter</button>
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
                  <td>
                    <a href="{{ route('admin.reportmaintenance.show', urlencode($item->id_maintenance)) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i> Detail</a>
                    
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

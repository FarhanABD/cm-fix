@extends('admin.layouts.master')
@section('content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h4 class="card-header">Tabel Report Invoice
      <a href="{{ route('admin.reportinvoice.export_excel') }}" class="btn btn-success float-end" style="margin-left: 20px"><i class="fa-solid fa-file-excel"></i></a>
        <a href="{{ route('admin.reportinvoice.export_pdf', ['dari' => request('dari'), 'sampai' => request('sampai')])}}" class="btn btn-danger float-end" style="margin-left: 20px"><i class="fa-solid fa-file-pdf"></i></a>
        <a href="{{ route('admin.reportinvoice.diagram') }}" class="btn btn-info float-end" style="margin-left: 20px"><i class="fa-solid fa-chart-simple"></i></a>  
        </h4>
      <div class="card-body">
           <div class="card">
            <h5 class="cart-header">Filter Report Invoice</h5>
             <!-- Filter Tanggal -->
             <form id="filterForm" method="GET" action="{{ route('admin.reportinvoice.index') }}" class="mb-4 row">
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
                    <th>No</th>
                    <th>id_invoice</th>
                    <th>id_order</th>
                    <th>nama customer</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($details as $item )
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->id_invoice }}</td>
                    <td>{{ $item->id_order }}</td>
                    <td>{{ $item->nama_perusahaan }}</td>
                    <td>
                      <a href="{{ route('admin.reportinvoice.show', urlencode($item->id_invoice)) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i> Detail</a>
                      <a href="{{ route('admin.reportinvoice.cetak', urlencode($item->id_invoice)) }}" target="_blank" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-print"></i> Print Invoice
                      </a>
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
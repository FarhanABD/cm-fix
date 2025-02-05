@extends('admin.layouts.master')
@section('content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h4 class="card-header">Tabel Report Customer
      <a href="{{ route('super-admin.reportcustomer.exportexcel') }}" class="btn btn-success float-end" style="margin-left: 20px"><i class="fa-solid fa-file-excel"></i></a>
        <a href="{{ route('super-admin.reportcustomer.exportpdfSuperAdmin') }}" class="btn btn-danger float-end" style="margin-left: 20px"><i class="fa-solid fa-file-pdf"></i></a>
        <a href="{{ route('super-admin.reportcustomer.diagramSuperAdmin') }}" class="btn btn-info float-end" style="margin-left: 20px"><i class="fa-solid fa-chart-simple"></i></a>
        </h4>
      <div class="card-body">
           <div class="card">
            <h5 class="cart-header">Filter Report Customer</h5>
             <!-- Filter Tanggal -->
             <form id="filterForm" method="GET" action="" class="mb-4 row">
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
                    <th>id</th>
                    <th>id_perusahaan</th>
                    <th>email</th>
                    <th>nama_perusahaan</th>
                    <th>phone</th>
                    <th>alamat</th>
                    <th>nama_pic</th>
                    {{-- <th>aksi</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @foreach ($details as $item )
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->id_perusahaan }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->nama_perusahaan }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->nama_pic }}</td>
                    {{-- <td>
                      <a href="{{(urlencode($item->id_perusahaan)) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i> Detail</a>
                      <a href="/{{auth()->user()->level}}/laporan/{{$item->id_perusahaan}}/print" target="_blank" class="btn btn-sm btn-outline-danger"><i class="fa fa-print"></i> Print</a>
                  </td> --}}
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
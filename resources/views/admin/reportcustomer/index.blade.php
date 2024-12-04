@extends('admin.layouts.master')
@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <h4 class="card-header d-flex align-items-center justify-content-between">
        Tabel Report Customer
        <div class="flex-wrap gap-2 d-flex">
        <a href="{{ route('admin.reportcustomer.diagram') }}" class="btn btn-info">
    <i class="fa-solid fa-chart-simple"></i>
    </a>
    <a href="{{ route('admin.reportcustomer.exportpdf') }}" class="btn btn-danger">
        <i class="fa-solid fa-file-pdf"></i>
    </a>
    <a href="{{ route('admin.reportcustomer.exportexcel') }}" class="btn btn-success">
        <i class="fa-solid fa-file-excel"></i>
    </a>

          {{-- <a href="{{ route('admin.reportcustomer.diagram') }}" class="btn btn-info btn-sm">
            <i class="fa-solid fa-chart-simple"></i>
          </a>
          <a href="{{ route('admin.reportcustomer.exportpdf') }}" class="btn btn-danger btn-sm">
            <i class="fa-solid fa-file-pdf"></i>
          </a>
          <a href="{{ route('admin.reportcustomer.exportexcel') }}" class="btn btn-success btn-sm">
            <i class="fa-solid fa-file-excel"></i>
          </a> --}}
        </div>
      </h4>
      <div class="card-body">
        <div class="card">
          <h5 class="card-header">Filter Report Customer</h5>
          <form id="filterForm" method="GET" action="" class="mb-4 row g-3">
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
        </div>
        <div class="table-responsive text-nowrap">
          <table class="table" id="table">
            <thead>
              <tr class="text-nowrap">
                <th>ID</th>
                <th>ID Perusahaan</th>
                <th>Email</th>
                <th>Nama Perusahaan</th>
                <th>Phone</th>
                <th>Alamat</th>
                <th>Nama PIC</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($details as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->id_perusahaan }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->nama_perusahaan }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->nama_pic }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
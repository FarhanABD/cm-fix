@extends('admin.layouts.master')
@section('content')
 <!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel </span> Customer & PIC</h4>
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Data Customer & PIC
            <a href="{{ route('admin.perusahaan.create') }}" class="btn btn-danger float-end" style="margin-left: 20px">Create</a>
            <a href="{{ route('admin.perusahaan.export_excel') }}" class="btn btn-success float-end" style="margin-left: 20px"><i class="fa-solid fa-file-excel"></i></a>
            {{-- <a href="{{ route('admin.perusahaan.downloadFile') }}" class="btn btn-success float-end" style="margin-left: 20px"><i class="fa-solid fa-download"></i></a> --}}
            <a href="{{ route('admin.perusahaan.index') }}" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target ="#exampleModal"><i class="fa-solid fa-file-import"></i></a>
        </h5>
      <div class="card-body">
        {{ $dataTable->table() }}
      </div>
  </div>
    <!--/ Basic Bootstrap Table -->
  <div class="content-backdrop fade"></div>
</div>
@include('admin.perusahaan.modal')
<!-- Content wrapper -->
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush


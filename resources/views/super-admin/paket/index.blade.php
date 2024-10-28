@extends('super-admin.layouts.master')
@section('content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel</span> Paket</h4>
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Data Paket
          <a href="{{ route('super-admin.paket.createSuperAdmin') }}" class="btn btn-danger float-end">Create</a>
      </h5>
      <div class="card-body">
          {{ $dataTable->table() }}
      </div>
  </div>
    <!--/ Basic Bootstrap Table -->
  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

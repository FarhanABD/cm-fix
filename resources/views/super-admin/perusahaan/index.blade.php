@extends('super-admin.layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel</span> Customer</h4>

        <div class="card">
            <h5 class="card-header">Data Customer
                <a href="{{ route('super-admin.perusahaan.createSuperAdmin') }}" class="btn btn-danger float-end" style="margin-left: 20px">Create</a>
                <a href="{{ route('admin.perusahaan.export_excel') }}" class="btn btn-success float-end" style="margin-left: 20px"><i class="fa-solid fa-file-excel"></i></a>
                {{-- <a href="{{ route('admin.perusahaan.downloadFile') }}" class="btn btn-success float-end" style="margin-left: 20px"><i class="fa-solid fa-download"></i></a> --}}
                <a href="{{ route('admin.importcustomer') }}" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target ="#exampleModal"><i class="fa-solid fa-file-import"></i></a>
            </h5>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-top-company">
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="content-backdrop fade"></div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
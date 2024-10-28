@extends('admin.layouts.master')

@section('content')
 <!-- Responsive Table -->
 <div class="container-fluid" style="margin-top: 24px"> <!-- Menggunakan container-fluid untuk lebar penuh -->
    <div class="card">
        <h5 class="card-header">Detail Report Maintenance</h5>
        <div class="table-responsive text-nowrap">
            <table class="table" id="table">
                <thead>
                    <tr class="text-nowrap">
                        <th>No</th>
                        <th>id_invoice</th>
                        <th>id_order</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $item->id_invoice }}</td>
                         <td>{{ $item->id_order }}</td>
                         <td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="bg-white card-footer">
                <a href="{{ route('admin.reportinvoice.index') }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-caret-left"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>
<!--/ Responsive Table -->

@endsection
@push('script')
<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>
@endpush
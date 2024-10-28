@extends('super-admin.layouts.master')

@section('content')
 <!-- Responsive Table -->
 <div class="container-fluid" style="margin-top: 24px"> <!-- Menggunakan container-fluid untuk lebar penuh -->
    <div class="card">
        <h5 class="card-header">Detail Report Order</h5>
        <div class="table-responsive text-nowrap">
            <table class="table" id="table">
                <thead>
                    <tr class="text-nowrap">
                        <th class="">No</th>
                        <th class="">id_order</th>
                        <th class="">total</th>
                        <th class="">tanggal langganan</th>
                        <th class="">tanggal habis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->id_order}}</td>
                        <td>{{$item->total}}</td>
                        <td>{{$item->tanggal_langganan}}</td>
                        <td>{{$item->tanggal_habis}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer bg-white">
                <a href="{{ route('super-admin.reportorder.indexSuperAdmin') }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-caret-left"></i> Kembali</a>
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
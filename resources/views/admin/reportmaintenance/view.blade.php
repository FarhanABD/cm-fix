@extends('admin.layouts.master')

@section('content')
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
                        <th>Jenis Layanan</th>
                        <th>Jenis Paket</th>
                        <th>Sub Total</th>
                        <th>PPN</th>
                        <th>Grand Total</th>
                        <th>Tgl Langganan</th>
                        <th>Tgl Habis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $item->id_invoice }}</td>
                         <td>{{ $item->id_order }}</td>
                         <td>{{ $item->jenis_layanan }}</td>
                         <td>{{ $item->jenis_paket }}</td>
                         <td>{{ $item->total_amount }}</td>
                         <td>{{ $item->ppn }}</td>
                         <td>{{ $item->total }}</td>
                         <td>{{ $item->tanggal_langganan }}</td>
                         <td>{{ $item->tanggal_habis }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="bg-white card-footer">
                <a href="{{ route('admin.reportmaintenance.index') }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-caret-left"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>
@endpush
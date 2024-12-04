@extends('super-admin.layouts.master')

@section('content')
 <!-- Responsive Table -->
 <div class="container-fluid" style="margin-top: 24px"> <!-- Menggunakan container-fluid untuk lebar penuh -->
    <div class="card">
        <h5 class="card-header">Detail Order</h5>
        <div class="table-responsive text-nowrap">
            <table class="table" id="table">
                <thead>
                    <tr class="text-nowrap">
                        <th>No.</th>
                        <th>id order</th>
                        <th>id customer</th>
                        <th>nama customer</th>
                        <th>nama pic</th>
                        <th>Telepon pic</th>
                        <th>email pic</th>
                        <th>jenis layanan</th>
                        <th>harga</th>
                        <th>jumlah</th>
                        <th>total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->id_order}}</td>
                        <td>{{$item->id_perusahaan}}</td>
                        <td>{{$item->nama_perusahaan}}</td>
                        <td>{{$item->nama_pic}}</td>
                        <td>{{$item->phone_pic}}</td>
                        <td>{{$item->email_pic}}</td>
                        <td>{{$item->jenis_layanan}}</td>
                        <td>{{$item->formatRupiah('harga')}}</td>
                        <td>{{$item->jumlah}}</td>
                        <td>{{$item->harga * $item->jumlah}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer bg-white">
                <a href="{{ route('super-admin.maintenance.index') }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-caret-left"></i> Kembali</a>
                <a href="#" class="btn btn-sm btn-outline-warning"><i class="fa-solid fa-envelope"></i> Reminder</a> </ul> 
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
@extends('admin.layouts.master')

@section('content')
 <!-- Responsive Table -->
 <div class="container-fluid" style="margin-top: 24px"> <!-- Menggunakan container-fluid untuk lebar penuh -->
    <div class="card">
        <h5 class="card-header">Detail Invoices</h5>
        <div class="table-responsive text-nowrap">
            <table class="table" id="table">
                <thead>
                    <tr class="text-nowrap">
                        <th>No.</th>
                        <th>id invoice</th>
                        <th>id order</th>
                        <th>nama customer</th>
                        <th>jenis layanan</th>
                        <th>jenis paket</th>
                        <th>Tgl Langganan</th>
                        <th>Tgl Habis</th>
                        <th>alamat</th>
                        <th>nama pic</th>
                        <th>Telepon pic</th>
                        <th>email pic</th>
                        <th>item desc</th>
                        <th>PPN</th>
                        <th>total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->id_invoice}}</td>
                        <td>{{$item->id_order}}</td>
                        <td>{{$item->nama_perusahaan}}</td>
                        <td class="text-wrap">{{$item->jenis_layanan}}</td>
                        <td class="text-wrap">{{$item->jenis_paket}}</td>
                        <td>{{$item->tanggal_langganan}}</td>
                        <td>{{$item->tanggal_habis}}</td>
                        <td>{{$item->alamat}}</td>
                        <td>{{$item->nama_pic}}</td>
                        <td>{{$item->phone_pic}}</td>
                        <td>{{$item->email_pic}}</td>
                        <td>{{$item->item_desc}}</td>
                        <td>{{$item->ppn}}</td>
                        <td>{{$item->total}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer bg-white" style="margin-top: 8px">
                <a href="{{ route('admin.invoice.index') }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-caret-left"></i> Kembali</a>
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
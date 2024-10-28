@extends('super-admin.layouts.master')

@section('content')
<section class="section">
    <div class="container" style="padding-top: 20px">
        <div class="section-bodys">
            <div class="row">
                <div class="col-md-12">
                    <div class="cart shadow">
                        <div class="card-header bg-white">
                            <h4 class="position-absolute" style="margin-bottom: 12px;">
                                <a href="{{ route('super-admin.order.indexSuperAdmin') }}">
                                    <i class="fas fa-arrow-left" style="padding-right: 12px"></i>
                                </a>
                                Halaman Order Paket
                            </h4>
                            <div class="card-header-form float-end">
                                <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#data-paket">
                                    <i class="fa fa-plus"></i> Tambah
                                </button>
                            </div>         
                        </div>
                        <div class="cart-body p-2">
                          
                                <div class="row" style="padding-top: 20px; margin-left: 24px">
                                    <div class="col-md-2" style="margin-left: 4px">
                                        <div class="form-input-group">
                                            <label for="kode" class="form-label">ID Order</label>
                                            <input type="text" id="id_order" class="form-control" value="{{$nomor}}"
                                                name="id_order" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group" style="margin-left: 424%; padding-top: 12px">
                                            <label class="text-info" for="Total Belanja">Subtotal</label>
                                            <div class="input-group-prepend">
                                                <h3 class="text-info mr-2" style="font-size: 18px">Rp<br></h3>
                                                <input class="d-none" type="text" id="total" value="0" name="total">
                                                <h3 class="text-info" style="font-size: 22px" id="label-total">0</h3>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                           
                            
                            <div class="rounded" style="overflow-y: scroll; height: 300px;">
                                <table class="table table-bordered" id="table-transaksi">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Layanan</th>
                                            <th>Jenis Paket</th>
                                            <th>ID Paket</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Kuota</th>
                                            <th>Total</th> 
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $item)
                                            <tr>
                                                <td style="width: 8%">{{ $loop->iteration }}</td>
                                                <td style="width: 12%">{{ $item->paket->jenis_layanan ?? 'N/A' }}</td>
                                                <td style="width: 12%">{{ $item->paket->jenis_paket ?? 'N/A' }}</td>

                                                <td style="width: 12%">{{ $item->id_paket ?? 'N/A' }}</td>

                                                <td style="width: 12%" class="harga" value="{{$item->harga}}">
                                                    {{ $item->formatRupiah('harga') }}
                                                    <input type="text" value="{{$item->harga}}" name="harga" hidden>
                                                </td>
                                                <td class="jumlah" value="{{$item->jumlah}}" style="width: 10%">
                                                    <input type="text" class="form-control" value="{{$item->jumlah}}" name="jumlah" readonly>
                                                </td>
                                                <td style="width: 12%">{{ $item->kuota }}</td>
                                                <td class="total" style="width: 14%" value="{{$item->total}}"> {{ $item->formatRupiah('total') }}</td>
                                                <td style="width: 10%">
                                                    <div class="aksi d-flex" style="width: 10%">
                                                        <form action="/{{auth()->user()->role}}/cart/{{$item->id}}" id= "delete-form">
                                                            @csrf
                                                            @method('post') 
                                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                              </div>
                           
                              <div class="cart-footer">
                                <div class="d-flex justify-content-start align-items-center">
                                    <button type="button" id="bayar-modal" class="btn m-1 btn-outline-primary" data-bs-toggle="modal" data-bs-target="#form-bayar">Simpan</button>
                                    <a href="/{{auth()->user()->role}}/cart/hapus/semua" class="btn m-1 btn-outline-danger">Batal</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('super-admin.cart.data_paket')
@include('super-admin.cart.formBayar')  
@endsection

@push('scripts')

<script>
        var total = document.querySelectorAll('#table-transaksi tbody td.total');
        var label_total = document.getElementById('label-total');
        var sub_total = document.getElementById('total');
        var label_total_bayar = document.getElementById('label-total-bayar');
        var sub_total_bayar = document.getElementById('total-bayar');
        var bayarButton = document.getElementById('bayar-modal');

        // Inisialisasi variabel total
        var grandTotal = 0;
        
        // Iterasi melalui setiap elemen dan menjumlahkannya
        total.forEach(function (element) {
            var totalValue = parseFloat(element.getAttribute('value')) || 0;
            grandTotal += totalValue;
        });
        
        if (grandTotal == 0) {
            bayarButton.setAttribute('disabled', true);
        } else {
            bayarButton.removeAttribute('disabled');
        }
        
        // Tampilkan hasilnya di label_total dengan format mata uang Rupiah
        label_total.innerHTML = grandTotal.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        sub_total.value = grandTotal;
        label_total_bayar.innerHTML = grandTotal.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        sub_total_bayar.value = grandTotal

</script>

<script>
   function calculateSubtotalWithPPN() {
    const checkbox = document.getElementById('flexCheckDefault');
    const subtotal = parseFloat(document.getElementById('total').value);
    const ppn = subtotal * 0.11;
    let total = subtotal;

    if (checkbox.checked) {
        total += ppn;
    }

    // Update the displayed total
    document.getElementById('label-total-bayar').textContent = total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
    document.getElementById('label-total').textContent = total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });

    // Update hidden input value so it's submitted correctly
    document.getElementById('total-bayar').value = total;
}

</script>

<script>
    function simpan() {
        event.preventDefault()
        form_bayar = document.getElementById('form-penjualan');
        form_bayar.submit();
    }
</script>

<script>
    $('#paketSelect').change(function() {
        @json($perusahaans).
        forEach(element => {
            if (element.id == document.getElementById("paketSelect").value) {
                document.getElementById("namaPicSelect").value = element.nama_pic
                document.getElementById("emailPICSelect").value = element.email_pic
                document.getElementById("phonePICSelect").value = element.phone_pic
                document.getElementById("alamatPICSelect").value = element.alamat
                document.getElementById("namaCustomerSelect").value = element.nama_perusahaan
                document.getElementById("idPerusahaanSelect").value = element.id_perusahaan
                document.getElementById("statusSelect").value = 0 
            }
        });
    })
</script>

@endpush
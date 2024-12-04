@extends('super-admin.layouts.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <a href="{{ route('admin.invoice.index') }}" class="text-muted me-2">
          <i class="bx bx-arrow-back"></i>
        </a>
        <span class="text-muted fw-light">Forms/</span>Invoice
      </h4>
      <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create Invoice</h5>
                <small class="text-muted float-end">Silakan input data invoice</small>
              </div>
              <form action="{{ route('super-admin.invoice.storeSuperAdmin') }}"  method="POST" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Invoice No</label>
                        <input type="text" class="form-control" name="id_invoice" id="id_invoice" placeholder="Masukkan nomer invoice" /> 
                      </div>
                      <div class="mb-3"  style="margin-top: 8px">
                        <label for="orderSelect" class="form-label">ID Order</label>
                        <select class="form-select data-perusahaan" id="orderSelect" name="id_order">
                            <option selected>Pilih ID Order</option>
                            @foreach ($orders as $item)
                                <option value="{{ $item->id_order }}">{{ $item->id_order}}</option>
                            @endforeach
                        </select>
                    </div>
                      <div class="mb-3">
                      <div style="display: flex; align-items: center;">
                     <div style="margin-right: 10px;">
                        <label class="form-label" for="date" style="font-size: 12px;">Tanggal Langganan</label><br>
                        <input type="date" class="form-control" id="tanggal_langganan_datepicker" name="tanggal_langganan">
                        </div>
                        <div>
                         <label class="form-label" for="due-date" style="font-size: 12px;">Tanggal Habis</label><br>
                            <input type="date" id="tanggal_habis_datepicker" name="tanggal_habis" class="form-control"> </div>
                            </div>
                            </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nama Customer</label>
                    <input type="text" class="form-control" id="namaPerusahaan" name="nama_perusahaan" readonly />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Alamat</label>
                    <input type="text" class="form-control" id="alamatSelect" name="alamat" />
                  </div>
                  <div class="mb-3">
                  <div style="display: flex; align-items: center;">
                    <div style="margin-right: 2px;">
                    <label class="form-label" for="basic-default-company">Kota</label>
                    <input type="text" class="form-control" id="kotaSelect" placeholder= "Masukkan kota" name="kota" />
                  </div>
                  <div style="margin-left: 8px">
                    <label class="form-label" for="basic-default-company">Provinsi</label>
                    <input type="text" class="form-control" id="provinsiSelect" placeholder="Masukkan provinsi" name="provinsi" />
                  </div>
                  <div style="margin-left: 8px">
                    <label class="form-label" for="basic-default-company">Negara</label>
                    <input type="text" class="form-control" id="countrySelect" placeholder="Indonesia" name="country" value="Indonesia" />
                </div>
                  </div>
                  </div>
              </div>
            </div>
          </div>
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label" for="basic-default-phone">Nama PIC</label>
                <input type="text" id="namaPICselect" class="form-control phone-mask" name="nama_pic"/>
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-default-phone">No Telfon</label>
                <input type="text" id="phoneSelect" class="form-control phone-mask" name="phone_pic" readonly/>
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-default-email">Email</label>
                <div class="input-group input-group-merge">
                  <input type="text" id="emailSelect" class="form-control" name="email_pic" aria-describedby="basic-default-email2" readonly/>
                  <span class="input-group-text" id="emailSelect"></span>
                </div>
                <div class="form-text">Anda dapat menggunakan huruf, angka, dan titik</div>
              </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Item Description</label>
                    <input type="text" class="form-control" id="descSelect" name="item_desc" />
                  </div>
                  <div class="mb-4">
                    <div style="display: flex; align-items: center;">
                      <div style="margin-right: 10px;">
                        <label class="form-label" for="basic-default-company">Jenis Layanan</label>
                        <textarea class="form-control" name="jenis_layanan" id="jenis-layananSelect"></textarea>
                    </div>
                      <div style="margin-left: 54px">
                    <label class="form-label" for="basic-default-company">Jenis Paket</label>
                    <textarea class="form-control" name="jenis_paket" id="jenis-paketSelect"></textarea>
                          </div>
                      <div style="margin-left: 54px">
                    <label class="form-label" for="basic-default-company">qty</label>
                    <textarea class="form-control" name="qty" id="qty-paketSelect"></textarea>
                          </div>
                        </div>
                      </div>
                  {{-- </div> --}}
                  <div class="mb-3">
                    <input type="text" class="form-control" id="price-paketSelect" placeholder="Masukkan total keseluruhan" name="price" hidden/>
                  </div>
                  <div class="mb-3">
                    <input type="text" class="form-control" id="ppn-paketSelect" placeholder="Masukkan ppn keseluruhan" name="ppn" hidden/>
                  </div>
                  <div class="mb-3">
                    <input type="text" class="form-control" id="totalamount-paketSelect" placeholder="Masukkan Total Amount" name="total_amount" hidden/>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Total</label>
                    <input type="text" class="form-control" id="totalSelect" placeholder="Masukkan total keseluruhan" name="total"/>
                  </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    </div>
    <!-- / Content -->
    <div class="layout-overlay layout-menu-toggle"></div>
@endsection

@push('scripts')
<script>
 $('#orderSelect').change(function() {
    let selectedOrderId = $(this).val();
    let selectedOrder = @json($orders).find(order => order.id_order == selectedOrderId);

    if (selectedOrder) {
        let jenisLayananList = selectedOrder.transaksi_details.map(detail => detail.jenis_layanan).join(',\n');
        $('#jenis-layananSelect').val(jenisLayananList);
        let jenisPaketList = selectedOrder.transaksi_details.map(detail => detail.jenis_paket).join(',\n');
        $('#jenis-paketSelect').val(jenisPaketList);
        let qtyPaketList = selectedOrder.transaksi_details.map(detail => detail.jumlah).join(',\n');
        $('#qty-paketSelect').val(qtyPaketList);
        let pricePaketList = selectedOrder.transaksi_details.map(detail => detail.harga).join(',\n');
        $('#price-paketSelect').val(pricePaketList);
      
        console.log(selectedOrder);
        let formattedTotal = selectedOrder.formatted_total;
        let formattedppn = selectedOrder.ppn;
        let formattedTotalAmount = selectedOrder.total_amount;
        $('#totalSelect').val(formattedTotal);
        $('#ppn-paketSelect').val(formattedppn);
        $('#totalamount-paketSelect').val(formattedTotalAmount);
        $('#tanggal_langganan_datepicker').val(selectedOrder.tanggal_langganan);
        $('#tanggal_habis_datepicker').val(selectedOrder.tanggal_habis);

        // Cek apakah data perusahaan tersedia
        if (selectedOrder.transaksi_details.length > 0) {
            let perusahaan = selectedOrder.transaksi_details[0].perusahaan;
            if (perusahaan) {
                $('#namaPerusahaan').val(perusahaan.nama_perusahaan || 'Tidak tersedia');
                $('#alamatSelect').val(perusahaan.alamat || 'Tidak tersedia');
                $('#phoneSelect').val(selectedOrder.transaksi_details[0].phone_pic || 'Tidak tersedia');
                $('#emailSelect').val(selectedOrder.transaksi_details[0].email_pic || 'Tidak tersedia');
                $('#namaPICselect').val(selectedOrder.transaksi_details[0].nama_pic || 'Tidak tersedia');
            } else {
                console.log('Perusahaan tidak ditemukan pada transaksi detail');
            }
        } else {
            console.log('Transaksi details kosong');
        }
    } else {
        // Kosongkan field jika tidak ada data
        $('#totalSelect, #namaPerusahaan, #alamatSelect, #phoneSelect, #emailSelect, #namaPICselect, #jenis-layananSelect, #jenis-paketSelect').val('');
    }
});
  </script>

  <script>
    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: `
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            `,
            confirmButtonText: 'OK'
        });
    @endif

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            confirmButtonText: 'OK'
        });
    @endif
  </script>
@endpush
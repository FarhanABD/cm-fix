<div class="modal fade" id="form-bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-info" id="exampleModalLabel">Konfirmasi Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="margin-top: 8px">
                <div class="cart">
                    <div class="cart-body">
                        <form action="{{ route('super-admin.cart.bayarSuperAdmin') }}" method="POST" id="form-penjualan" enctype="multipart/form-data">
                            @csrf
                            <!---------- FIELD ID_ORDER ----------->
                            <input type="text" id="kode-transaksi" class="form-control" value="{{$nomor}}"
                                name="id_order" readonly hidden>

                            <input type="text" id="alamatPICSelect" class="form-control" name="alamat" readonly hidden>

                            <input type="text" id="statusSelect" class="form-control" name="status" readonly hidden>

                            <input type="text" id="namaCustomerSelect" class="form-control" name="nama_perusahaan" readonly hidden>

                            <input type="text" id="idPerusahaanSelect" class="form-control" name="id_perusahaan" readonly hidden>
                                
                                  <!---------- FIELD ID_CUSTOMER ----------->
                                  <div class="form-group"  style="margin-top: 8px">
                                        <label for="paketSelect" class="form-label">Nama Customer</label>
                                        <select class="form-select data-perusahaan" id="paketSelect" name="no_perusahaan">
                                            <option selected>Pilih Customer</option>
                                            @foreach ($perusahaans as $perusahaan)
                                                <option value="{{ $perusahaan->id }}">{{ $perusahaan->nama_perusahaan }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                    <!---------- FIELD NAMA_PIC ----------->
                                    <div class="form-group" style="margin-top: 8px">
                                        <div class="form-group">
                                            <label for="namaPicSelect" class="form-label">Nama PIC</label>
                                            <input type="text" id="namaPicSelect" class="form-control" name="nama_pic">
                                        </div>
                                    </div>
                                        <div class="form-group" style="margin-top: 8px">
                                            <label for="emailPICSelect" class="form-label">Email PIC</label>
                                            <input type="text" id="emailPICSelect" class="form-control" name="email_pic">
                                        </div>
                                        <div class="form-group" style="margin-top: 8px">
                                            <label for="phonePICSelect" class="form-label">Phone PIC</label>
                                            <input type="text" id="phonePICSelect" class="form-control" name="phone_pic" >
                                        </div>
                                        <div class="row" style="margin-top: 8px">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="TanggalLangganan" class="form-label">Tanggal Langganan</label>
                                                    <input type="date" id="datepicker" class="form-control" name="tanggal_langganan" min="<?php echo date('Y-m-d'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="TanggalHabis" class="form-label">Tanggal Habis</label>
                                                    <input type="date"  id="datepicker" class="form-control" name="tanggal_habis" min="<?php echo date('Y-m-d'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    
                                 <!---------- FIELD SUBTOTAL ----------->
                                <div class="form-group" style="margin-top: 28px">
                                    <label for="Total Belanja" style="font-size: 16px">Subtotal</label>
                                    <div class="input-group-prepend">
                                        <h2 class="text-info mr-2" style="font-size: 20px">Rp<br></h2>
                                        <input type="hidden" id="total-bayar" name="total" value="0">
                                        <h3 class="text-info" id="label-total-bayar" style="font-size: 20px">0</h3>
                                    </div>
                                </div>
                            <div class="row">
                            </div>
                            <!---------- CART FOOTER SECTION ----------->
                            <div class="cart-footer" >
                                <div class="d-flex justify-content-start align-items-center">
                                    <button type="button" class="btn m-1 btn-outline-primary float-right" data-toggle="modal" onclick="simpan()">Bayar</button>
                                      <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onchange="calculateSubtotalWithPPN()">
                                            <label class="form-check-label" style="font-size: 16px" for="flexCheckDefault">
                                                Include PPN 11%
                                            </label>
                                        </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
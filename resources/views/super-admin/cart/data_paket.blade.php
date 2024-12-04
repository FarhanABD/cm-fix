<!-- Modal -->
<div class="modal fade" id="data-paket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Paket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="cart">
                    <div class="cart-body">
                        <div style="overflow-y: scroll; max-height: 400px;">
                            <table class="table table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th hidden>No Paket</th>
                                        <th>Jenis Layanan</th>
                                        <th>Jenis Paket</th>
                                        <th>id_paket</th>
                                        <th>Harga</th>
                                        <th>Kuota</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paket as $item)
                                    <tr>
                                        <form action="{{ route('super-admin.cart.storeSuperAdmin') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <td>{{ $loop->iteration }}<input class="form-control" type="text" value="{{ $nomor }}" name="id_order" hidden></td>
                                            <td hidden>{{ $item->id }}<input class="form-control" type="text" value="{{ $item->id }}" name="no_paket" hidden></td>
                                            <td>{{ $item->jenis_layanan }}<input class="form-control" type="text" value="{{ $item->id_paket }}" name="id_paket" hidden></td>
                                            <td>{{ $item->jenis_paket }}</td>
                                            <td>{{ $item->id_paket }}</td>
                                            <td>{{ $item->formatRupiah('harga') }}<input class="form-control" type="text" value="{{ $item->harga }}" name="harga" hidden></td>
                                            <td>{{ $item->kuota }}<input class="form-control" type="text" value="{{ $item->kuota }}" name="kuota" hidden></td>
                                            <td style="width: 15%"><input class="form-control jumlah" type="number" name="jumlah" id="jumlah" value="1" min="1"></td>
                                            <td><button type="submit" id="tambah" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button></td>
                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="margin-right: 50px; padding-top: 24px; padding-bottom: 12px" class="float-end">
                                <span>Ingin menambah Paket Custom ?<a href="{{ route('super-admin.paket.createSuperAdmin') }}"> Klik Disini</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

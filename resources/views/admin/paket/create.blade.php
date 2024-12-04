
@extends('admin.layouts.master')

@section('content')
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">
                <a href="{{ route('admin.paket.index') }}" class="text-muted me-2">
                    <i class="bx bx-arrow-back"></i>
                </a>
                <span class="text-muted fw-light">Form Create/</span> Data Paket
              </h4>

              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Create Paket</h5>

                    </div>
                    <div class="card-body">
                      <form action="{{ route('admin.paket.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="idLayananInput">id paket</label>
                            <input type="text" class="form-control" id="idLayananInput" name="id_paket" value="{{ $newIdPaket }}" readonly/>
                          </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Jenis Layanan</label>
                            <select class="form-select" id="layananSelect" name="jenis_layanan">
                              <option selected value="" data-deskripsi="">Silahkan pilih jenis layanan yang diinginkan</option>
                              @foreach ($layanans as $layanan)
                              <option value="{{ $layanan->jenis_layanan }}" data-deskripsi="{{ $layanan->deskripsi_layanan }}">
                                {{ $layanan->jenis_layanan }}
                              </option>
                              @endforeach
                            </select>
                          </div>
                          
                          <div class="mb-3">
                            <label class="form-label" for="harga">Deskripsi Layanan</label>
                            <textarea name="deskripsi_layanan" id="deskripsiLayanan" class="form-control" placeholder="Berikan Deskripsi Layanan"></textarea>
                          </div>

                            <div class="mb-3">
                              <label for="paketSelect" class="form-label">Jenis Paket</label>
                              <select class="form-select" id="paketSelect" name="jenis_paket">
                                <option selected value="" data-deskripsi="">Pilih jenis paket</option>
                                @foreach ($JenisPaket as $jenispakets)
                                <option value="{{ $jenispakets->jenis_paket }}" data-deskripsi="{{ $jenispakets->deskripsi_paket }}">
                                  {{ $jenispakets->jenis_paket }}
                                </option>
                                @endforeach
                              </select>
                              
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="harga">Deskripsi Paket</label>
                            <textarea name="deskripsi_paket" id="deskripsiPaket" class="form-control" placeholder="Berikan Deskripsi Paket"></textarea>
                          </div>
                        

                          <div class="mb-3" id="kuotaCustomField" style="display: block;">
                            <label class="form-label" for="kuotaInput">Kuota</label>
                            <input type="text" class="form-control" id="kuotaInput" placeholder="Masukkan kuota custom" name="kuota" value="">
                          </div>
                        <div class="mb-3">
                            <label class="form-label" for="harga">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga" />
                          </div>
                          <button type="submit" class="btn btn-success">Simpan   <i class="fa-solid fa-floppy-disk" style="padding-left: 4px"></i></button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="content-backdrop fade"></div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
      <!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
@endsection

@push('scripts')
<script>
  document.getElementById('layananSelect').addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const deskripsi = selectedOption.getAttribute('data-deskripsi');
    document.getElementById('deskripsiLayanan').value = deskripsi || '';
});

document.getElementById('paketSelect').addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const deskripsi = selectedOption.getAttribute('data-deskripsi');
    document.getElementById('deskripsiPaket').value = deskripsi || '';
});


</script>

@endpush
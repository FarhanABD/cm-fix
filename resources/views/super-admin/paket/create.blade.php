@extends('super-admin.layouts.master')

@section('content')
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">
                <a href="{{ route('super-admin.paket.indexSuperAdmin') }}" class="text-muted me-2">
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
                      <form action="{{ route('super-admin.paket.storeSuperAdmin') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="idLayananInput">id paket</label>
                            <input type="text" class="form-control" id="idLayananInput" name="id_paket" value="{{ $newIdPaket }}" readonly/>
                          </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Jenis Layanan</label>
                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="jenis_layanan">
                              <option selected>Silahkan pilih jenis layanan yang diinginkan</option>
                              @foreach ($layanans as $layanan )
                              <option value="{{ $layanan->jenis_layanan }}">{{ $layanan->jenis_layanan }}</option>
                              @endforeach
                           
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="paketSelect" class="form-label">Jenis Paket</label>
                            <select class="form-select" id="paketSelect" aria-label="Default select example" name="jenis_paket">
                              <option selected>Pilih jenis paket</option>
                              <option value="silver">Silver-500MB</option>
                              <option value="gold">Gold-1GB</option>
                              <option value="platinum">Platinum-2,5GB</option>
                              <option value="custom">Custom</option>
                            </select>
                          </div>
                          <div class="mb-3" id="kuotaCustomField" style="display: block;">
                            <label class="form-label" for="kuotaInput">Kuota</label>
                            <input type="text" class="form-control" id="kuotaInput" placeholder="Masukkan kuota custom" name="kuota" value="">
                          </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Harga</label>
                            <input type="text" class="form-control" id="basic-default-company" name="harga" />
                          </div>
                          <button type="submit" class="btn btn-success">Simpan   <i class="fa-solid fa-floppy-disk" style="padding-left: 4px"></i></button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script>
              document.getElementById('paketSelect').addEventListener('change', function() {
                  var kuotaCustomField = document.getElementById('kuotaCustomField');
                  var kuotaInput = document.getElementById('kuotaInput');
              
                  if (this.value === 'custom') {
                      kuotaCustomField.style.display = 'block';
                      kuotaInput.value = ''; // Kosongkan nilai kuota jika custom
                  } else {
                      kuotaCustomField.style.display = 'block';
                      switch (this.value) {
                          case 'silver':
                              kuotaInput.value = '500MB';
                              break;
                          case 'gold':
                              kuotaInput.value = '1GB';
                              break;
                          case 'platinum':
                              kuotaInput.value = '2,5GB';
                              break;
                      }
                  }
              });
              </script>
            <div class="content-backdrop fade"></div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

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
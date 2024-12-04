
@extends('admin.layouts.master')

@section('content')
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">
                <a href="{{ route('admin.paket.index') }}" class="text-muted me-2">
                    <i class="bx bx-arrow-back"></i>
                </a>
                <span class="text-muted fw-light">Form Create/</span> Jenis Paket
              </h4>

              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Create Jenis Paket</h5>

                    </div>
                    <div class="card-body">
                      <form action="{{ route('admin.jenis-paket.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label class="form-label" >Jenis Paket</label>
                          <input type="text" class="form-control" id="jenis-paket" name="jenis_paket" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="harga">Deskripsi</label>
                          <textarea name="deskripsi_paket" id="basic-icon-default-message" class="form-control" placeholder="Berikan Deskripsi Paket" aria-describedby="basic-icon-default-message2"></textarea>
                        </div>
                          <button type="submit" class="btn btn-success">Simpan   <i class="fa-solid fa-floppy-disk" style="padding-left: 4px"></i></button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- <script>
              document.getElementById('paketSelect').addEventListener('change', function() {
                  var kuotaCustomField = document.getElementById('kuotaCustomField');
                  var kuotaInput = document.getElementById('kuotaInput');
                  var hargaInput = document.getElementById('harga')
              
                  if (this.value === 'custom') {
                      kuotaCustomField.style.display = 'block';
                      kuotaInput.value = ''; // Kosongkan nilai kuota jika custom
                  } else {
                      kuotaCustomField.style.display = 'block';
                      switch (this.value) {
                          case 'silver':
                              kuotaInput.value = '500MB';
                              hargaInput.value = '500000';
                              break;
                          case 'gold':
                              kuotaInput.value = '1GB';
                              hargaInput.value = '1000000';
                              break;
                          case 'platinum':
                              kuotaInput.value = '2,5GB';
                              hargaInput.value = '1500000';
                              break;
                          case 'branding':  // Handle the new "branding" option
                              kuotaInput.value = '-';  
                              hargaInput.value = '1000000';  break;    
                      }
                  }
              });
              </script> --}}
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
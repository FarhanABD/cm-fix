@extends('super-admin.layouts.master')

@section('content')

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4">
                    <a href="{{ route('super-admin.layanan.index') }}" class="text-muted me-2">
                        <i class="bx bx-arrow-back"></i>
                    </a>
                    <span class="text-muted fw-light">Form Create /</span> Data Layanan dan Paket
                  </h4>
              <!-- Basic Layout -->
               
              <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                      <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Master Layanan</h5>
                      </div>
                      <div class="card-body">
                        <form action="{{ route('super-admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="mb-3">
                            <label for="jenisLayananSelect" class="form-label">Jenis Layanan</label>
                            <select class="form-select" id="jenisLayananSelect" aria-label="Default select example" name="jenis_layanan">
                              <option selected>Pilih jenis layanan</option>
                              <option value="branding-design">Branding & Design</option>
                              <option value="web-development">Website Development</option>
                              <option value="web-based-&-mobile-app">Web based & Mobile App</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="paketSelect" class="form-label">Nama Paket</label>
                            <select class="form-select" id="paketSelect" aria-label="Default select example" name="jenis_paket">
                              <option selected>Pilih jenis paket</option>
                              <option value="silver">Silver-500MB</option>
                              <option value="gold">Gold-1GB</option>
                              <option value="platinum">Platinum-2,5GB</option>
                              <option value="custom">Custom</option>
                            </select>
                          </div>
                  
                          <!-- Field Kuota Custom -->
                          <div class="mb-3" id="kuotaCustomField" style="display: none;">
                            <label class="form-label" for="kuotaInput">Kuota Custom</label>
                            <input type="text" class="form-control" id="kuotaInput" placeholder="Masukkan kuota custom" name="kuota" value="">
                          </div>
                  
                          <div class="mb-3">
                            <label class="form-label" for="hargaInput">Harga</label>
                            <input type="text" class="form-control" id="hargaInput" placeholder="Masukkan harga" name="harga" />
                          </div>
                          <button type="submit" class="btn btn-primary">Send</button>
                        </form>
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
                            kuotaCustomField.style.display = 'none';
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
          </div>
          <!-- Content wrapper -->
        
      </div>
    </div>
@endsection




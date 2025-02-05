@extends('super-admin.layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
          <a href="{{ route('super-admin.perusahaan.indexSuperAdmin') }}" class="text-muted me-2">
              <i class="bx bx-arrow-back"></i>
          </a>
          <span class="text-muted fw-light">Form Update / </span> Data Customer & Data PIC
      </h4>
          <!-- Basic Layout -->
          <div class="row">
            <?php $activeTab = session('activeTab', 'company'); ?>
              <!-- Tabulasi -->
              <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button
                            type="button"
                            class="nav-link {{ $activeTab == 'company' ? 'active' : '' }}"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-top-company"
                            aria-controls="navs-top-company"
                            aria-selected="{{ $activeTab == 'company' ? 'true' : 'false' }}">
                            Data Customer
                        </button>
                    </li>
                    <li class="nav-item">
                        <button
                            type="button"
                            class="nav-link {{ $activeTab == 'pic' ? 'active' : '' }}"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-top-pic"
                            aria-controls="navs-top-pic"
                            aria-selected="{{ $activeTab == 'pic' ? 'true' : 'false' }}">
                            Data PIC
                        </button>
                    </li>
                </ul>
            </div>
            
              
              <div class="tab-content">
                  <!-- Data Perusahaan -->
                  <div class="tab-pane fade {{ $activeTab == 'company' ? 'show active' : '' }}" id="navs-top-company" role="tabpanel">
                      <div class="col-xl">
                          <div class="card mb-4">
                              <div class="card-header d-flex justify-content-between align-items-center">
                                  <h5 class="mb-0">Data Customer</h5>
                              </div>
                              <div class="card-body">
                                  <!-- Form Data Perusahaan -->
                                  <form action="{{ route('super-admin.perusahaan.updateSuperAdmin',$perusahaans->id) }}" method="POST" enctype="multipart/form-data">
                                      @csrf
                                      @method('PUT')
                                      <div class="mb-3">
                                        <label class="form-label" for="idLayananInput" >ID Customer</label>
                                        <input type="text" class="form-control" id="idLayananInput" name="id_perusahaan" value="{{ $perusahaans->id_perusahaan }}" readonly />
                                      </div>

                                      <div class="mb-3">
                                        <label class="form-label" for="basic-default-company">Nama Customer</label>
                                        <input type="text" class="form-control" id="basic-default-company" name="nama_perusahaan" value="{{ $perusahaans->nama_perusahaan }}" />
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="basic-default-email">Email Customer</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="basic-default-email" class="form-control" name="email" value="{{ $perusahaans->email }}"  aria-describedby="basic-default-email2" />
                                        </div>
                                        <div class="form-text">Anda dapat menggunakan huruf, angka, dan titik</div>
                                    </div>

                                    <div class="mb-3">
                                      <label class="form-label" for="basic-default-company">Nama Website</label>
                                      <input type="text" name="nama_website" class="form-control" id="basic-default-company" value="{{ $perusahaans->nama_website }}" />
                                    </div>

                                    <div class="row">
                                      <div class="col-md-4">
                                          <label class="form-label" for="basic-default-company1">Kota</label>
                                          <div class="input-group input-group-merge required">
                                            <input type="text" name="kota" class="form-control" id="basic-default-company1" value="{{ $perusahaans->kota }}" " />
                                          </div>
                                        
                                      </div>
                                      <div class="col-md-4">
                                          <label class="form-label" for="basic-default-company2">Provinsi</label>
                                          <div class="input-group input-group-merge required">
                                            <input type="text" name="provinsi" class="form-control" id="basic-default-company1" value="{{ $perusahaans->provinsi }}" />
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                        <label class="form-label" for="basic-default-company3">Negara</label>
                                        <div class="input-group input-group-merge required">
                                            <input type="text" name="negara" class="form-control" id="basic-default-company1" value="{{ $perusahaans->negara }}" />
                                        </div>
                                    </div>
                                  </div>

                                    <div class="mb-3">
                                      <label class="form-label" for="basic-default-phone">No telepon</label>
                                      <input
                                        type="text"
                                        name="phone"
                                        id="basic-default-phone"
                                        class="form-control phone-mask"
                                        value="{{ $perusahaans->phone }}"
                                      />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label" for="basic-default-company">Keterangan</label>
                                      <input type="text" name="keterangan" class="form-control" id="basic-default-company" value="{{ $perusahaans->keterangan }}" />
                                    </div>

                                 

                                    <div class="row justify-content-start">
                                      <div class="col-sm-10">
                                        <button type="button" id="send-company-form" class="btn btn-primary">Next  <i class="fa-solid fa-arrow-right" style="padding-left: 4px"></i></button>
                                      </div>
                                    </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  
                  <!-- Data PIC -->
                  <div class="tab-pane fade {{ $activeTab == 'pic' ? 'show active' : '' }}" id="navs-top-pic" role="tabpanel">
                    <div class="col-xxl">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Data PIC</h5>
                                <small class="text-muted float-end">Update data PIC</small>
                            </div>
                            <div class="card-body">
                                <!-- Form Data PIC -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama PIC</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                            <input name="nama_pic" type="text" class="form-control" id="basic-icon-default-fullname" value="{{ $perusahaans->nama_pic }}" aria-label="Masukkan nama PIC" aria-describedby="basic-icon-default-fullname2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                  <label class="col-sm-2 form-label" for="basic-icon-default-phone">No telfon</label>
                                  <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                      <span id="basic-icon-default-phone2" class="input-group-text"
                                        ><i class="bx bx-phone"></i
                                      ></span>
                                      <input
                                        name="phone_pic"
                                        type="text"
                                        id="basic-icon-default-phone"
                                        class="form-control phone-mask"
                                        value="{{ $perusahaans->phone_pic }}"
                                        aria-label="Masukkan nomer telfon"
                                        aria-describedby="basic-icon-default-phone2"
                                      />
                                    </div>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email PIC</label>
                                  <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                      <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                      <input
                                        name="email_pic"
                                        type="text"
                                        id="basic-icon-default-email"
                                        class="form-control"
                                        value="{{ $perusahaans->email_pic }}"
                                        aria-label="Masukkan email"
                                        aria-describedby="basic-icon-default-email2"
                                      />
                                      <span id="basic-icon-default-email2" class="input-group-text">@contoh.com</span>
                                    </div>
                                    <div class="form-text">Anda dapat menggunakan huruf, angka, dan titik</div>
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label class="col-sm-2 form-label" for="basic-icon-default-message">Keterangan</label>
                                  <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                      <span id="basic-icon-default-message2" class="input-group-text"
                                        ><i class="bx bx-comment"></i
                                      ></span>
                                      <textarea
                                        name="keterangan_pic"
                                        id="basic-icon-default-message"
                                        class="form-control"
                                        value="{{ $perusahaans->keterangan_pic }}"
                                        aria-describedby="basic-icon-default-message2"
                                      ></textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="row justify-content-start">
                                  <div class="col-sm-10">
                                    <button type="submit" class="btn btn-success">Simpan   <i class="fa-solid fa-floppy-disk" style="padding-left: 4px"></i></button>
                                  </div>
                                </div>
                              </form>
                              <!-- / Form Data PIC ENDS -->
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
  </div>
  <!-- / Content -->
</div>
<script>
  // Fungsi untuk menyimpan input ke localStorage saat tombol Next ditekan
  document.getElementById('send-company-form').addEventListener('click', function(event) {
      event.preventDefault(); // Mencegah form submit
  
      // Pindah ke tab Data PIC
      var triggerEl = document.querySelector('button[data-bs-target="#navs-top-pic"]'); // Selector tab PIC
      var tabInstance = new bootstrap.Tab(triggerEl);
      tabInstance.show();
  });
  
  </script>
  

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



<!-- Script Bootstrap, pastikan sudah include -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection


 

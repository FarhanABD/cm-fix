{{-- @extends('admin.layouts.master')

@section('content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Perusahaan & PIC</h4>

      <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h5 class="mb-0">Data Perusahaan</h5>
                  <small class="text-muted float-end">Tolong isi data perusahaan</small>
                </div>
                <div class="card-body">
                  <form action="{{ route('admin.perusahaan.store') }}" method="POST" >
                    @csrf
                   
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" style="font-size: 11px;" for="basic-icon-default-company">Perusahaan</label>
                      <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-company2" class="input-group-text"
                            ><i class="bx bx-buildings"></i
                          ></span>
                          <input
                            type="text"
                            id="basic-icon-default-company"
                            class="form-control"
                            placeholder="Nama perusahaan"
                            aria-label="Nama perusahaan"
                            aria-describedby="basic-icon-default-company2"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Alamat</label>
                      <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-company2" class="input-group-text">
                            <!-- ><i class="fa-solid fa-house"></i> -->
                            <img src="{{ asset('storage/img/house-solid.svg') }}" alt="Logo" width="10px">
                          </span>
                          <input
                            type="text"
                            id="basic-icon-default-company"
                            class="form-control"
                            placeholder="Alamat perusahaan"
                            aria-label="Alamat perusahaan"
                            aria-describedby="basic-icon-default-company2"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="basic-icon-default-phone">Nomer Telepon</label>
                      <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-phone2" class="input-group-text"
                            ><i class="bx bx-phone"></i
                          ></span>
                          <input
                            type="text"
                            id="basic-icon-default-phone"
                            class="form-control phone-mask"
                            placeholder="Masukkan nomer telepon"
                            aria-label="Masukkan nomer telepon"
                            aria-describedby="basic-icon-default-phone2"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
                      <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                          <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                          <input
                            type="text"
                            id="basic-icon-default-email"
                            class="form-control"
                            placeholder="Masukkan  email"
                            aria-label="Masukkan email"
                            aria-describedby="basic-icon-default-email2"
                          />
                          <span id="basic-icon-default-email2" class="input-group-text">@contoh.com</span>
                        </div>
                        <div class="form-text">Anda dapat menggunakan huruf, angka, dan titik</div>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="basic-icon-default-phone">Website</label>
                      <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-phone2" class="input-group-text"
                            ><i class="bx bx-phone"></i
                          ></span>
                          <input
                            type="text"
                            id="basic-icon-default-phone"
                            class="form-control phone-mask"
                            placeholder="Nama website"
                            aria-label="Nama website"
                            aria-describedby="basic-icon-default-phone2"
                          />
                        </div>
                      </div>
                    </div>
                  </form>
               
        <!-- data PIC -->
        <!-- <div class="row"> -->
          <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="mb-0">Data PIC</h5>
              <small class="text-muted float-end">Masukkan data PIC</small>
            </div>
            <div class="card-body">
              <form>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama PIC</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        id="basic-icon-default-fullname"
                        placeholder="Nama PIC"
                        aria-label="Nama PIC"
                        aria-describedby="basic-icon-default-fullname2"
                      />
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 form-label" for="basic-icon-default-phone">Nomer Telepon</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-phone2" class="input-group-text"
                        ><i class="bx bx-phone"></i
                      ></span>
                      <input
                        type="text"
                        id="basic-icon-default-phone"
                        class="form-control phone-mask"
                        placeholder="Masukkan nomer telfon"
                        aria-label="Masukkan nomer telfon"
                        aria-describedby="basic-icon-default-phone2"
                      />
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                      <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                      <input
                        type="text"
                        id="basic-icon-default-email"
                        class="form-control"
                        placeholder="Masukkan  email"
                        aria-label="Masukkan email"
                        aria-describedby="basic-icon-default-email2"
                      />
                      <span id="basic-icon-default-email2" class="input-group-text">@contoh.com</span>
                    </div>
                    <div class="form-text">Anda dapat menggunakan huruf, angka, dan titik</div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 form-label" style="font-size: 11px;" for="basic-icon-default-message">Keterangan</label>
                  <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-message2" class="input-group-text"
                        ><i class="bx bx-comment"></i
                      ></span>
                      <textarea
                        id="basic-icon-default-message"
                        class="form-control"
                        placeholder="Berikan keterangan"
                        aria-label="Berikan keterangan"
                        aria-describedby="basic-icon-default-message2"
                      ></textarea>
                    </div>
                  </div>
                </div>
                <div class="row justify-content-end">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                  </div>
                </div>
              </form>
            <!-- end form -->
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
  </div>
  <!-- Content wrapper -->
@endsection --}}

@extends('admin.layouts.master')

@section('content')

<div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">
                <a href="{{ route('admin.perusahaan.index') }}" class="text-muted me-2">
                    <i class="bx bx-arrow-back"></i>
                </a>
                <span class="text-muted fw-light">Form /</span> Data Perusahaan & Data PIC
            </h4>
            
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Data Perusahaan</h5>
                
                    </div>
                    <div class="card-body">
                      <form action="{{ route('admin.perusahaan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">ID</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Masukkan ID perusahaan" />
                        </div> --}}
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Nama Perusahaan</label>
                          <input type="text" class="form-control" id="basic-default-company" name="nama_perusahaan" placeholder="Masukkan nama perusahaan" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-email">Email</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              id="basic-default-email"
                              class="form-control"
                              name="email"
                              aria-describedby="basic-default-email2"
                            />
                          
                          </div>
                          <div class="form-text">Anda dapat menggunakan huruf, angka, dan titik</div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Jenis Perusahaan</label>
                          <input type="text" name="jenis_perusahaan" class="form-control" id="basic-default-company" placeholder="Masukkan nama perusahaan" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Alamat</label>
                          <input type="text" name="alamat" class="form-control" id="basic-default-company" placeholder="Masukkan nama perusahaan" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-phone">No telfon</label>
                          <input
                            type="text"
                            name="phone"
                            id="basic-default-phone"
                            class="form-control phone-mask"
                            placeholder="Masukkan nomer telfon"
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Keterangan</label>
                          <input type="text" name="keterangan" class="form-control" id="basic-default-company" placeholder="Masukkan nama perusahaan" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Nama Website</label>
                          <input type="text" name="nama_website" class="form-control" id="basic-default-company" placeholder="Masukkan nama perusahaan" />
                        </div>
                     
                    
                        <button type="submit" class="btn btn-primary">Send</button> 
                      </form>
                    </div>
                  </div>
                </div>

                {{-- <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Data PIC</h5>
                
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Nama PIC</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"
                              >
                              <!-- <i class="bx bx-user"></i> -->
                            </span>
                            <input
                              type="text"
                              class="form-control"
                              id="basic-icon-default-fullname"
                              placeholder="Masukan nama PIC"
                              aria-label="Masukkan nama PIC"
                              aria-describedby="basic-icon-default-fullname2"
                            />
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-phone">No Telfon</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-phone2" class="input-group-text"
                              >
                              <!-- <i class="bx bx-phone"></i> -->
                            </span>
                            <input
                              type="text"
                              id="basic-icon-default-phone"
                              class="form-control phone-mask"
                              placeholder="Masukkan no telfon"
                              aria-label="Masukkan no telfon"
                              aria-describedby="basic-icon-default-phone2"
                            />
                          </div>
                        </div>
                      
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-email">Email</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text">
                              <!-- <i class="bx bx-envelope"></i> -->
                            </span>
                            <input
                              type="text"
                              id="basic-icon-default-email"
                              class="form-control"
                              placeholder="john.doe"
                              aria-label="john.doe"
                              aria-describedby="basic-icon-default-email2"
                            />
                            <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                          </div>
                          <div class="form-text">Anda dapat menggunakan huruf, angka, dan titik</div>
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-message">Keterangan</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-message2" class="input-group-text"
                              >
                              <!-- <i class="bx bx-comment"></i> -->
                            </span>
                            <textarea
                              id="basic-icon-default-message"
                              class="form-control"
                              placeholder="Hi, Do you have a moment to talk Joe?"
                              aria-label="Hi, Do you have a moment to talk Joe?"
                              aria-describedby="basic-icon-default-message2"
                            ></textarea>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                      </form>
                    </div>
                  </div>
                </div> --}}
              </div>
            </div>
            <!-- / Content -->

          

      
@endsection


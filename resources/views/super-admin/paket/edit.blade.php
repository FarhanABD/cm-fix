@extends('super-admin.layouts.master')

@section('content')
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">
                <a href="{{ route('super-admin.paket.indexSuperAdmin') }}" class="text-muted me-2">
                    <i class="bx bx-arrow-back"></i>
                </a>
                <span class="text-muted fw-light">Form Update/</span> Data Paket
              </h4>
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Update Paket</h5>

                    </div>
                    <div class="card-body">
                      <form action="{{ route('super-admin.paket.updateSuperAdmin',$pakets->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                          <label class="form-label" for="idLayananInput">id paket</label>
                          <input type="text" class="form-control" id="idLayananInput" name="id_paket" value="{{ $pakets->id_paket }}" readonly/>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Jenis Layanan</label>
                            <select class="form-select" id="exampleFormControlSelect1" name="jenis_layanan" aria-label="Default select example">
                              <option selected>{{ $pakets->jenis_layanan }}</option>
                              @foreach ($layanans as $layanan )
                              <option value="{{ $layanan->jenis_layanan }}">{{ $layanan->jenis_layanan }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Jenis Paket</label>
                            <select class="form-select" name="jenis_paket" id="exampleFormControlSelect1" aria-label="Default select example">
                              <option selected>{{ $pakets->jenis_paket }}</option>
                              <option value="1">Silver</option>
                              <option value="2">Gold</option>
                              <option value="3">Platinum</option>
                              <option value="3"></option>
                            </select>
                          </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Kuota</label>
                          <input value="{{ $pakets->kuota }}" type="text" class="form-control" id="basic-default-company" name="kuota" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Harga</label>
                            <input value="{{ $pakets->harga }}" type="text" class="form-control" id="basic-default-company" name="harga" />
                          </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="content-backdrop fade"></div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
@endsection   
    
 
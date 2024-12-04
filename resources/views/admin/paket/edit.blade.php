@extends('admin.layouts.master')

@section('content')
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">
                <a href="{{ route('admin.paket.index') }}" class="text-muted me-2">
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
                      <form action="{{ route('admin.paket.update',$paket->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                          <label class="form-label" for="idLayananInput">id paket</label>
                          <input type="text" class="form-control" id="idLayananInput" name="id_paket" value="{{ $paket->id_paket }}" readonly/>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Jenis Layanan</label>
                            <select class="form-select" id="exampleFormControlSelect1" name="jenis_layanan" aria-label="Default select example">
                              <option selected>{{ $paket->jenis_layanan }}</option>
                              @foreach ($layanans as $layanan )
                              <option value="{{ $layanan->jenis_layanan }}">{{ $layanan->jenis_layanan }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="harga">Deskripsi Layanan</label>
                            <textarea name="deskripsi_layanan" id="deskripsiLayanan" class="form-control">
                              {{ $paket->deskripsi_layanan }}
                            </textarea>
                          </div>

                          <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Jenis Paket</label>
                            <select class="form-select" name="jenis_paket" id="exampleFormControlSelect1" aria-label="Default select example">
                                @foreach ($jenisPaket as $jenis)
                                <option value="{{ $jenis->jenis_paket }}" 
                                        {{ $jenis->jenis_paket == $paket->jenis_paket ? 'selected' : '' }}>
                                    {{ $jenis->jenis_paket }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="deskripsiPaket">Deskripsi Paket</label>
                            <textarea name="deskripsi_paket" id="deskripsiPaket" class="form-control">{{ $paket->deskripsi_paket }}</textarea>
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Kuota</label>
                          <input value="{{ $paket->kuota }}" type="text" class="form-control" id="basic-default-company" name="kuota" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Harga</label>
                            <input value="{{ $paket->harga }}" type="text" class="form-control" id="basic-default-company" name="harga" />
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
    
 
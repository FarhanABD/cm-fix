
@extends('admin.layouts.master')

@section('content')
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">
                <a href="{{ route('admin.paket.index') }}" class="text-muted me-2">
                    <i class="bx bx-arrow-back"></i>
                </a>
                <span class="text-muted fw-light">Form Update/</span> Data Jenis Paket
              </h4>

              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Update Jenis Paket</h5>
                    </div>
                    <div class="card-body">
                      <form action="{{ route('admin.jenis-paket.update',$Jenispakets->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" >Jenis Paket</label>
                            <input type="text" class="form-control" id="jenis-paket" name="jenis_paket" value="{{ $Jenispakets->jenis_paket }}" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="harga">Deskripsi</label>
                            <textarea 
                                name="deskripsi_paket" 
                                id="basic-icon-default-message" 
                                class="form-control" 
                                aria-describedby="basic-icon-default-message2"
                            >{{ $Jenispakets->deskripsi_paket }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update</button>
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
    
 
@extends('admin.layouts.master')

@section('content')

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4">
                    <a href="{{ route('admin.layanan.index') }}" class="text-muted me-2">
                        <i class="bx bx-arrow-back"></i>
                    </a>
                    <span class="text-muted fw-light">Form Update/</span> Data Layanan
                  </h4>
              <!-- Basic Layout -->
               
              <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                      <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Master Layanan</h5>
                      </div>
                      <div class="card-body">
                        <form action="{{ route('admin.layanan.update',$layanans->id) }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')
                          <div class="mb-3">
                            <label class="form-label" for="hargaInput">ID Layanan</label>
                            <input type="text" class="form-control" id="hargaInput" placeholder="Masukkan harga" name="harga" value="{{ $layanans->id_layanan }}" readonly />
                          </div>
                          <div class="mb-3">
                            <label class="form-label" >Jenis Layanan</label>
                            <input type="text" class="form-control" name="jenis_layanan" value="{{ $layanans->jenis_layanan }}"/>
                          </div>
                          <button type="submit" class="btn btn-primary">Edit   <i class="fa-solid fa-pen-to-square"></i></button>
                        </form>
                      </div>
                    </div>
                  </div>
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        
      </div>
    </div>
@endsection




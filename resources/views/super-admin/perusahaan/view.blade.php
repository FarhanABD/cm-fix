@extends('super-admin.layouts.master')

@section('content')
  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <a href="{{ route('super-admin.perusahaan.indexSuperAdmin') }}" class="text-muted me-2">
                <i class="bx bx-arrow-back"></i>
            </a>
            <span class="text-muted fw-light">Form View / </span> Data Customer & Data PIC
          </h4>

          <form >
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Basic -->
                <div class="col-md-12 mb-4">
                  <div class="card">
                    <h5 class="card-header">Nama Customer</h5>
                    <div class="card-body">
                      <div class="divider">
                        <div class="divider text-start" style="font-size: 32px">{{ $perusahaans->nama_perusahaan }}</div>
                        <div class="divider text-start" style="font-size: 20px">Nama Website : {{ $perusahaans->nama_website }}</div>
                      </div>
                    </div>
                 
                  </div>
                </div>
                <!-- /Basic -->
        
                <!-- Text Alignment -->
                <div class="col-md-12 mb-4">
                  <div class="card">
                    <h5 class="card-header">Contact</h5>
                    <div class="card-body">
                      <div class="divider text-start" style="font-size: 18px">
                        Customer Phone : {{ $perusahaans->phone }}
                      </div>
                      <div class="divider text-start" style="font-size: 18px">
                        Alamat : {{ $perusahaans->alamat }}
                      </div>
                      <div class="divider text-start" style="font-size: 18px">
                        Email : {{ $perusahaans->email }}
                      </div>
                      <br>  
                      <div class="divider text-start" style="font-size: 18px; margin-top: 20px">
                        Nama PIC : {{ $perusahaans->nama_pic }}
                      </div>
                      <div class="divider text-start" style="font-size: 18px">
                        Email PIC : {{ $perusahaans->email }}
                      </div>
                      <div class="divider text-start" style="font-size: 18px">
                        Phone PIC : {{ $perusahaans->phone }}
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Text Alignment -->
        
                <!-- Divider Colors -->
                <div class="col-md-12 mb-4">
                  <div class="card">
                    <h5 class="card-header">Keterangan</h5>
                    <div class="card-body">
                      <div class="divider divider-primary">
                        <div class="divider text-start" style="font-size: 18px">{{ $perusahaans->keterangan }}</div>
                      </div>
                    </div>
                  </div>
                </div>
          </form>
     
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
  </div>
@endsection
    
        
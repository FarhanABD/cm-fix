@extends('admin.layouts.master')

@section('content')

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4">
                    <a href="{{ route('super-admin.layanan.index') }}" class="text-muted me-2">
                        <i class="bx bx-arrow-back"></i>
                    </a>
                    <span class="text-muted fw-light">Form Create/</span> Data Layanan
                  </h4>
              <!-- Basic Layout -->
               
              <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                      <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Master Layanan</h5>
                      </div>
                      <div class="card-body">
                        <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="mb-3">
                            <label class="form-label" for="idLayananInput" >ID Layanan</label>
                            <input type="text" class="form-control" id="idLayananInput" name="id_layanan" value="{{ $newIdLayanan }}" readonly />
                          </div>
                          <div class="mb-3">
                            <label class="form-label" >Jenis Layanan</label>
                            <input type="text" class="form-control" name="jenis_layanan" placeholder="Masukkan jenis layanan anda"/>
                          </div>
                          <button type="submit" class="btn btn-success">Simpan   <i class="fa-solid fa-floppy-disk" style="padding-left: 4px"></i></button>
                        </form>
                      </div>
                    </div>
                  </div>
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        
      </div>
    </div>

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




@extends('super-admin.layouts.master')

@section('content')

<div class="content-wrapper">
            <!-- Content -->
           
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">
                <a href="{{ route('super-admin.perusahaan.index') }}" class="text-muted me-2">
                    <i class="bx bx-arrow-back"></i>
                </a>
                <span class="text-muted fw-light">Form /</span> Data Perusahaan & Data PIC
              </h4>
            
            <form  action="{{ route('super-admin.perusahaan.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <!-- Basic Layout -->
              <div class="row">
               <div class="col-xl">
                 <div class="card mb-4">
                   <div class="card-header d-flex justify-content-between align-items-center">
                     <h5 class="mb-0">Create Data Perusahaan</h5>
               
                   </div>
                   <div class="card-body">
                       <div class="mb-3">
                         <label class="form-label" for="basic-default-company">Nama Perusahaan</label>
                         <input type="text" class="form-control" id="basic-default-company" name="nama_perusahaan" placeholder="Masukkan nama perusahaan"/>
                       </div>
                       <div class="mb-3">
                         <label class="form-label" for="basic-default-email">Email</label>
                         <div class="input-group input-group-merge">
                           <input
                             type="text"
                             id="basic-default-email"
                             class="form-control"
                             name="email"
                             placeholder="Masukkan Email"
                             aria-describedby="basic-default-email2"
                           />
                         
                         </div>
                         <div class="form-text">Anda dapat menggunakan huruf, angka, dan titik</div>
                       </div>
                       <div class="mb-3">
                        <label class="form-label" for="basic-default-company">Jenis Perusahaan</label>
                        <input  type="text" name="jenis_perusahaan" class="form-control" id="basic-default-company" placeholder="Masukkan jenis perusahaan" />
                      </div>
                       <div class="mb-3">
                         <label class="form-label" for="basic-default-company">Alamat</label>
                         <input  type="text" name="alamat" class="form-control" id="basic-default-company" placeholder="Masukkan alamat perusahaan" />
                       </div>
                       <div class="mb-3">
                         <label class="form-label" for="basic-default-phone">No telepon</label>
                         <input
                           type="text"
                           name="phone"
                           id="basic-default-phone"
                           class="form-control phone-mask"
                           placeholder="Masukkan nomer telepon"
                         />
                       </div>
                       <div class="mb-3">
                         <label class="form-label" for="basic-default-company">Keterangan</label>
                         <input type="text" name="keterangan" class="form-control" id="basic-default-company" placeholder="Masukkan keterangan perusahaan" />
                       </div>
                       <div class="mb-3">
                         <label class="form-label" for="basic-default-company">Nama Website</label>
                         <input type="text" name="nama_website" class="form-control" id="basic-default-company" placeholder="Masukkan nama website" />
                       </div>
 
                     
                   </div>
                 </div>
               </div>
             </div>
 
             <div class="col-xxl">
               <div class="card mb-4">
                 <div class="card-header d-flex align-items-center justify-content-between">
                   <h5 class="mb-0">Data PIC</h5>
                   <small class="text-muted float-end">Create data PIC</small>
                 </div>
                 <div class="card-body">
                     <div class="row mb-3">
                       <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama PIC</label>
                       <div class="col-sm-10">
                         <div class="input-group input-group-merge">
                           <span id="basic-icon-default-fullname2" class="input-group-text"
                             ><i class="bx bx-user"></i
                           ></span>
                           <input
                             name="nama_pic"
                             type="text"
                             class="form-control"
                             id="basic-icon-default-fullname"
                             placeholder="Masukkan nama PIC"
                             aria-label="Masukkan nama PIC"
                             aria-describedby="basic-icon-default-fullname2"
                           />
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
                             name="email_pic"
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
                             placeholder="Berikan keterangan"
                             aria-label="Berikan keterangan"
                             aria-describedby="basic-icon-default-message2"
                           ></textarea>
                         </div>
                       </div>
                     </div>
                     <div class="row justify-content-end">
                       <div class="col-sm-10">
                         <button type="submit" class="btn btn-primary">Send</button>
                       </div>
                     </div>
                   
                 </div>
               </div>
             </div>
            </form>

            </div>
            <!-- / Content -->
@endsection
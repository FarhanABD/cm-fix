<script>
import React from 'react';

const DataPerusahaanForm = ({ isDisabled }) => {
  // Form fields and logic here...

  return (
    <form disabled={isDisabled}>
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
      <button type="submit">Submit</button>
    </form>
  );
};

export default DataPerusahaanForm;
</script>


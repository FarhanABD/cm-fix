@extends('super-admin.layouts.master')
@section('content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <h4 class="card-header">Tabel Maintenace
      </h4> 
      <div class="card-body">
             <!-- Filter Tanggal -->
             <form id="filterForm" method="GET" action="{{ route('super-admin.invoice.indexSuperAdmin') }}" class="mb-4 row">
              <div class="col-md-3">
                  <div class="form-group d-flex align-items-center">
                      <label style="margin-right: 8px" for="tanggalDari">Dari</label>
                      <input type="date" class="form-control" name="dari" id="tanggalDari" max="{{ date('Y-m-d') }}" value="{{ request('dari') }}">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group d-flex align-items-center">
                      <label style="margin-right: 8px" for="tanggalSampai">Sampai</label>
                      <input type="date" class="form-control" name="sampai" id="tanggalSampai" max="{{ date('Y-m-d') }}" value="{{ request('sampai') }}">
                  </div>
              </div>
              <div class="col-md-3 d-flex align-items-center">
                  <button type="submit" class="btn btn-primary">Filter</button>
              </div>
          </form>
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead>
                  <tr class="text-nowrap">
                    <th>No</th>
                    <th>id_order</th>
                    <th>total</th>
                    <th>tanggal langganan</th>
                    <th>tanggal habis</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach ($orders as $item )
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->id_order }}</td>
                    <td> {{ $item->formatRupiah('total') }}</td>
                    <td>{{ $item->tanggal_langganan }}</td>
                    <td>{{ $item->tanggal_habis }}</td>
                    <td>
                          <a href="{{ route('super-admin.maintenance.perpanjang',$item->id) }}"
                            class="btn btn-sm btn-outline-success"><i class="fa-solid fa-rotate-right"></i> Perpanjang</a>
                          <a href="{{ route('super-admin.maintenance.showSuperAdmin', $item->id_order) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i>Detail</a>
                   </ul>
                  </td>
                  </tr>
                  @endforeach         
                  @if(isset($maintenances))
                      @foreach ($maintenances as $item)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->id_order }}</td>
                          <td>{{ $item->total }}</td>
                          <td>{{ $item->tanggal_langganan }}</td>
                          <td>{{ $item->tanggal_habis }}</td>
                          <td>
                              <a href="{{ route('super-admin.invoice.showSuperAdmin', $item->id_order) }}">Detail</a>
                          </td>
                      </tr>
                      @endforeach
                  @endif 
                  </thead> 
                </tbody>
              </table>
            </div>
          </div>
          <!--/ Responsive Table -->
      </div>
  </div>
  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@endsection

@push('scripts')
{{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}

<script>
  $(document).ready(function () {
      $('#table').DataTable();
  });

  // Mendapatkan elemen input tanggal
  var tanggal_dari = document.getElementById('tanggalDari');
  var tanggal_sampai = document.getElementById('tanggalSampai');

  // Mendapatkan tanggal hari ini
  var today = new Date();
  var year = today.getFullYear();
  var month = String(today.getMonth() + 1).padStart(2, '0'); // Tambahkan nol di depan jika bulan < 10
  var day = String(today.getDate()).padStart(2, '0'); // Tambahkan nol di depan jika tanggal < 10

  // Format tanggal sebagai "YYYY-MM-DD" (format yang diharapkan untuk input type="date")
  var formattedDate = year + '-' + month + '-' + day;

  // Set nilai input tanggal menjadi tanggal hari ini
  tanggal_dari.value = formattedDate;
  tanggal_sampai.value = formattedDate;
</script>
@endpush
@extends('admin.layouts.master')
@section('content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel</span> Order</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Data Order
          <a href="{{ route('admin.cart.index') }}" class="btn btn-danger float-end">Create</a>
      </h5>
      <div class="card-body">
          {{-- {{ $dataTable->table() }} --}}
          <div class="card">
            <div class="table-responsive text-nowrap">
              <table class="table" id="table">
                <thead>
                  <tr class="text-nowrap">
                    <th >No</th>
                    <th >id_order</th>
                    <th >total</th>
                    <th >ppn</th>
                    <th >status</th>
                    <th >tanggal langganan</th>
                    <th >tanggal habis</th>
                    <th class="text-nowrap Aksi">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $item )
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->id_order }}</td>
                    <td>{{ $item->formatRupiah('total') }}</td>
                    <td>{{ $item->ppn }}</td>
                    <td>
                      <div class="form-check form-switch">
                          <input 
                              class="form-check-input change-status" 
                              type="checkbox" 
                              data-id="{{ $item->id }}" 
                              {{ $item->status == 1 ? 'checked' : '' }}>
                      </div>
                    </td>
                    <td>{{ $item->tanggal_langganan }}</td>
                    <td>{{ $item->tanggal_habis }}</td>
                    <td>
                      <div class="d-flex justify-content-between gap-2">
                        <a href="{{ route('admin.order.show', urlencode($item->id_order)) }}" class="btn btn-outline-info btn-sm">
                            <i class="fa-solid fa-eye"></i> Detail
                        </a>
                        <a href="{{ route('admin.order.edit', $item->id) }}" class="btn btn-outline-success btn-sm">
                            <i class="fa-solid fa-edit"></i> Edit
                        </a>
                        <!-- Tombol Hapus -->
                        <button class="btn btn-outline-danger btn-sm delete-item" data-id="{{ $item->id }}">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </div>
                    
                  </td>
                  </tr>
                  @endforeach
                </tbody>
            </div>
          </div>
          <!--/ Responsive Table -->
      </div>
      </div>
  </div>
    <!--/ Basic Bootstrap Table -->
  <div class="content-backdrop fade"></div>
</div>

<!-- Content wrapper -->
@endsection

@push('scripts')
<script>
  $(document).on('change', '.change-status', function () {
      let status = $(this).is(':checked') ? 1 : 0; // 1 jika switch on, 0 jika switch off
      let id = $(this).data('id'); // ID item yang akan diubah

      $.ajax({
          url: '{{ route("admin.order.updateStatus") }}', // Ganti dengan route yang sesuai
          type: 'POST',
          data: {
              _token: '{{ csrf_token() }}', // Token CSRF untuk keamanan
              id: id,
              status: status
          },
          success: function (response) {
              if (response.success) {
                  alert('Status berhasil diperbarui!');
              } else {
                  alert('Terjadi kesalahan. Silakan coba lagi.');
              }
          },
          error: function (xhr) {
              alert('Terjadi kesalahan saat menghubungi server.');
              console.log(xhr.responseText);
          }
      });
  });
</script>

<script>
  $(document).on('click', '.delete-item', function () {
      if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
          let id = $(this).data('id'); // Mendapatkan ID item

          $.ajax({
              url: '/admin/order/' + id, // URL sesuai dengan route
              type: 'DELETE',
              data: {
                  _token: '{{ csrf_token() }}', // Token CSRF untuk keamanan
              },
              success: function (response) {
                  if (response.status === 'success') {
                      alert(response.message);
                      location.reload(); // Refresh halaman
                  } else {
                      alert('Terjadi kesalahan. Silakan coba lagi.');
                  }
              },
              error: function (xhr) {
                  alert('Terjadi kesalahan saat menghubungi server.');
                  console.log(xhr.responseText);
              }
          });
      }
  });
</script>

@endpush

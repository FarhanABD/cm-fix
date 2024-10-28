@extends('super-admin.layouts.master')
@section('content')
 <!-- Content wrapper -->
 <div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tabel</span> Order</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Data Order
          <a href="{{ route('super-admin.cart.indexSuperAdmin') }}" class="btn btn-danger float-end">Create</a>
      </h5>
      <div class="card-body">
          {{ $dataTable->table() }}
      </div>
  </div>
    <!--/ Basic Bootstrap Table -->
  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

<script>
  $(document).on('click', '.change-status', function(e) {
    let isChecked = $(this).is(':checked');
    let id = $(this).data('id');
    let labelElement = $(this).next('.form-check-label'); // Mendapatkan elemen label setelah checkbox

    $.ajax({
        url: "{{ route('super-admin.order.changeStatusSuperAdmin') }}",
        method: 'PUT',
        data: {
            status: isChecked,
            id: id,
            _token: '{{ csrf_token() }}' // Pastikan CSRF token dikirim
        },
        success: function(data) {
            // Mengubah teks label berdasarkan status
            if (isChecked) {
                labelElement.text('Paid'); // Jika checkbox checked, ubah menjadi "Paid"
            } else {
                labelElement.text('Unpaid'); // Jika checkbox tidak checked, ubah menjadi "Unpaid"
            }
            // Menampilkan pesan sukses
            Swal.fire('Success!', data.message, 'success');
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});
</script>
@endpush

{{-- @push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>
  $(document).ready(function() {
    $('body').on('click', '.change-status', function(e) {
      let isChecked = $(this).is(':checked');
      let id = $(this).data('id');

      $.ajax({
        url: "{{ route('admin.order.changeStatus') }}",
        method: 'PUT',
        data: {
          status: isChecked,
          id: id,
          _token: '{{ csrf_token() }}'
        },
        success: function(data) {
            if (isChecked) {
                labelElement.text('Paid'); // Jika checkbox checked, ubah menjadi "Paid"
            } else {
                labelElement.text('Unpaid'); // Jika checkbox tidak checked, ubah menjadi "Unpaid"
            }
            // Menampilkan pesan sukses
            Swal.fire('Success!', data.message, 'success');
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    });
  });
</script>
@endpush --}}

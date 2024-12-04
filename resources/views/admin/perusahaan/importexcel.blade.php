@extends('admin.layouts.master')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin/importexcel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Choose Excel File</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>
        <input type="file" name="excel_file">
        <button type="submit" class="btn btn-primary">Import</button>
    </form>

    <!-- Tabel untuk DataTable -->
    <table id="dataCustomersTable" class="display">
        <thead>
            <tr>
                <th>id</th>
                <th>id_perusahaan</th>
                <th>email</th>
                <th>nama_perusahaan</th>
                <th>phone</th>
                <th>alamat</th>
                <th>keterangan</th>
                <th>nama_website</th>
                <th>nama_pic</th>
                <th>phone_pic</th>
                <th>email_pic</th>
                <th>keterangan_pic</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataCustomers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->id_perusahaan }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->nama_perusahaan }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->alamat }}</td>
                    <td>{{ $customer->keterangan }}</td>
                    <td>{{ $customer->nama_website }}</td>
                    <td>{{ $customer->nama_pic }}</td>
                    <td>{{ $customer->phone_pic }}</td>
                    <td>{{ $customer->email_pic }}</td>
                    <td>{{ $customer->keterangan_pic }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#perusahaansTable').DataTable();
        });
    </script>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif


</div>
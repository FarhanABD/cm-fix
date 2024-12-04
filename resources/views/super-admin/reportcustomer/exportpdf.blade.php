<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Report PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #fa6806;
            color: white;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <h1>Report Customer</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Perusahaan</th>
                <th>Email</th>
                <th>Nama Perusahaan</th>
                <th>Phone</th>
                <th>Alamat</th>
                <th>Nama PIC</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->id}}</td>
                <td>{{ $customer->id_perusahaan }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->nama_perusahaan }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->alamat }}</td>
                <td>{{ $customer->nama_pic }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Generated on: {{ \Carbon\Carbon::now()->format('d M Y H:i:s') }}</p>
    </div>
</body>
</html>
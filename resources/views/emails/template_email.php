<?php
// Judul dan isi email
$subject = "Pesan Email Sederhana";
$message = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Sederhana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pesan dari Kami</h1>
        </div>
        <div class="content">
            <p>Halo,</p>
            <p>Ini adalah contoh tampilan pesan email sederhana. Anda dapat mengubah isi, warna, dan tampilan sesuai dengan kebutuhan.</p>
            <p>Terima kasih telah menggunakan layanan kami.</p>
        </div>
        <div class="footer">
            &copy; 2024 Perusahaan Anda. All rights reserved.
        </div>
    </div>
</body>
</html>
';

// Pengaturan header untuk email HTML
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: no-reply@perusahaananda.com";

// Fungsi pengiriman email
$to = "email_penerima@example.com";
if (mail($to, $subject, $message, $headers)) {
    echo "Email berhasil dikirim!";
} else {
    echo "Email gagal dikirim.";
}
?>
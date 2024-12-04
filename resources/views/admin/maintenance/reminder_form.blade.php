<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #555;
        }
        .content {
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            font-size: 0.9em;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Maintenance Reminder</h1>
        </div>
        <div class="content">
            <p>Dear PIC,</p>
            <p>
                This is a friendly reminder that the maintenance period for the following order is approaching:
            </p>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <th style="text-align: left; border-bottom: 1px solid #ddd;">Order ID</th>
                    <td style="border-bottom: 1px solid #ddd;">{{ $order->id_order }}</td>
                </tr>
                <tr>
                    <th style="text-align: left; border-bottom: 1px solid #ddd;">Customer Name</th>
                    <td style="border-bottom: 1px solid #ddd;">{{ $order->customer_name }}</td>
                </tr>
                <tr>
                    <th style="text-align: left; border-bottom: 1px solid #ddd;">Expiration Date</th>
                    <td style="border-bottom: 1px solid #ddd;">{{ $order->tanggal_habis }}</td>
                </tr>
            </table>
            @if ($message)
                <p><strong>Additional Message:</strong></p>
                <p>{{ $message }}</p>
            @endif
            <p>Please ensure the necessary actions are taken to renew or maintain the service before the expiration date.</p>
        </div>
        <div class="footer">
            <p>Thank you,</p>
            <p>Your Company Name</p>
        </div>
    </div>
</body>
</html>

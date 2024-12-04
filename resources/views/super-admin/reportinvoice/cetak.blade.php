<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Invoice</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body onload="generatePDF()">
    <style>
       body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f4f4f4;
    }
    
    .invoice-container {
        width: 800px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .invoice-header {
        display: flex;
        justify-content: space-between;
        border-bottom: 2px solid #00a2e8;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    
    .company-info h2 {
        color: #00a2e8;
        margin: 0;
    }
    
    .invoice-details h2 {
        color: #00a2e8;
        margin: 0;
        text-align: right;
    }
    
    .invoiced-to h3 {
        background-color: #00a2e8;
        color: #fff;
        padding: 10px;
    }
    
    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    
    .invoice-table th, .invoice-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    
    .invoice-table th {
        background-color: #00a2e8;
        color: #fff;
    }
    
    .invoice-table tfoot td {
        font-weight: bold;
    }
    
    .notes {
        margin-top: 20px;
    }
    
    .invoice-footer {
    display: flex;
    justify-content: space-between; /* Already defined */
    align-items: center; /* New property */
    }
    
    .bank-info {
        margin-top: 20px;
        margin-bottom: 20px;
        padding-top: 60px;
        font-size: 12px;
        text-align: center;
    }

    /* frontend Bank */
    body {
    font-family: Arial, sans-serif;
    }

    .signature-section {
        display: flex;
        justify-content: space-between;
        margin: 20px;
        margin-bottom: 40px; /* Memberi jarak dengan bank logos */
    }

    .signature, .date {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 200px;
    }

    .signature-line, .date-line {
        width: 100%;
        border-bottom: 1px solid black;
        margin-top: 1px;
        padding-top: 50px;
        margin: 25px;
    }

    .signature p, .date p {
        margin: 1px;
    }

    .bank-info {
        display: flex;
        justify-content: space-around;
        margin: 50px;
    }

    .bank-card {
        border: 2px dashed #ccc;
        padding: 5px 5px 5px;
        text-align: center;
        width: 220px;
        position: relative;
        box-sizing: border-box;
    }

    .bank-logo {
        width: 120px;
        position: absolute;
        top: -50px;
        left: 50%;
        transform: translateX(-50%);
    }
    p {
        margin: 5px 0;
        font-size: 14px;
    }
    .invoiced-to-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .invoiced-to-grid p {
        flex: 1 1 calc(33.333% - 10px); /* Membagi setiap elemen menjadi 3 kolom */
        margin: 0;
    }
    </style>

    @foreach($data as $item)
    <?php
    // Split jenis layanan, paket, dan qty berdasarkan koma
    $jenis_layanan = explode(',', $item->jenis_layanan);
    $jenis_paket = explode(',', $item->jenis_paket);
    $description = explode(',', $item->item_desc);
    $qty = explode(',', $item->qty);
    $price = explode(',', $item->price);
    ?>
    <div class="invoice-container">
        <header class="invoice-header">
            <div class="company-info">
                <img src="{{ asset('backend/assets/img/cm_logos.png') }}" alt="Logo Creative Multimedia">
                <p>Address: Kawasan Darmo Satellite Town</p>
                <p>Jl. Tubanan Baru 10/K-15 Surabaya 60188, East Java - Indonesia</p>
                <p>Telp.: 031-7328540 / 031-99207030</p>
                <p>Email: care@creativemultimedia.id</p>
                <p>Website: www.creativemultimedia.id</p>
            </div>
            <div class="invoice-details">
                <h2>CORPORATE INVOICE</h2>
                <p style="margin-top: 8px"><strong>Invoice No :</strong> {{ $item->id_invoice }}</p>
                <p style="margin-top: 8px"><strong>Tanggal Langganan :</strong> {{ $item->tanggal_langganan }}</p>
                <p style="margin-top: 8px"><strong>Tanggal Habis :</strong> {{ $item->tanggal_habis }}</p>
                <p style="margin-top: 64px"><strong>Tanggal Invoice :</strong>{{ \Carbon\Carbon::now()->format('d M Y') }}</p>
            </div>
        </header>

        <section class="invoiced-to">
            <h3>INVOICED TO :</h3>
            <section class="invoiced-to-grid" style="margin-bottom: 12px; padding-left: 8px">
                <p><strong>Nama Customer:</strong> {{ $item->nama_perusahaan }}</p>
                <p><strong>Phone:</strong> {{ $item->phone_pic }}</p>
                <p><strong>Email PIC:</strong> {{ $item->email_pic }}</p>
                <p><strong>Kota:</strong> {{ $item->kota }}</p>
                <p><strong>Provinsi:</strong> {{ $item->provinsi }}</p>
                <p><strong>Negara:</strong> {{ $item->country }}</p>
              
            </section>
          
        </section>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>ID ORDER</th>
                    <th>ITEM DESCRIPTION</th>
                    <th>JENIS LAYANAN</th>
                    <th>QTY</th>
                    <th>JENIS PAKET</th>
                    <th>PRICE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jenis_layanan as $index => $layanan)
                <tr>
                    <td>{{ $item->id_order }}</td>
                    <td>{{ $description[$index] ?? '------------- || ------------' }}</td>
                    <td>{{ $layanan}}</td>
                    <td>{{ $qty[$index] ?? 'N/A' }}</td> 
                    <td>{{ $jenis_paket[$index] ?? 'N/A' }}</td>
                    <td>{{ $price[$index] ?? 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">TOTAL</td>
                    <td colspan="2">{{ $item->formatRupiah('total_amount') }}</td>
                </tr>
                <tr>
                    <td colspan="4">PPN 11%</td>
                    <td colspan="2">{{ $item->formatRupiah('ppn') }}</td>
                </tr>
                <tr>
                    <td colspan="4">GRAND TOTAL</td>
                    <td colspan="2">{{  $item->formatRupiah('total') }}</td>
                </tr>
            </tfoot>
        </table>
        <section class="notes">
            <p><strong>Additional Notes:</strong> Pembayaran baru dianggap sah setelah menyerahkan bukti transfer.</p>
        </section>
        <div class="signature-section">
            <div class="signature">
                <p>Admin Finance</p>
                <p> {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                <div class="signature-line"></div>
            </div>
            <div class="date">
                <p>{{ $item->nama_pic }}</p>
                <p> {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                <div class="date-line"></div>
            </div>
        </div>
        <div class="bank-info">
            <!-- BCA -->
            <div class="bank-card">
                <img src="{{ asset('backend/assets/img/bca.png') }}" alt="BCA Logo" class="bank-logo">
                <p>1410 0150 34564</p>
                <p>CREATIVE MULTIMEDIA</p>
            </div>
    
            <!-- Mandiri -->
            <div class="bank-card">
                <img src="{{ asset('backend/assets/img/mandiri.png') }}" alt="Mandiri Logo" class="bank-logo">
                <p>829 1478 000</p>
                <p>CREATIVE MULTIMEDIA</p>
            </div>
    
            <!-- Bank Jatim -->
            <div class="bank-card">
                <img src="{{ asset('backend/assets/img/jatim.png') }}" alt="Bank Jatim Logo" class="bank-logo">
                <p>065 100 4268</p>
                <p>CREATIVE MULTIMEDIA IND.</p>
            </div>
        </div>
    </div>
    <button onclick="generatePDF('{{ $item->id_invoice }}')">Download PDF</button>
    @endforeach

    <script>
            async function generatePDF(invoiceId) {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();
            const invoiceElements = document.querySelectorAll('.invoice-container');
            for (let i = 0; i < invoiceElements.length; i++) {

                const canvas = await html2canvas(invoiceElements[i]);
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 190; // Width of the image in mm
                const pageHeight = pdf.internal.pageSize.height;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;

                let heightLeft = imgHeight;

                let position = 0;
                pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
                // If image height is greater than page height, add new page

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }
            }
            // Save PDF dengan format id_invoice
            pdf.save(`invoice_{{ $item->id_invoice }}.pdf`)
        }
    </script>
        
</body>

</html> 

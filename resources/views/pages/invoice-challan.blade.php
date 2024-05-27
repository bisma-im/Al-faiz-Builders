<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Challan</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .container {
            width: 100%;
            display: table;
            table-layout: fixed;
        }
        .column {
            display: table-cell;
            border-right: dashed 1px;
            padding: 5px;
            vertical-align: top;
            width: 33.33%;
        }
        p {
            margin-top: 5px; 
            margin-bottom: 5px; 
        }
        .header h3 {
            margin: 5px;
            padding-bottom: 5px;
            font-size: 15px;
        }
        h5 {
            text-align: center;
            border: 2px solid #000;
            padding: 5px;
            margin: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 5px;
            font-size: 11px;
        }
        .details {
            display: table;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        .details p {
            display: table-cell;
            margin: 0;
            padding-left: 5px;
            padding-right: 5px;
        }
        .details p.right {
            text-align: right;
        }
        .under-line {
            text-decoration: underline;
        }
        table {
            width: 90%;
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;
        }
        table, th, td {
            border: 2px solid black;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        .table-container {
            margin-top: 10px;
            min-height: 280px;  /* Adjust this based on your particular row height */
            margin-bottom: 20px; /* Space below the table before the footer starts */
        }
    </style>
</head>
<body>
    <div class="container">
        @php
            $types = ['Customer Copy', 'Bank Copy', 'Accounts Copy'];
        @endphp
        @foreach($types as $index => $type)
        <div class="column">
            <div class="header">
                <h3 style="float: left;">Habib Bank</h3>
                <h3 style="float: right;">Al Faiz Builders, Karachi, <br>Pakistan</h3>
                <div style="clear: both;"></div>
                <div class="details"> 
                    <p>Challan Date: <span class="under-line">{{ $invoiceData['created_at']->format('d-M-Y') }}</span></p>
                    <p class="right">{{ $type }}</p>
                </div>
                <div class="details"> 
                    <p>Invoice No: <span class="under-line">{{ 12 }}</span></p>
                    <p class="right">Bill ID: <span class="under-line">????????</span></p>
                </div>
                <h5>Credit to Al Faiz, Main Collection A/c at State Life Cash Management Branch 0011-12345678-03</h5>
                <div class="details">
                    <p>Customer Name: <span class="under-line">{{ $customerData[0]->name }}</span></p>
                </div>
                <div class="details"> 
                    <p>Customer ID: <span class="under-line">{{ $customerData[0]->id }}</span></p>
                    <p class="right">Booking ID: <span class="under-line">{{ $invoiceData['booking_id'] }}</span></p>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th style="text-align: center">Particulars</th>
                                <th style="text-align: center">Rs.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoiceItems as $invoiceItem)
                                <tr>
                                    <td>{{ $invoiceItem['description'] }}</td>
                                    <td style="text-align: right">{{ number_format($invoiceItem['amount'], 2) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="1">TOTAL</th>
                                <td style="text-align: right">{{ number_format($invoiceData['total_amount'], 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="details"> 
                    <p>Deposited by: <span class="under-line">_______________</span></p>
                    <p class="right">Cashier: <span class="under-line">_______________</span></p>
                </div>
            </div>
            <div class="footer" style="border: 1px solid #000; padding: 5px;">
                <strong><p style="text-align: left;">Payment can be made using any one of the following methods:</p></strong>
                <ul style="text-align: left;">
                    <li>1Bill through any Mobile Banking or EasyPaisa and JazzCash.</li>
                    <li>HBL Konnect Agent or HBL Internet / Mobile Banking.</li>
                    <li>Visit any nearest HBL bank branch for cash deposit.</li>
                </ul>
                <strong><p>Fund Transfer/IBFT will not be accepted.</p></strong>
            </div>
            <div class="footer" style="border: 1px solid #000; padding: 5px; height: 20px;"></div>
            <div class="footer" style="border: 1px solid #000; padding: 5px;">
                <strong><p style="text-align: left;">For Customer Information</p></strong>
                <p style="text-align: left;">Invoice Outstanding as of {{ $invoiceData['created_at']->format('d-M-Y') . ' : Rs. ' .  number_format($invoiceData['total_amount'], 2) }}</p>
            </div>
            <div class="footer">
                <p style="font-size: 10px;">A company set up u/s 42 of the Companies Act, 2017 Regd. Address: Faiz House: C-151, Gulshan-e-Iqbal Block-09, Karachi, Pakistan, 75300.</p>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>

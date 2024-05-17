{{-- <!DOCTYPE html>
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
        p {
            margin-top: 5px;    /* Reduces the top margin */
            margin-bottom: 5px; /* Reduces the bottom margin */
        }
        .Row {
            /* padding: 10px; */
            display: flex;
            flex-direction: row;
            justify-content: space-between; /* Distributes space between columns */
            page-break-after: avoid; /* Avoid breaking the page after this row */
        }
        .Column {
            flex: 1;
            border-right: 1px dashed #000;
            padding: 10px;
        }
        .header h3 {
            margin: 0;
            padding-bottom: 10px;
        }
        h5 {
            text-align: center;
            border: 2px solid #000;
            padding: 10px;
            margin: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 5px;
            margin-left: 30px;
            margin-right: 30px;
            font-size: 11px;
        }
        .Column:last-child {
            border-right: none;
        }
        .details {
            margin: 0;
            padding-left: 20px;
            padding-right: 20px;
            display: flex; 
            justify-content: space-between;
        }
        .under-line {
            /* width: 137px;
            border-bottom: 1px solid #000;
            display: inline-block;
            margin-right: 10px; */
            text-decoration: underline;
            margin-left: 5px;
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
        min-height: 350px;  /* Adjust this based on your particular row height */
        margin-bottom: 20px; /* Space below the table before the footer starts */
        }

    </style>
</head>
<body>
    <div class="Row">
        @php
            $types = ['Customer Copy', 'Bank Copy', 'Accounts Copy'];
        @endphp
        @foreach($types as $index => $type)
        <div class="Column">
            <div class="header">
                <h3 style="float: left;">Habib Bank</h3>
                <h3 style="float: right;">Al Faiz Builders, Karachi, <br>Pakistan</h3>
                <div style="clear: both;"></div>
                <div class="details"> 
                    <p>Challan Date: <span class="under-line">{{ $invoiceData['created_at'] }}</span></p>
                    <p>{{ $type }}</p>
                </div> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Voucher</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 12px;
            width: 100%;
        }
        .Row {
            display: flex;
            flex-direction: row;  /* Ensures the items are placed in a row */
            width: 100%;
            align-items: stretch; /* Stretches items to fill the height */
            page-break-after: avoid; /* Prevents breaking into multiple pages */
        }
        .Column {
            flex: 1;  /* Each column takes equal space */
            border-right: 1px dashed #000;
            padding: 10px;
            box-sizing: border-box; /* Includes padding and border in the element's total width and height */
            display: inline-block;
        }
        .header, .footer, .details, table {
            width: 100%; /* Ensures elements use full width of the column */
        }
        .Column:last-child {
            border-right: none;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        @media print {
            .Row {
                page-break-inside: avoid; /* Avoid breaking inside the row during print */
            }
        }
    </style>
</head>
<body>
    <table>
        @php
            $types = ['Customer Copy', 'Bank Copy', 'Accounts Copy'];
        @endphp
        @foreach($types as $index => $type)
        <thead>
            <tr>
                <th style="text-align: left">Habib Bank</th>
                <th style="text-align: right">Al Faiz Builders, Karachi, <br>Pakistan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Challan Date: <span class="under-line">{{ $invoiceData['created_at'] }}</span></td>
                <td>{{ $type }}</td>
            </tr>
            <tr>
                <td>Invoice No: <span class="under-line">{{ 12 }}</span></td>
                <td>{{ Bill ID: <span class="under-line">????????</span> }}</td>
            </tr>
                {{-- <h5>Credit to Al Faiz, Main Collection A/c at State Life Cash Management Branch
                    0011-12345678-03</h5> --}}
                {{-- <div  class="details"> --}}
            <tr>
                <td>Customer Name: <span class="under-line">{{ $customerData[0]->name }}</span></td>
            </tr>
            <tr>
                <td>Customer ID: <span class="under-line">{{ $customerData[0]->id }}</span></td>
                <td>Booking ID: <span class="under-line">{{ $invoiceData['booking_id'] }}</span></td>
            </tr>
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
                    <p>Deposited by: <span class="under-line">_______________</span</p>
                    <p>Cashier: <span class="under-line">_______________</span</p>
                </div>
            <div class="footer" style="border: 1px solid #000; padding: 10px;">
                <strong><p  style="text-align: left;">Payment can be made using any one of the following methods:</p></strong>
                <ul style="text-align: left;">
                    <li>1Bill through any Mobile Banking or EasyPaisa and JazzCash.</li>
                    <li>HBL Konnect Agent or HBL Internet / Mobile Banking.</li>
                    <li>Visit any nearest HBL bank branch for cash deposit.</li>
                </ul>
                <strong><p>Fund Transfer/IBFT will not be accepted.</p></strong>
            </div>
            <div class="footer" style="border: 1px solid #000; padding: 10px; height: 30px;"></div>
            <div class="footer" style="border: 1px solid #000; padding: 10px;">
                <strong><p  style="text-align: left;">For Customer Information</p></strong>
                <p style="text-align: left;">Invoice Outstanding as of {{ $invoiceData['created_at'] }} : Rs. 0</p>
            </div>
            <div class="footer">
                <p style="font-size: 10px;">A company set up u/s 42 of the Companies Act, 2017 Regd. Address:
                    Faiz House: C-151, Gulshan-e-Iqbal Block-09, Karachi, Pakistan, 75300. 
                </p>
            </div>
        </tbody>
        @endforeach
    </table>
</body>
{{-- <body>
    <div class="Row">
        @php
            $types = ['Customer Copy', 'Bank Copy', 'Accounts Copy'];
        @endphp
        @foreach($types as $index => $type)
        <div class="Column">
            <div class="header">
                <h3 style="float: left;">Habib Bank</h3>
                <h3 style="float: right;">Al Faiz Builders, Karachi, <br>Pakistan</h3>
                <div style="clear: both;"></div>
                <div class="details"> 
                    <p>Challan Date: <span class="under-line">{{ $invoiceData['created_at'] }}</span></p>
                    <p>{{ $type }}</p>
                </div>
                <div class="details"> 
                    <p>Invoice No: <span class="under-line">{{ 12 }}</span></p>
                    <p>Bill ID: <span class="under-line">????????</span></p>
                </div>
                <h5>Credit to Al Faiz, Main Collection A/c at State Life Cash Management Branch
                    0011-12345678-03</h5>
                <div  class="details">
                <p>Customer Name: <span class="under-line">{{ $customerData[0]->name }}</span></p></div>
                <div class="details"> 
                    <p>Customer ID: <span class="under-line">{{ $customerData[0]->id }}</span</p>
                    <p>Booking ID: <span class="under-line">{{ $invoiceData['booking_id'] }}</span</p>
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
                    <p>Deposited by: <span class="under-line">_______________</span</p>
                    <p>Cashier: <span class="under-line">_______________</span</p>
                </div>
            </div>
            <div class="footer" style="border: 1px solid #000; padding: 10px;">
                <strong><p  style="text-align: left;">Payment can be made using any one of the following methods:</p></strong>
                <ul style="text-align: left;">
                    <li>1Bill through any Mobile Banking or EasyPaisa and JazzCash.</li>
                    <li>HBL Konnect Agent or HBL Internet / Mobile Banking.</li>
                    <li>Visit any nearest HBL bank branch for cash deposit.</li>
                </ul>
                <strong><p>Fund Transfer/IBFT will not be accepted.</p></strong>
            </div>
            <div class="footer" style="border: 1px solid #000; padding: 10px; height: 30px;"></div>
            <div class="footer" style="border: 1px solid #000; padding: 10px;">
                <strong><p  style="text-align: left;">For Customer Information</p></strong>
                <p style="text-align: left;">Invoice Outstanding as of {{ $invoiceData['created_at'] }} : Rs. 0</p>
            </div>
            <div class="footer">
                <p style="font-size: 10px;">A company set up u/s 42 of the Companies Act, 2017 Regd. Address:
                    Faiz House: C-151, Gulshan-e-Iqbal Block-09, Karachi, Pakistan, 75300. 
                </p>
            </div>
        </div>
        @endforeach
    </div>
</body> --}}
</html>


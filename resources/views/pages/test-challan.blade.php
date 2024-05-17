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
            display: table; /* A method to ensure equal width and fluid layout */
            table-layout: fixed; /* Ensures the table cells are of equal width */
        }
        .column {
            display: table-cell;
            border: 1px solid black; /* Visual border for each column */
            padding: 10px;
            vertical-align: top; /* Aligns content to the top of the column */
        }
        p {
            margin-top: 5px; 
            margin-bottom: 5px; 
        }
        .header h3 {
            margin: 5px;
            padding-bottom: 10px;
            font-size: 15px;
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
    <div class="container">
        {{-- <div class="row"> --}}
            @php
                $types = ['Customer Copy', 'Bank Copy', 'Accounts Copy'];
            @endphp
            @foreach($types as $index => $type)
            <div class="column" style="border-right-style: dashed">
                <div class="header">
                    <h3 style="float: left;">Habib Bank</h3>
                    <h3 style="float: right;">Al Faiz Builders, Karachi, <br>Pakistan</h3>
                    <div style="clear: both;"></div>
                    <div class="details"> 
                        <p>Challan Date: <span class="under-line">2124134</span></p>
                        <p>2124134</p>
                    </div>
                    <div class="details"> 
                        <p>Invoice No: <span class="under-line">2124134</span></p>
                        <p>Bill ID: <span class="under-line">????????</span></p>
                    </div>
                    <h5>Credit to Al Faiz, Main Collection A/c at State Life Cash Management Branch
                        0011-12345678-03</h5>
                    <div  class="details">
                    <p>Customer Name: <span class="under-line">2124134</span></p></div>
                    <div class="details"> 
                        <p>Customer ID: <span class="under-line">2124134</span</p>
                        <p>Booking ID: <span class="under-line">2124134</span</p>
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
                                {{-- @foreach ($invoiceItems as $invoiceItem) --}}
                                @for($i=0; $i <5; $i++)
                                    <tr>
                                        <td>particular</td>
                                        <td style="text-align: right">2124134</td>
                                    </tr>
                                @endfor
                                {{-- @endforeach --}}
                                <tr>
                                    <th colspan="1">TOTAL</th>
                                    <td style="text-align: right">2124134</td>
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
                    <p style="text-align: left;">Invoice Outstanding as of 2124134 : Rs. 0</p>
                </div>
                <div class="footer">
                    <p style="font-size: 10px;">A company set up u/s 42 of the Companies Act, 2017 Regd. Address:
                        Faiz House: C-151, Gulshan-e-Iqbal Block-09, Karachi, Pakistan, 75300. 
                    </p>
                </div>
            </div>
            @endforeach
        {{-- </div> --}}
    </div>
</body>
</html>


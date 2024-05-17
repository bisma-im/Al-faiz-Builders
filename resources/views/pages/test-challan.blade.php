<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Voucher</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 12px;
            width: 100%;
            height: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
        .column {
            width: 33.33%; /* Sets each column to one third of the table width */
        }
        p {
            display: inline-block;
        }
        .leftContent{
            text-align: left;
            width: 50%;
        }
        .rightContent{
            text-align: right;
            width: 50%
        }
    </style>
</head>
<body>
    <table>
        <tr>
            @php
                $types = ['Customer Copy', 'Bank Copy', 'Accounts Copy'];
            @endphp
            @foreach($types as $type)
            <td class="column">
                <strong>{{ $type }}</strong>
                <div>
                    <p class="leftContent">Habib Bank</p>
                    <p class="rightContent">Al Faiz Builders, Karachi, Pakistan</p>
                    <p>Challan Date: <span class="under-line">2314324</span></p>
                    <p>Invoice No: <span class="under-line">2314324</span></p>
                    <p>Bill ID: <span class="under-line">????????</span></p>
                    <p>Customer Name: <span class="under-line">2314324</span></p>
                    <p>Customer ID: <span class="under-line">2314324</span></p>
                    <p>Booking ID: <span class="under-line">2314324</span></p>
                    <!-- Table for particulars -->
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Particulars</th>
                                <th>Rupees</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 5; $i++)
                            <tr>
                                <td>Item Description</td>
                                <td style="text-align: right;">Amount</td>
                            </tr>
                            @endfor
                            <tr>
                                <th>Total</th>
                                <td style="text-align: right;">Total Amount</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Deposited by: ___________</p>
                    <p>Cashier: ___________</p>
                </div>
            </td>
            @endforeach
        </tr>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alfaiz Payment Voucher</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Calibri', sans-serif;
            background-color: #fff;
            text-align: center;
        }

        .voucher-wrapper {
            width: 800px;
            margin: 20px auto;
            border: 3px solid black;
            padding: 20px;
        }

        header {
            margin-bottom: 20px;
        }

        .header-box {
            display: inline-block;
            width: 30%;
            vertical-align: top;
            text-align: center;
        }

        .header-box img {
            max-width: 100%;
            height: 90px;
        }

        .header-box h4 {
            font-size: 16px;
            text-decoration: underline;
            margin-bottom: 10px;
        }

        .header-box p {
            font-size: 12px;
        }

        .voucher-heading {
            font-size: 24px;
            font-style: italic;
            background-color: chocolate;
            border: 1px solid black;
            padding: 20px 0;
            /* margin-bottom: 20px; */
        }

        .customer-copy-type {
            text-align: right;
            margin-bottom: 20px;
        }

        .customer-copy-type p {
            display: inline-block;
            border: 2px solid black;
            width: 160px;
            text-align: center;
            height: 22px;
            line-height: 22px;
            font-weight: 700;
        }

        .voucher-details {
            width: 100%;
            margin-bottom: 20px;
            text-align: left;
        }

        .voucher-details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .voucher-details th,
        .voucher-details td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        .voucher-details th {
            background-color: #f0f0f0;
        }

        .voucher-details .inline {
            text-align: center;
            font-weight: 700;
            text-decoration: underline;
        }

        .totalAmount-Content {
        display: inline-block; /* This keeps the container fitting to the content */
        height: 30px; /* Maintain the height if needed */
        border: 2px solid #555; /* Border styling */
        font-size: 22px; /* Font styling */
        font-weight: 900; /* Font styling */
        padding: 5px; /* Padding around the content */
    }

    .totalAmount {
        text-align: right; /* Aligns the container to the right */
        margin-bottom: 20px; /* Bottom margin for spacing */
    }

        .sig-section {
            margin-top: 100px;
        }

        .sig-section div {
            display: inline-block;
            width: 25%;
            margin: 0 20px;
            padding-top: 10px;
            border-top: 2px solid black;
            font-weight: 900;
            font-size: 18px;
            text-align: center;
        }

        .no-border {
            border: none !important;
        }
    </style>
</head>

<body>
    <div class="voucher-wrapper">
        <header>
            <div class="header-box">
                <h4>HEAD OFFICE</h4>
                <p>Faiz House C-151, Block-9, Gulshan-e-Iqbal, Karachi.</p>
                <p>UAN: 021 111 11 FAIZ (3249)</p>
            </div>
            <div class="header-box">
                <img src="{{ $imageSrc }}" alt="Alfaiz Logo">
            </div>
            <div class="header-box">
                <h4>BRANCH OFFICE</h4>
                <p>Main Disco Mor, Orangi Town, Karachi.</p>
                <p>Email: <a href="mailto:info@alfaizbuilders.com">info@alfaizbuilders.com</a></p>
                <p>Ph: 021 36668116</p>
            </div>
        </header>

        <div class="voucher-heading">
            {{ $voucherData[0]->voucher_type === 'BPV' || $voucherData[0]->voucher_type === 'CPV' ? 'PAYMENT VOUCHER' : 'RECEIPT VOUCHER'}}
        </div>
        <div class="customer-copy-type">
            <p>ORIGINAL COPY</p>
        </div>
        

        <div class="voucher-details">
            <table>
                <tr class="inline">
                    <td class="no-border">Voucher No.: {{ $voucherId }}</td>
                    <td class="no-border">Ref Slip No.: 000000000</td>
                    <td class="no-border">Date: {{ \Carbon\Carbon::parse($voucherData[0]->added_on)->format('d-M-Y') }}</td>
                </tr>
                <tr>
                    <th>{{$voucherData[0]->voucher_type === 'BPV' || $voucherData[0]->voucher_type === 'CPV' ? 'Paid To: ' : 'Received From'}}</th>
                    <td>{{ $payee }}</td>
                    <th>Amount in Rs.</th>
                    <td>{{ number_format($totals->totalDebitAmount, 2) }}</td>
                </tr>
                <tr>
                    <th>Amount in Words</th>
                    <td colspan="3">{{ $amountInWords }}</td>
                </tr>
                <tr>
                    <th>In Cash/Cheque No.</th>
                    <td>{{ $voucherData[0]->voucher_type === 'CPV' || $voucherData[0]->voucher_type === 'CRV' ? 'In Cash' : $voucherData[0]->cheque_no }}</td>
                    <th>Drawn on Bank</th>
                    <td>{{ $voucherData[0]->drawn_on_bank }}</td>
                </tr>
                <tr>
                    <th>On Account of</th>
                    <td colspan="3">{{ $voucherData[0]->description }}</td>
                </tr>
            </table>
        </div>

        <div class="totalAmount">
            <div class="totalAmount-Content">
                <span>PKR {{ number_format($totals->totalDebitAmount, 2) }}</span> <!-- Use span for inline display -->
            </div>
        </div>

        <div class="sig-section">
            <div>Accountant</div>
            <div>Finance Manager</div>
            <div>Received by</div>
        </div>
    </div>
</body>

</html>
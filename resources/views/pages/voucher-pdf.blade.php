<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Voucher</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .voucher-container {
            width: 100%;
            max-width: 677px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 .header h2{
            margin: 0;
            font-size: 24px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .signature-area {
            margin-top: 30px;
            margin-bottom: 20px;
        }
        .signature-line {
            width: 137px;
            border-top: 1px solid #000;
            display: inline-block;
            margin-right: 10px;
        }
        .voucher-number {
            text-align: right;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="voucher-container">
        <div class="header">
            <h1>The Owners Incorporation of XXX Building</h1>
            <h2>RECEIPT VOUCHER</h2>
            <div class="voucher-number">
                Voucher No.: {{ $voucherId }}
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Account Code</th>
                    <th>Particulars</th>
                    <th class="text-right">Debit PKR</th>
                    <th class="text-right">Credit PKR</th>
                </tr>
            </thead>
            <tbody>
                {{-- Rows will be inserted here --}}
                @foreach ($voucherData as $entry)
                <tr>
                    <td>{{ $entry->account_code }}</td>
                    <td>{{ $entry->description }}</td>
                    <td class="text-right">{{ number_format($entry->debit_amount, 2) }}</td>
                    <td class="text-right">{{ number_format($entry->credit_amount, 2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="2">TOTAL</th>
                    <td class="text-right">{{ number_format($totals->totalDebitAmount, 2) }}</td>
                    <td class="text-right">{{ number_format($totals->totalCreditAmount, 2) }}</td>
                </tr>
            </tbody>
        </table>
        <div>
            <div  class="signature-area">Prepared by: <span class="signature-line"></span> Signature: <span class="signature-line"></span> Date: <span class="signature-line"></span></div>
            <div  class="signature-area">Approved by: <span class="signature-line"></span> Signature: <span class="signature-line"></span> Date: <span class="signature-line"></span></div>
            <div  class="signature-area">Recorded by: <span class="signature-line"></span> Signature: <span class="signature-line"></span> Date: <span class="signature-line"></span></div>
        </div>
    </div>
</body>
</html>

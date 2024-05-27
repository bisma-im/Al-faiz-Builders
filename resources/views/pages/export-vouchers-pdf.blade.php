<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>General Journal</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            position: relative;
        }
        .journal-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        .journal-table th, .journal-table td {
            padding: 5px;
            text-align: left;
            border: none; /* Remove individual borders */
        }
        .journal-table th {
            background-color: #f2f2f2;
            border-bottom: 1.5px solid black; /* Add bottom border to header */
        }
        .journal-table th {
            border-bottom: 1px solid black;
        }
        .journal-table .voucher-end td {
            border-bottom: 1.5px solid black;
        }
        .header-section {
            text-align: center;
            margin-bottom: 20px;
            margin-top: 10px;
        }
        .header-section h1 {
            margin: 0;
        }
        .header-section h2 {
            margin: 0;
        }
        .date-range {
            position: fixed;
            top: 100px;
            right: 5px;
        }
    </style>
</head>
<body>
    <div class="header-section">
        <h1>Al-faiz Builders</h1>
        <h2>General Journal</h2>
        <p>From {{ $fromDate }} to {{ $toDate }}</p>
        <div class="date-range">
            <p>Printing Date: {{ date('d-M-Y') }}<br>Printed By: {{ Session::get('username') }}</p>
        </div>
    </div>
    

    <table class="journal-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Account title and explanation</th>
                <th>Debit</th>
                <th>Credit</th>
            </tr>
        </thead>
        <tbody>
            @php $currentVoucherId = null; @endphp
            @foreach($vouchers as $voucher)
                @if($voucher->voucher_id !== $currentVoucherId)
                    @php $currentVoucherId = $voucher->voucher_id; @endphp
                    <tr>
                        <td>{{ $voucher->date }}</td>
                        <td>{{ $voucher->Account_Title . ' - ' . $voucher->account_code }}</td>
                        <td>{{ number_format($voucher->debit_amount, 2) ?? '' }}</td>
                        <td></td>
                    </tr>
                @else
                    <tr>
                        <td></td>
                        <td>{{ $voucher->Account_Title . ' - ' . $voucher->account_code }}</td>
                        <td></td>
                        <td>{{ number_format($voucher->credit_amount, 2) ?? '' }}</td>
                    </tr>
                @endif
                @if($loop->last || $vouchers[$loop->index + 1]->voucher_id !== $voucher->voucher_id)
                    <tr class="voucher-end">
                        <td></td>
                        <td>{{ '(' . $voucher->description . ')' }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>

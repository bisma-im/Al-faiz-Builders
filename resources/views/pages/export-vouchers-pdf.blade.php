<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>General Journal</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
        }
        .journal-table {
            width: 100%;
            border-collapse: collapse;
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
        }
        .header-section h1 {
            margin: 0;
        }
        .header-section h2 {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="header-section">
        <h1>MOON SERVICES INC.</h1>
        <h2>General Journal</h2>
        <p>For the Month of November 2015</p>
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
            @foreach($vouchers as $voucher)
                <tr class="{{ $loop->iteration % 2 == 0 ? 'voucher-end' : '' }}"> 
                    {{-- <td>{{ $voucher->date->format('M d') }}</td> --}}
                    <td>{{ $loop->iteration % 2 == 0 ? '' : $voucher->date }}</td>
                    <td>{{ $voucher->account_code }}</td>
                    <td>{{ number_format($voucher->debit_amount, 2) }}</td>
                    <td>{{ number_format($voucher->credit_amount, 2) }}</td>
                </tr>
                {{-- <tr><td colspan="4" style="border-bottom: 1px solid black;"></td></tr> --}}
                <!-- Assuming you want to place a border after the credit entry -->
                {{-- @if($voucher->credit_amount)
                    <tr><td colspan="4" style="border-bottom: 1px solid black;"></td></tr>
                @endif --}}
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledger Account</title>
    <style>
        footer {
            width: 100%;
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 100px; 
            color: #000;
            line-height: 35px;
            border-top: 1px solid black;
            font-size: 12px;
        }
        .footer-left {
            float: left;
            padding: 20px; /* Adjust as needed */
        }
        .footer-right {
            float: right;
            padding: 20px; /* Adjust as needed */
        }
        .page-break {
            page-break-after: always;
        }
        .ledger-wrapper {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            padding: 20px;
            margin-bottom: 20px;
        }

        .ledger-header {
            background-color: #a3d5ff;
            color:  black;
            padding: 10px;
            border-radius: 0.25rem;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }

        .ledger-header h1, .ledger-header h2 {
            margin: 0;
            font-size: 1.15rem;
            font-weight: normal; /* Unbold the h1 and h2 elements */
            text-align: center;
        }
        .ledger-header h3 {
            margin: 0;
            font-size: 0.85rem;
            font-weight: normal; /* Unbold the h1 and h2 elements */
            text-align: right;
        }
        
        .ledger-header p {
            margin: 0;
            font-size: 1.15rem;
            font-weight: bold; /* Bold the p element */
            text-align: center;
        }

        .ledger-header .print-info p {
            top: 10px; /* Adjust as needed */
            right: 10px; /* Adjust as needed */
            text-align: right;
            font-weight: bold;
            color: black; /* or any color you wish to use */
            font-size: 0.75rem; /* Adjust as needed */
        }

        .ledger-table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }

        .ledger-table thead tr {
            background-color: #d9d4d8;
        }

        .ledger-table th{
            padding: 0.75rem;
            vertical-align: top;
        }
        .ledger-table td {
            padding: 0.25rem;
            padding-left:0.75rem;
            padding-right:0.75rem;
            vertical-align: top;
        }

        .ledger-table tbody tr td {
            border-left: 1px solid black;
            border-right: 1px solid black;
        }
        
        /* Targets the last tbody row for bottom border */
        .ledger-table tbody tr:last-child td {
            border-bottom: 1px solid black;
        }

        /* Ensure that the header cells have borders all around, including the bottom */
        .ledger-table thead th {
            border: 1px solid black;
        }

        .no-transactions {
            text-align: center;
        }
    </style>
</head>
<body>
    @php
        $rowsPerPage = 27;
        $totalRows = count($transactions); // Assuming $data is your dataset
        $pages = ceil($totalRows / $rowsPerPage);
        $pageNumber = 1;
    @endphp
    @for ($page = 0; $page < $pages; $page++)
        <div class="container mt-4">
            <div class="ledger-wrapper">
                <header>
                    <div class="ledger-header">
                        <h1>Al-Faiz Builders</h1>
                        <h2>General Ledger</h2>
                        <p>{{ $accountName  . ' (' . $accountCode . ')' }}</p>
                        <h3>{{ date('d-M-Y', strtotime($startDate)) . ' - ' . date('d-M-Y', strtotime($endDate)) }}</h3>
                    </div>
                </header>
                <footer>
                    <div class="footer-left">
                        Printed by: {{ Session::get('username') }} 
                    </div>
                    <div class="footer-right">
                        Page: {{ $pageNumber }}
                    </div>
                </footer>
                <table class="table ledger-table">
                    <colgroup>
                        <col style="width: 20%;"> 
                        <col style="width: 40%;">
                        <col style="width: 20%;">
                        <col style="width: 20%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Debit</th>
                            <th>Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = $page * $rowsPerPage; $i < min(($page + 1) * $rowsPerPage, $totalRows); $i++)
                            @php
                                $transaction = $transactions[$i];
                            @endphp
                            <tr>
                                <td>{{ date('d-M-Y', strtotime($transaction->date)) }}</td>
                                <td>{{ $transaction->description }}</td>
                                <td style="text-align: center;">{{ $transaction->debit_amount ? number_format($transaction->debit_amount, 2) : '' }}</td>
                                <td style="text-align: center;">{{ $transaction->credit_amount ? number_format($transaction->credit_amount, 2) : '' }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
        @if ($page < $pages - 1)
            <div class="page-break"></div>
            @php
                $pageNumber++
            @endphp
        @endif
    @endfor
</body>
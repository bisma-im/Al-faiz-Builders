<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trial Balance</title>
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
        .tb-wrapper {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            padding: 20px;
            margin-bottom: 20px;
        }
        .tb-header {
            background-color: #a3d5ff;
            color:  black;
            padding: 5px;
            border-radius: 0.25rem;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }
        .tb-header h1, .tb-header h2 {
            margin: 5px;
            font-size: 1.15rem;
            font-weight: bold; /* Unbold the h1 and h2 elements */
            text-align: center;
        }
        .tb-header p {
            margin: 5px;
            font-size: 1.15rem;
            font-weight: normal; /* Bold the p element */
            text-align: center;
        }
        .tb-table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }

        .tb-table thead tr {
            background-color: #d9d4d8;
        }

        .tb-table th{
            padding: 0.75rem;
            vertical-align: top;
        }
        .tb-table td {
            padding: 0.25rem;
            padding-left:0.75rem;
            padding-right: 15px;
            vertical-align: top;
            
        }
        .tb-table tr td {
            border-left: 1px solid black;
            border-right: 1px solid black;
            margin: 15px;
        }
        
        /* Targets the last tbody row for bottom border */
        .tb-table tr:last-child td:nth-child(-n+2) {
            border-top: 1px solid black;
            border-left: none;
            border-right: none;
            padding: 15px;
            font-size: 17px;
            text-align: right;
            font-weight: bold;
        }
        .tb-table tr:last-child td:nth-last-child(-n+2) {
        /* styles for the last two columns in the last row */
            background-color: #a3d5ff;
            color:  black;
            padding: 15px;
            font-size: 17px;
            text-align: right;
            border: 1px solid black;
        }

        /* Ensure that the header cells have borders all around, including the bottom */
        .tb-table thead th {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    @php
        $rowsPerPage = 27;
        $totalRows = count($accountBalances); // Assuming $data is your dataset
        // $totalRows = 60;
        $pageNumber = 1;
        $pages = ceil($totalRows / $rowsPerPage);
        function format_balance($balance) {
            return $balance > 0 ? number_format($balance, 2) : '(' . number_format(abs($balance), 2) . ')';
        }
    @endphp
    @for ($page = 0; $page < $pages; $page++)
        <div class="container mt-4">
            <div class="tb-wrapper">
                <header>
                    <div class="tb-header">
                        <h1>Al-Faiz Builders</h1>
                        <h2>Trial Balance</h2>
                        <p>{{ date('M j, Y', strtotime($startDate)) . ' - ' . date('M j, Y', strtotime($endDate)) }}</p>
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
                <table class="table tb-table">
                    <colgroup>
                        <col style="width: 20%;"> 
                        <col style="width: 40%;">
                        <col style="width: 20%;">
                        <col style="width: 20%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Account Code</th>
                            <th>Account Name</th>
                            <th>Debit</th>
                            <th>Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = $page * $rowsPerPage; $i < min(($page + 1) * $rowsPerPage, $totalRows); $i++)
                            @php
                                $accountBalance = $accountBalances[$i];
                                
                            @endphp
                            <tr>
                                <td>{{ $accountBalance->account_code }}</td>
                                <td>{{ $accountBalance->Account_Title }}</td>
                                <td style="text-align: right;">
                                    @if (in_array(substr($accountBalance->account_code, 0, 1), ['1', '5']) || in_array($accountBalance->account_code, ['4-001-002', '6-001-001']))
                                        {{ format_balance($accountBalance->balance) }}
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    @if (in_array(substr($accountBalance->account_code, 0, 1), ['2', '3', '4']) && !in_array($accountBalance->account_code, ['4-001-002', '6-001-001', '6-001-002']))
                                        {{ format_balance($accountBalance->balance) }}
                                    @elseif ($accountBalance->account_code == '6-001-002')
                                        {{ format_balance($accountBalance->balance) }}
                                    @endif
                                </td>
                            </tr>
                        @endfor
                        <tr>
                            <td></td>
                            <td> TOTAL </td>
                            <td>{{ number_format($totalDebits, 2) }}</td>
                            <td>{{ number_format($totalCredits, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endfor
</body>

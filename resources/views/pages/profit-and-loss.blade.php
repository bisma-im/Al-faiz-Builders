<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trial Balance</title>
    <style>
        footer {
            width: 100%;
            position: relative; 
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

        /* .tb-table thead tr {
            background-color: #d9d4d8;
        } */

        .tb-table th{
            padding: 0.75rem;
            vertical-align: top;
        }
        .tb-table td {
            padding-top: 10px;
            padding-left: 10px;
            padding-right: 10px;
            /* padding-left:0.75rem;
            padding-right: 15px; */
            /* vertical-align: top; */
        }
        .tb-table tr:nth-child(even) {
            background-color: #a3d5ff;
        }
        /* .tb-table tr td {
            border-left: 1px solid black;
            border-right: 1px solid black;
        } */
        
        /* Targets the last tbody row for bottom border */
        /* .tb-table tr:last-child td:nth-child(-n+2) {
            border-top: 1px solid black;
            border-left: none;
            border-right: none;
            padding: 15px;
            font-size: 17px;
            text-align: right;
            font-weight: bold;
        } */
        /* styles for the last two columns in the last row */
        /* .tb-table tr:last-child td:nth-last-child(-n+2) {
            background-color: #a3d5ff;
            color:  black;
            padding: 15px;
            font-size: 17px;
            text-align: right;
            border: 1px solid black;
        } */

        /* Ensure that the header cells have borders all around, including the bottom */
        .tb-table thead th {
            text-align: right;
        }
        .signature-line {
            width: 137px;
            border-top: 1px solid #000;
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    @php
        $rowsPerPage = 27;
        $totalRows = 0; // Assuming $data is your dataset
        foreach ($headings as $heading) {
            // Add one row for the heading itself
            $totalRows ++;

            // Count the detail rows for this heading
            foreach ($details as $detail) {
                if (Str::startsWith($detail->Account_Code, $heading->Account_Code . '-')) {
                    $totalRows ++;
                }
            }   
            $totalRows ++;
        }
        $pageNumber = 1;
        $pages = ceil($totalRows / $rowsPerPage);
    @endphp

    @for ($page = 0; $page < $pages; $page++)
        <div class="container mt-4">
            <div class="tb-wrapper">
                <header>
                    <div class="tb-header">
                        <h1>Al-Faiz Builders</h1>
                        <h2>Statement of Profit and Loss</h2>
                        <p>{{ ' For the Year Ended ' . date('Y', strtotime($endDate)) }}</p>
                    </div>
                </header>
                <table class="table tb-table">
                    <colgroup>
                        <col style="width: 30%;"> 
                        <col style="width: 40%;">
                        <col style="width: 15%;">
                        <col style="width: 15%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>(PKR)</th>
                            <th>(PKR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @for ($i = $page * $rowsPerPage; $i < min(($page + 1) * $rowsPerPage, $totalRows); $i++) --}}
                            @foreach ($headings as $Account_Code => $heading)
                                @php
                                    // Find all details that belong to the current heading
                                    $currentDetails = $details->filter(function ($detail) use ($heading) {
                                        return Str::startsWith($detail->Account_Code, $heading->Account_Code);
                                    });
                                    // Get the last detail item for comparison
                                    $lastDetail = $currentDetails->last();
                                @endphp
                                <tr>
                                    <td style="font-weight: bold">{{ $heading->Account_Title }}</td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right; font-weight: bold; text-decoration-line: underline overline;
                                    text-decoration-style: double;" >{{ $heading->underoverline ? number_format($heading->net_balance, 2) : ''}}</td>
                                </tr>
                                
                                @foreach ($currentDetails as $detail)
                                    <tr>
                                        <td style="padding-left: 100px;">{{ $detail->Account_Code }}</td>
                                        <td>{{ $detail->Account_Title }}</td>
                                        <td style="text-align: right; {{ $detail->Account_Code === $lastDetail->Account_Code ? 'text-decoration: underline; text-decoration-thickness: 2px;' : '' }}">
                                            {{ number_format($detail->net_balance, 2) }}
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                @if (!$heading->underoverline)
                                    <tr>
                                        <td style="font-weight: bold">{{  'Total ' . Str::lower($heading->Account_Title) }}</td>
                                        <td></td>
                                        <td style="width: 120px; margin-left: 10px"></td>
                                        <td style="text-align: right; font-weight: bold;">{{ number_format($heading->net_balance, 2) }}</td>
                                    </tr>
                                @endif
                                
                            @endforeach


                            {{-- <tr>
                                <td></td>
                            </tr> --}}
                        {{-- @endfor --}}
                    </tbody>
                </table>
            </div>
            <footer>
                <div class="footer-left">
                    Printed by: {{ Session::get('username') }} 
                </div>
                <div class="footer-right">
                    Page: {{ $pageNumber }}
                </div>
            </footer>
        </div>
    @endfor
</body>

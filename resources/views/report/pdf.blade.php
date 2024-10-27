<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Report Print PDF | {{ $report->title }}</title>
    <base href="/">

    <style>
        table.tborder,
        table.tborder th,
        table.tborder td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }

        table.tborder td.nopadding{
            padding:0px !important; margin:0px !important;
        }

        table.tborder {
            width: 100%;
        }

        table.tlist td {
            padding: 0.5px
        }

        .page-break {
            page-break-before: always;
        }

        h1 {
            font-size: 14pt
        }

        h2 {
            font-size: 12pt
        }

        p,
        ol li,
        ul li {
            text-align: justify
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .textcenter {
            text-align: center;
        }

        .bgGrey {
            background-color: #C0C0C0
        }
    </style>

</head>

<body>


    <!-- begin:: Content -->
    <p style="margin-bottom:0; padding-bottom:0;font-size: 10pt;">
        PT. ABCD EFGH
    </p>

    <p class="textcenter" style="margin-top:0; padding-top:0;font-size: 14pt;">
        <b> XYZ Report</b>
    </p>
    <!-- end:: Content -->

    <table cellspacing="0" cellpadding="0" style="width:100%; margin-bottom:10px">
       <tr>
            <td>Department</td>
            <td>: {{ $report->user->department }}</td>
            <td>Date</td>
            <td>: {{ date("d F y", strtotime($report->report_at)) }} <br></td>
        </tr>
        <tr>
            <td>Section / Shift</td>
            <td>: {{ $report->user->section }} / {{ $report->shift }}</td>
            <td>Time</td>
            <td>: {{ date("H:i", strtotime($report->report_at)) }} <br></td>
        </tr>
    </table>

    <div style="font-size: 11.5pt;">

        <table style="width:100%" class="tborder">
            <tr>
                <td colspan="2">
                    <b>Title: {{ $report->title }}</b>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p style="margin: 0; padding:0"><b>Potential dangerous Point: </b></p>
                    @if ($report->potential_dangerous_point != '')
                    <ul style="margin-top: 0; padding-top:0">
                        @foreach ( $report->potential_dangerous_point as $potential_dangerous_point )
                        <li>{{ $potential_dangerous_point }}</li>
                        @endforeach
                    </ul>
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p style="margin: 0; padding:0"><b>The Most Danger Point: </b></p>
                    @if ($report->most_danger_point != '')
                    <ul style="margin-top: 0; padding-top:0">
                        @foreach ( $report->most_danger_point as $most_danger_point )
                        <li>{{ $most_danger_point }}</li>
                        @endforeach
                    </ul>
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p style="margin: 0; padding:0"><b>Statement / Countermeasure: </b></p>
                    @if ($report->statement != '')
                    <p style="margin-top: 0; padding-top:0">
                        {{ $report->statement }}
                    </p>
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p style="margin: 0; padding:0"><b>Keyword: </b></p>
                    @if ($report->keyword != '')
                    <ul style="margin-top: 0; padding-top:0">
                        @foreach ( $report->keyword as $keyword )
                        <li>{{ $keyword }}</li>
                        @endforeach
                    </ul>
                    @endif
                </td>
            </tr>
            <tr>
                <td width="20%"><b>Instructor / Sign: </b></td>
                <td class="nopadding">

                    @if ($report->instructors)
                    <table style="border-collapse: collapse;width:100%; border-style: hidden;">
                        @foreach ( $report->instructors as $instructors )
                            <tr>
                                <td width="5%">{{ $loop->index + 1 }}.</td>
                                <td width="45%">{{ $instructors->user->name }}</td>
                                <td style="border-left-style: hidden;">/</td>
                            </tr>
                        @endforeach
                    </table>
                    @endif

                </td>
            </tr>

            <tr>
                <td width="20%"><b>Attendance / Sign: </b></td>
                <td class="nopadding">

                    @if ($report->attendant != '')
                    @php
                        $j = 0; $i= 0;
                    @endphp
                    <table style="border-collapse: collapse;width:100%; border-style: hidden;">
                        @foreach ( array_chunk($report->attendant, 2, true) as $row )

                            <tr>
                                @foreach ( $row as $value )
                                @php
                                $j++;
                                @endphp
                                <td width="5%">{{ ($loop->first) ? $j : ($i+1)*2 }}.</td>
                                <td width="25%">{{ $value }}</td>
                                <td width="20%" style="border-left-style: hidden;">/</td>
                                @if (count($row) == 1)
                                <td width="5%"></td>
                                <td width="25%"></td>
                                <td width="20%" style="border-left-style: hidden;"></td>
                                @endif
                                @endforeach
                            </tr>
                            @php
                            $i++;
                            @endphp
                        @endforeach
                    </table>
                    @endif

                </td>
            </tr>

        </table>

        <table style="width:100%" class="tborder textcenter" style="margin-bottom:20px">
            <tr>
                <td>
                    Prepared By <br><br> <strong><i>{{ $report->user->name }}</i></strong>
                </td>
                <td>
                    Checked By <br><br> <strong><i>{{ $report->checker }}</i></strong>
                </td>
                <td>
                    Reviewed By <br><br> <strong><i>{{ $report->reviewer ?? '-' }}</i></strong>
                </td>
                <td>
                    Approved 1 By <br><br> <strong><i>{{ $report->user_approver1->name ?? '-' }}</i></strong>
                </td>
                <td>
                    Approved 2 By <br><br> <strong><i>{{ $report->user_approver2->name ?? '-' }}</i></strong>
                </td>
            </tr>
        </table>

        <div>
            <div style="margin-left: auto;margin-right: 0; border: 1px solid black; width:35%; padding:5px 20px; text-align: center;">
                Form  No. : xxx-zz-{{ sprintf("%03d", $report->id); }}, {{ date("d-M-y", strtotime($report->report_at)) }}
            </div>
        </div>

    </div>

</body>

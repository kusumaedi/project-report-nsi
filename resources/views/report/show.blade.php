@extends('layouts.master')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">
            Detail Report
          </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
          <div class="d-flex">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
              <li class="breadcrumb-item"><a href="{{ route('report.index') }}">Report</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#">Detail</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <!-- Container Page -->
    <div class="page page-center">
    <div class="container py-4">


        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Detail Report</h3>
          </div>
          <div class="card-body">



            <div class="row mb-3 h4">
                <div class="col-2">
                    Department <br>
                    Section / Shift
                </div>
                <div class="col-4">
                    : {{ $report->user->department }} <br>
                    : {{ $report->user->section }} / {{ $report->shift }}
                </div>
                <div class="col-2">
                    Date <br>
                    Time
                </div>
                <div class="col-4">
                    : {{ date("d-M-y", strtotime($report->report_at)) }} <br>
                    : {{ date("H:i", strtotime($report->report_at)) }}
                </div>
            </div>

            <table class="table table-bordered mb-4">
                <tr>
                    <td colspan="2">
                        <b>Title: {{ $report->title }}</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p><b>Potential dangerous Point: </b></p>
                        @if ($report->potential_dangerous_point != '')
                        <ul>
                            @foreach ( $report->potential_dangerous_point as $potential_dangerous_point )
                            <li>{{ $potential_dangerous_point }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p><b>The Most Danger Point: </b></p>
                        @if ($report->most_danger_point != '')
                        <ul>
                            @foreach ( $report->most_danger_point as $most_danger_point )
                            <li>{{ $most_danger_point }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p><b>Statement / Countermeasure: </b></p>
                        @if ($report->statement != '')
                        <p>
                            {{ $report->statement }}
                        </p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p><b>Keyword: </b></p>
                        @if ($report->keyword != '')
                        <ul>
                            @foreach ( $report->keyword as $keyword )
                            <li>{{ $keyword }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td width="20%"><b>Instructor / Sign: </b></td>
                    <td>

                        @if ($report->instructors)
                            @foreach ( $report->instructors as $instructors )
                                <div class="row">
                                    <div class="col-6">
                                        {{ $instructors->user->name }}
                                    </div>
                                    <div class="col-6">
                                        /
                                    </div>

                                </div>
                                @if(!$loop->last)
                                <hr class="m-0 my-1">
                                @endif
                            @endforeach
                        @endif

                    </td>
                </tr>

                <tr>
                    <td width="20%"><b>Attendant / Sign: </b></td>
                    <td>
                        @if ($report->attendant != '')
                            @foreach ( array_chunk($report->attendant, 2, true) as $chunk)
                            <div class="row">
                                @foreach($chunk as $item)
                                    <div class="col-md-6 pl-2 pr-3" style="border-bottom: 1px solid #ccc; {{ (!$loop->last) ? 'border-right: 1px solid #ccc;' : '' }}">
                                        <div class="row mb-0 my-1">
                                            <div class="col-6">
                                                {{ $item }}
                                            </div>
                                            <div class="col-6">
                                                /
                                            </div>
                                        </div>
                                    </div>
                                    @if (count($chunk) == 1)
                                    <div class="col-md-6 pl-2 pr-3" style="border-bottom: 1px solid #ccc; {{ (!$loop->last) ? 'border-right: 1px solid #ccc;' : '' }}">
                                        <div class="row mb-0 my-1">
                                            <div class="col-6"></div>
                                            <div class="col-6"></div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            @endforeach
                        @endif

                    </td>
                </tr>

            </table>

          </div>

        </div>
    </div>

    </div>
    <!-- Container Page -->
  </div>
  <!-- Page body -->

@endsection

@section('style')
<link href="{{ asset('Tabler/dist/css/tabler-vendors.min.css') }}" rel="stylesheet"/>

@endsection





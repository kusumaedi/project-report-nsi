@extends('layouts.master')
@section('content')

@php
// use App\Models\Category;
@endphp

<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">
            Dashboard
          </h2>
        </div>

      </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <!-- Container Page -->
    <div class="container">

        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">Report Project</h3>
            </div>
            <div class="card-body">
                @if (auth()->user()->isAdmin())

                <div class="col-12 mb-3">
                    <div class="row row-cards">

                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <a class="card card-sm card-link" href="{{ route('report.admin') }}?status=Submit">
                              <div class="card-body">
                                <div class="row align-items-center">
                                  <div class="col-auto">
                                    <span class="bg-warning text-white avatar avatar-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                        </svg>
                                    </span>
                                  </div>
                                  <div class="col text-end">
                                    <div class="display-6 fw-bold text-red">
                                        {{ $report->where('status', 'Submit')->count(); }}
                                    </div>
                                    <div class="text-uppercase text-secondary font-weight-medium">
                                      Need Review
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </a>
                          </div>

                      <div class="col-sm-6 col-md-4 col-lg-3">
                        <a class="card card-sm card-link" href="{{ route('report.admin') }}?status=Reviewed">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col-auto">
                                <span class="bg-cyan text-white avatar avatar-xl">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-checklist"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" /><path d="M14 19l2 2l4 -4" /><path d="M9 8h4" /><path d="M9 12h2" /></svg>
                                </span>
                              </div>
                              <div class="col text-end">
                                <div class="display-6 fw-bold text-red">
                                    {{ $report->whereIn('status', ['Reviewed', 'Approved'])->count(); }}
                                </div>
                                <div class="text-uppercase text-secondary font-weight-medium">
                                  Waiting Approval
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>

                      <div class="col-sm-6 col-md-4 col-lg-3">
                        <a class="card card-sm card-link" href="{{ route('report.admin') }}?status=Completed">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col-auto">
                                <span class="bg-primary text-white avatar avatar-xl">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-checkup-list"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 14h.01" /><path d="M9 17h.01" /><path d="M12 16l1 1l3 -3" /></svg>
                                </span>
                              </div>
                              <div class="col text-end">
                                <div class="display-6 fw-bold text-red">
                                    {{ $report->where('status', 'Completed')->count(); }}
                                </div>
                                <div class="text-uppercase text-secondary font-weight-medium">
                                  Completed Report
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>
                      <div class="col-sm-6 col-md-4 col-lg-3">
                        <a class="card card-sm card-link" href="{{ route('report.admin') }}">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col-auto">
                                <span class="bg-facebook text-white avatar avatar-xl"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-text" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path><path d="M9 12h6"></path><path d="M9 16h6"></path>
                                     </svg>
                                </span>
                              </div>
                              <div class="col text-end">
                                <div class="display-6 fw-bold text-info">
                                    {{ $report->count(); }}
                                </div>
                                <div class="text-uppercase text-secondary font-weight-medium">
                                  Total Report
                                </div>
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>

                    </div>
                  </div>

                  <div class="row row-cards mt-2">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Report Summary</h3>
                            </div>
                            <div class="card-body">
                                <div id="chart-month-request"></div>
                            </div>
                        </div>
                    </div>
                  </div>

                @else
                <p class="text-center">
                    Welcome, {{ auth()->user()->name }}
                </p>
                @endif

            </div>
        </div>

    </div>
    <!-- Container Page -->
  </div>
  <!-- Page body -->

@endsection

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('Tabler/dist/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
<script>
    $(function() {
        $("#MyTable").DataTable({
            "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, 'All'],
                        ],
            "pageLength" : 25,
            "autoWidth": false,
        });
    });
</script>

@php
      $req_year = $report->filter(function ($value) { return $value->created_at->year == date("Y"); });
      $jan = $req_year->filter(function ($value) { return $value->created_at->month == '01'; })->count();
      $feb = $req_year->filter(function ($value) { return $value->created_at->month == '02'; })->count();
      $mar = $req_year->filter(function ($value) { return $value->created_at->month == '03'; })->count();
      $apr = $req_year->filter(function ($value) { return $value->created_at->month == '04'; })->count();
      $mei = $req_year->filter(function ($value) { return $value->created_at->month == '05'; })->count();
      $jun = $req_year->filter(function ($value) { return $value->created_at->month == '06'; })->count();
      $jul = $req_year->filter(function ($value) { return $value->created_at->month == '07'; })->count();
      $aug = $req_year->filter(function ($value) { return $value->created_at->month == '08'; })->count();
      $sep = $req_year->filter(function ($value) { return $value->created_at->month == '09'; })->count();
      $oct = $req_year->filter(function ($value) { return $value->created_at->month == '10'; })->count();
      $nov = $req_year->filter(function ($value) { return $value->created_at->month == '11'; })->count();
      $des = $req_year->filter(function ($value) { return $value->created_at->month == '12'; })->count();
  @endphp

<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-month-request'), {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 240,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                }
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: "Total report",
                data: [{{ $jan }}, {{ $feb }}, {{ $mar }}, {{ $apr }}, {{ $mei }}, {{ $jun }}, {{ $jul }}, {{ $aug }}, {{ $sep }}, {{ $oct }}, {{ $nov }}, {{ $des }}]
            }],
            tooltip: {
                theme: 'dark'
            },
            grid: {
                padding: {
                    top: -20,
                    right: 0,
                    left: -4,
                    bottom: -4
                },
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                },
                axisBorder: {
                    show: false,
                },
                //type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ],
            colors: [tabler.getColor("primary")],
            legend: {
                show: false,
            },
        })).render();
    });
    // @formatter:on
  </script>

@endsection

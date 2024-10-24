@extends('layouts.master')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">
            Report List
          </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
          <div class="d-flex">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
              <li class="breadcrumb-item"><a href="{{ route('report.index') }}">Request</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#">List</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <!-- Container Page -->
    <div class="container">

      {{-- alert component   --}}
      <x-alert type='success' />

      <!-- Card -->
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Manage Report</h3>
            <div class="card-actions">
                <a href="{{ route('report.create') }}" class="btn btn-primary">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
                    New Report
                </a>

              </div>
          </div>
        <div class="card-body">

          <div id="table-default" class="table-responsive">
            @unless(count($report) == 0)

            <form id="bulkForm" action="" method="post">
            @csrf
            <table class="table table-bordered table-striped table-vcenter" id="MyTable">
                <thead>
                    <tr>
                        <th width="2%">#</th>
                        <th>Prepared By</th>
                        <th>Department</th>
                        <th>Section / Shift</th>
                        <th>Datetime</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th width="75px"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($report as $list)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $list->user->name }}</td>
                        <td>
                            {{ $list->user->department }}
                        </td>
                        <td>{{ $list->user->section }}</td>
                        <td data-sort="{{ strtotime($list->report_at) }}">{{ date("d-M-y H:i", strtotime($list->report_at)) }}</td>
                        <td>{{ $list->title }}</td>
                        <td class="text-center">
                            {!! $list->status_badge !!}
                        </td>
                        <td class="text-center">

                            <div class="d-inline">
                                <a href="{{ route('report.show', $list->id) }}" class="btn btn-secondary btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path><path d="M9 7l6 0"></path><path d="M9 11l6 0"></path><path d="M9 15l4 0"></path>
                                        </svg>
                                </a>
                            </div>

                            <div class="d-inline">
                                <a href="{{ route('report.edit', $list->id) }}" class="btn btn-info btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path><path d="M16 5l3 3"></path>
                                    </svg>
                                </a>
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </form>
            @else
            <p>No report data found</p>
            @endunless
          </div>
        </div>

      </div>
      <!-- Card -->

    </div>
    <!-- Container Page -->
  </div>
  <!-- Page body -->

@endsection

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <script>
        $(".input-date").flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d"
        });
        // let table = new DataTable('#MyTable');
        $(function() {
            $("#MyTable").DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All'],
                ],
                "pageLength": 25,
                "autoWidth": false,
                "order": [[1, 'asc']],
                "columnDefs": [
                    { "orderable": false, "targets": 0 }
                ]
            });
        });


    </script>
@endsection

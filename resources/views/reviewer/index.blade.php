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
              <li class="breadcrumb-item"><a href="{{ route('report.reviewer') }}">Request</a></li>
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
          </div>
        <div class="card-body">
            <form method="GET" class="mb-4">
                <div class="row row-cards">
                    <div class="col-sm-6 col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Department</label>
                          <select name="department_id" id="department_id" class="form-select">
                            <option value="">-choose-</option>
                            @foreach ($department as $dept)
                            <option value="{{ $dept->id }}" {{ (request()->get('department_id') == $dept->id) ? 'selected' : '' }}>{{ $dept->name }}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Section</label>
                          <div class="input-icon">

                            <select name="section_id" id="section_id" class="form-control">
                                <option value="">-choose-</option>
                                @foreach ($section as $sect)
                                <option value="{{ $sect->id }}" {{ (request()->get('section_id') == $sect->id) ? 'selected' : '' }}>{{ $sect->name }}</option>
                                @endforeach
                            </select>

                            <span class="input-icon-addon d-none" id="hidden_load">
                                <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                            </span>

                          </div>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="mb-3">
                            <label class="form-label text-white d-none d-md-block">Filter</label>
                            <button type="submit" class="btn btn-warning form-control">Filter</button>
                        </div>
                    </div>

                </div>
            </form>

          <div id="table-default" class="table-responsive">
            @unless(count($report) == 0)
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
                        <th width="120px"></th>
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


                            <a href="{{ route('report.show', $list->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path><path d="M9 7l6 0"></path><path d="M9 11l6 0"></path><path d="M9 15l4 0"></path>
                                    </svg>
                            </a>


                            <a href="#" class="text-success action-ok" data-id="{{ $list->id }}" title="Ok" data-bs-toggle="modal" data-bs-target="#okModal">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                            </a>

                            <a href="#" class="text-danger action-cancel" data-id="{{ $list->id }}" title="Abort" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                            </a>


                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

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


<!-- Modal OK -->
<div class="modal" id="okModal" tabindex="-1">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">

        <form action="" method="POST" id="formConfirm">
        @csrf
        @method('PUT')

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-success"></div>
        <div class="modal-body text-center py-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <circle cx="12" cy="12" r="9" />
            <path d="M9 12l2 2l4 -4" />
          </svg>
          <h3>Review Confirmation</h3>
          <div class="text-secondary">You have read all the report information, and AGREE to continue this report to APPROVER.</div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col">
                <button type="submit" class="btn btn-success w-100" id="confirm-btn">
                  Confirm
                </button>
              </div>
            </div>
          </div>
        </div>

        </form>

      </div>
    </div>
  </div>

<!-- Modal Cancel -->
  <div class="modal" id="rejectModal" tabindex="-1">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">

        <form action="" method="POST" id="formCancel">
        @csrf
        @method('PUT')

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-danger"></div>
        <div class="modal-body text-center py-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 9v2m0 4v.01" />
            <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
          </svg>
          <h3>Are you sure?</h3>
          <div class="text-secondary">Do you really want to reject the report? What you've done cannot be undone.</div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                  Close
                </a></div>
              <div class="col">
                <button type="submit" class="btn btn-danger w-100" id="cancel-btn">
                    Reject report
                </button>
              </div>
            </div>
          </div>
        </div>

        </form>

      </div>
    </div>
  </div>


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

    $(document).on('change', '#department_id', function() {
        var item = $(this).val();
        $('#hidden_load').removeClass('d-none');
        $.ajax({
            url : '{{ route("department.generatesection", ":id") }}'.replace(':id', item),
            data: {
            "_token": "{{ csrf_token() }}",
            },
            type:'POST',
            success:function(data){
                $('#hidden_load').addClass('d-none');
                $("#section_id").html('');
                $("#section_id").append('<option value="">-choose size-</option>');
                $.each(data.section, function(key, value) {
                    $("#section_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                });

            }
        });
    });

    </script>


@endsection

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
                <div id="chart"></div>
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

@endsection

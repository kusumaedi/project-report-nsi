@extends('layouts.master')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">
            Create New Report
          </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
          <div class="d-flex">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
              <li class="breadcrumb-item"><a href="{{ route('report.index') }}">Report</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#">Create</a></li>
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

        @if($errors->any())
           <div class="alert alert-warning alert-dismissible" role="alert">
            <div class="d-flex">
              <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z"></path>
                    <path d="M12 9v4"></path>
                    <path d="M12 17h.01"></path>
                 </svg>
              </div>
              <div>
                {!! implode('', $errors->all('<div>- :message</div>')) !!}
              </div>
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
          </div>
        @endif

        <x-form class="card card-md" action="{{ route('report.store') }}" method="post">
          <div class="card-header">
            <h3 class="card-title">Report Form</h3>
          </div>
          <div class="card-body">

            <div class="row">
                <div class="col-xl-4">
                    <div class="mb-3">
                        <x-label class="col-form-label">Prepared By</x-label>
                        <x-input type="text" disabled value="{{ auth()->user()->name }}"/>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="mb-3">
                        <x-label class="col-form-label">Department</x-label>
                        <x-input type="text" disabled  value="{{ auth()->user()->department }}"/>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="mb-3">
                        <x-label class="col-form-label">Section</x-label>
                        <x-input type="text" disabled  value="{{ auth()->user()->section }}"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="mb-3">
                        <x-label class="col-form-label required">Checked By</x-label>
                        <x-select name="checker" id="checker" placeholder="Search...">
                            <optgroup label="User List">
                            @foreach ($user as $emp)
                                @if (old('checker'))
                                <option value="{{ $emp->name }}" {{ ($emp->name == old('checker')) ? "selected" : "" }}>{{ $emp->name }}</option>
                                @else
                                <option value="{{ $emp->name }}">{{ $emp->name }}</option>
                                @endif
                            @endforeach
                            </optgroup>
                        </x-select>
                        <small class="form-hint">List checker options generated from user lists</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="mb-3">
                        <x-label class="col-form-label required">Shift</x-label>
                        <x-input type="text" name="shift" id="shift" placeholder="Input shift" value="{{ old('shift') }}"/>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="mb-3">
                        <x-label class="col-form-label required">Date and time</x-label>
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" />
                                </svg>
                            </span>
                            <x-input placeholder="Select date and time" id="datepicker-report_at" class="input-date" name="report_at" value="{{ date('Y-m-d') }}" required />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="mb-3">
                        <x-label class="col-form-label required">Title</x-label>
                        <x-input type="text" name="title" id="title" placeholder="Input title" value="{{ old('title') }}"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="mb-3">
                        <x-label class="col-form-label required">Potential Dangerous Point</x-label>
                        <x-select name="potential_dangerous_point[]" id="potential_dangerous_point" multiple="multiple"></x-select>
                        <small class="form-hint">Define the potential list, then add.</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="mb-3">
                        <x-label class="col-form-label required">The Most Danger Point</x-label>
                        <x-select name="most_danger_point[]" id="most_danger_point" multiple="multiple">
                        </x-select>
                        <small class="form-hint">Select one or many, from above aptions</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="mb-3">
                        <label class="form-label required">Statement / Countermeasure</label>
                        <x-textarea class="form-control" rows="2" data-bs-toggle="autosize" name="statement">{{ old('statement') }}</x-textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="mb-3">
                        <x-label class="col-form-label required">Keywords</x-label>
                        <x-select name="keyword[]" id="keyword" multiple="multiple"></x-select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="mb-3">
                        <x-label class="col-form-label required">Instructor</x-label>
                        <x-select name="instructor[]" id="instructor" multiple placeholder="Search...">
                            <optgroup label="User List">
                            @foreach ($user as $emp)
                                @if (old('instructor'))
                                <option value="{{ $emp->id }}" {{ (in_array($emp->id, old('instructor'))) ? "selected" : "" }}>{{ $emp->name }}</option>
                                @else
                                <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                @endif
                            @endforeach
                            </optgroup>
                        </x-select>
                        <small class="form-hint">List instrustor options generated from user lists</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="mb-3">
                        <x-label class="col-form-label required">Attendant</x-label>
                        <x-select name="attendant[]" id="attendant" multiple="multiple"></x-select>
                    </div>
                </div>
            </div>

          </div>
          <div class="card-footer text-end">
            <x-button>Submit</x-button>
          </div>
        </x-form>
    </div>

    </div>
    <!-- Container Page -->
  </div>
  <!-- Page body -->

@endsection

@section('style')
<link href="{{ asset('Tabler/dist/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/dark.css') }}">
@endsection

@section('script')
<script src="{{ asset('js/flatpickr.js') }}"></script>
<script src="{{ asset('Tabler/dist/libs/tom-select/dist/js/tom-select.complete.min.js?1684106062') }}"></script>
<script src="{{ asset('js/jquery.repeater.min.js') }}"></script>
<script>
    //formatting the date input
    $(".input-date").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        //minDate: "today"
    });

    //add potential dangereous point, then select the most from previous input point
    document.addEventListener("DOMContentLoaded", function() {
        var el;
        window.TomSelect && (new TomSelect(el = document.getElementById('potential_dangerous_point'), {
            create: true,
            delimiter: ';',
            copyClassesToDropdown: false,
            dropdownParent: 'body',
            controlInput: '<input>',
            plugins: ['remove_button'],
            render: {
                item: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
                option: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
            },
            onItemAdd : function(value) {
                            $('#most_danger_point').append($('<option>', {
                                value: value,
                                text: value
                            }));

                        },
            onItemRemove : function(value) {
                            $("#most_danger_point option[value='"+value+"']").remove();
                        }
        }));
    });

    //add keyword options
    document.addEventListener("DOMContentLoaded", function() {
        var el_keyword;
        window.TomSelect && (new TomSelect(el_keyword = document.getElementById('keyword'), {
            create: true,
            delimiter: ';',
            copyClassesToDropdown: false,
            dropdownParent: 'body',
            controlInput: '<input>',
            plugins: ['remove_button'],
            render: {
                item: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
                option: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
            },

        }));
    });

    //add attendant
    document.addEventListener("DOMContentLoaded", function() {
        var el_attendant;
        window.TomSelect && (new TomSelect(el_attendant = document.getElementById('attendant'), {
            create: true,
            delimiter: ';',
            copyClassesToDropdown: false,
            dropdownParent: 'body',
            controlInput: '<input>',
            plugins: ['remove_button'],
            render: {
                item: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
                option: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
            },

        }));
    });

    new TomSelect("#instructor",{
        plugins: ['remove_button'],
    });

    new TomSelect("#checker");

</script>
@endsection



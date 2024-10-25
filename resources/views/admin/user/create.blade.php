@extends('layouts.master')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage User
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="#">Manage</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Create New</a></li>
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
            <div class="container container-tight py-4">

                <x-form class="card card-md" action="{{ route('user.store') }}" method="post">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Create new user</h2>

                        <div class="mb-3">
                            <x-label class="form-label">Username</x-label>
                            <x-input type="text" class="form-control" placeholder="Enter name" name="name" id="name" />
                        </div>
                        <div class="mb-3">
                            <x-label class="form-label">Name</x-label>
                            <x-input type="text" class="form-control" placeholder="Enter name" name="name" id="name" />
                        </div>
                        <div class="mb-3">
                            <x-label class="form-label">Email address</x-label>
                            <x-input type="email" class="form-control" placeholder="Enter email" name="email" id="email" />
                        </div>
                        <div class="mb-3">
                            <x-label class="form-label">Department</x-label>
                            <x-select name="department_id" id="department_id" class="form-select">
                                <option value="">-choose-</option>
                                @foreach ($department as $dept)
                                <option value="{{ $dept->id }}" {{ (request()->get('department_id') == $dept->id) ? 'selected' : '' }}>{{ $dept->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="mb-3">
                            <x-label class="form-label">Section</x-label>
                            <div class="input-icon">

                                <select name="section_id" id="section_id" class="form-control">
                                    <option value="">-choose-</option>
                                </select>

                                <span class="input-icon-addon d-none" id="hidden_load">
                                    <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                                </span>

                              </div>
                        </div>
                        <input type="hidden" name="department" id="department" />
                        <input type="hidden" name="section" id="section" />

                        <div class="form-footer">
                            <x-button type="submit" class="btn btn-primary w-100">Create new account</x-button>
                        </div>
                    </div>
                </x-form>
            </div>

        </div>
        <!-- Container Page -->
    </div>
    <!-- Page body -->
@endsection

@section('style')
<style>
#overlay {position: absolute;top: 0rem;right: 0rem;left: 0rem;bottom: 0rem;display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;-webkit-align-items: center;-webkit-box-align: center;-ms-flex-align: center;align-items: center;-webkit-box-pack: center;-ms-flex-pack: center;-webkit-justify-content: center;justify-content: center;overflow: hidden;border-radius: 0.25rem;z-index: 1000;}
</style>
@endsection

@section('script')
<script>
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
                $("#department").val($("#department_id option:selected" ).text());
                $("#section").val('');
            }
        });
});

$(document).on('change', '#section_id', function() {
    $("#section").val($("#section_id option:selected" ).text());
});
</script>
@endsection

@extends('backend.layout.master')
@section('backend-head')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/forms/select/select2.min.css">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/core/colors/palette-gradient.css">
    <!-- END: Page CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/custom-rtl.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/style-rtl.css">
    <style>
        .note-btn-group i{
            color: white;
        }
    </style>
    <!-- END: Custom CSS-->
@endsection    
@section('backend-main')
    <section class="tooltip-validations" id="tooltip-validation">
        <div class="row">
            <div class="col-12">
                @include('common.done')
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">اضافة مجموعة صلاحيات</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{ route('roles.store') }}" id="myform">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-12 col-12 mb-3">
                                        <label class="mb-1" for="name">اسم المجموعة ( احرف انجليزية بدون مسافات )</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="اسم المجموعة ( احرف انجليزية بدون مسافات )" value="{{ old('name') }}" required>
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label>صلاحيات المجموعة</label>
                                        <div class="form-group" data-select2-id="126">
                                            <select style="width: 100%" name="permission[]" class="select2 form-control select2-hidden-accessible" multiple="" data-select2-id="7" tabindex="-1" aria-hidden="true">

                                                @foreach($permissions  as $permission)
                                                    <option value="{{ $permission->id }}" >{{ $permission->name_ar }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <button class="btn btn-primary" type="submit">اضافة</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('backend-footer')
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('backend') }}/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('backend') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('backend') }}/app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('backend') }}/app-assets/js/core/app.js"></script>
    <script src="{{ asset('backend') }}/app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('backend') }}/app-assets/js/scripts/forms/form-tooltip-valid.js"></script>
    <script src="{{ asset('backend') }}/app-assets/js/scripts/forms/select/form-select2.js"></script>
    <!-- END: Page JS-->
    <script src="{{ asset('backend') }}/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    {{--<script>--}}
        {{--$(document).ready(function() {--}}
            {{--// validate signup form on keyup and submit--}}
            {{--$("#myform").validate({--}}
                {{--rules: {--}}
                    {{--title: {--}}
                        {{--required: true,--}}
                        {{--minlength: 3,--}}
                        {{--maxlength: 100,--}}
                    {{--},--}}
                    {{--body: {--}}
                        {{--required: true,--}}
                        {{--minlength: 3,--}}
                        {{--maxlength: 5000,--}}
                    {{--},--}}
                    {{--order: {--}}
                        {{--required: true,--}}
                    {{--},--}}
                {{--},--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
    {{--<script>--}}
        {{--$(document).ready(function() {--}}
            {{--$('.summernote').summernote({--}}
                {{--tabsize: 2,--}}
                {{--height: 200--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@endsection    

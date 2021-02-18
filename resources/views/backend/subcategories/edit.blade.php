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
                        <h4 class="card-title">تعديل التصنيف {{ $category->title }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{ route('subcategories.update' , $category->id) }}" enctype="multipart/form-data" id="myform">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="form-row">
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="title">العنوان الرئيسي</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="العنوان الرئيسي" value="{{ $category->title }}" required>
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="subtitle">الاسم بالانجليزية</label>
                                        <input  id="subtitle" type="text" name="subtitle" class="form-control" placeholder="العنوان الفرعي" value="{{ $category->subtitle }}" required>
                                        @error('subtitle')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="body">نبذة</label>
                                        <textarea rows="10" name="body" class="form-control" placeholder="نبذة" required>{{ $category->body }}</textarea>
                                        @error('body')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="text-bold-600 font-medium-2">
                                            التصنيف الاب
                                        </div>
                                        <div class="form-group">
                                            <select name="parent_id" class="select2 form-control">
                                                @foreach($parents as $parent)
                                                    <option
                                                            @if($parent->id == $category->parent_id) selected @endif
                                                            value="{{ $parent->id }}">{{ $parent->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('parent_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <li class="d-inline-block mr-5">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input name="active" type="checkbox" checked value="1">
                                                    <span class="vs-checkbox vs-checkbox-lg">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                    <span class="">فعال</span>
                                                </div>
                                            </fieldset>
                                        </li>
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
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function() {
            // validate signup form on keyup and submit
            $("#myform").validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 3,
                        maxlength: 100,
                    },
                    subtitle: {
                        required: true,
                        minlength: 3,
                        maxlength: 100,
                    },
                    body: {
                        required: true,
                        minlength: 20,
                        maxlength: 2000,
                    },
                    parent_id: {
                        required: true,
                    },
                    image: {
                        required: true,
                    },
                },
                messages:{
                    title: {
                        required : 'هذا الحقل مطلوب',
                        minlength : 'هذا الحقل مطلوب اقل من المسموح',
                    },
                    subtitle: {
                        required : 'هذا الحقل مطلوب',
                        minlength : 'هذا الحقل مطلوب اقل من المسموح',
                    },
                    body: {
                        required : 'هذا الحقل مطلوب',
                        minlength : 'هذا الحقل مطلوب اقل من المسموح',
                        maxlength: 'عدد اكثر من اللازم',
                    },
                    parent_id: {
                        required : 'هذا الحقل مطلوب',
                    },
                }
            });
        });
    </script>
@endsection

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
    <link rel="stylesheet" href="{{ asset('backend') }}/ckeditor/styles.css">
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
                        <h4 class="card-title">اضافة صفحة جديدة</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{ route('videos.store') }}" enctype="multipart/form-data" id="myform">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="title">العنوان</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="الاسم بالعربية" value="{{ old('title') }}" required>
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="body">شرح للفيديو</label>
                                        <textarea rows="10" name="body" class="form-control" placeholder="شرح للفيديو" required>{{ old('body') }}</textarea>
                                        @error('body')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="text-bold-600 font-medium-2">
                                            التصنيف
                                        </div>
                                        <div class="form-group">
                                            <select name="category_id" class="select2 form-control">
                                                <option disabled selected hidden>اختر التصنيف </option>
                                                @foreach($categories as $parent)
                                                    <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('parent_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-image">
                                        <fieldset class="form-group">
                                            <label for="basicInputFile">الصورة الخاصة بالفيديو</label>
                                            <div class="custom-file">
                                                <input name="image" type="file" class="custom-file-input" id="image" onchange="readURL(this);" />
                                                <label class="custom-file-label" for="image">اضغط لاختيار الصورة</label>
                                            </div>
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </fieldset>
                                        <div class="text-center">
                                            <img id="blah" class="blah_create" src=""/>
                                        </div>
                                        <br>
                                    </div>
                                    <hr>
                                    <div class="col-md-12 col-12 mb-3">
                                        <input type="radio" id="linkRadio" name="kind" value="0">
                                        <label for="linkRadio">رابط</label><br>
                                        <input type="radio" id="fileRadio" name="kind" value="1">
                                        <label for="fileRadio">ملف</label><br>
                                        @error('kind')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3 link">
                                        <label for="link">الرابط</label>
                                        <input type="text" name="link" class="form-control" id="link" placeholder="رابط اليوتيوب" value="{{ old('link')}}">
                                        @error('link')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3 file">
                                        <label for="link">الفيديو بصيغة ( 3gp , MP4 , flv )
                                            max 10 MB
                                        </label>
                                        <input type="file" name="file" class="form-control" id="file-input">
                                        <div class="col-md-12 text-center">
                                            <video id="video" width="300" height="300" controls></video>
                                        </div>
                                        @error('file')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <hr>
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
            $('input:radio[name="kind"]').change(
                function(){
                    if ($(this).is(':checked') && $(this).val() == 1) {
                        $("#myform").validate({
                            rules: {
                                title: {
                                    required: true,
                                    minlength: 3,
                                    maxlength: 100,
                                },
                                body: {
                                    required: true,
                                },
                                file: {
                                    required: true,
                                },
                                kind: {
                                    required: true,
                                },
                            },
                            messages:{
                                title: {
                                    required : 'هذا الحقل مطلوب',
                                    minlength : 'هذا الحقل مطلوب اقل من المسموح',
                                },
                                title: {
                                    required : 'هذا الحقل مطلوب',
                                },
                                file: {
                                    required : 'هذا الحقل مطلوب',
                                },
                                kind: {
                                    required : 'هذا الحقل مطلوب',
                                },
                            }
                        });
                    }else if ($(this).is(':checked') && $(this).val() == 0){
                        $("#myform").validate({
                            rules: {
                                title: {
                                    required: true,
                                    minlength: 3,
                                    maxlength: 100,
                                },
                                body: {
                                    required: true,
                                },
                                link: {
                                    required: true,
                                },
                                kind: {
                                    required: true,
                                },
                            },
                            messages:{
                                title: {
                                    required : 'هذا الحقل مطلوب',
                                    minlength : 'هذا الحقل مطلوب اقل من المسموح',
                                },
                                title: {
                                    required : 'هذا الحقل مطلوب',
                                },
                                link: {
                                    required : 'هذا الحقل مطلوب',
                                },
                                kind: {
                                    required : 'هذا الحقل مطلوب',
                                },
                            }
                        });
                    }else{
                        $("#myform").validate({
                            rules: {
                                title: {
                                    required: true,
                                    minlength: 3,
                                    maxlength: 100,
                                },
                                body: {
                                    required: true,
                                },
                                kind: {
                                    required: true,
                                },
                                category_id: {
                                    required: true,
                                },
                            },
                            messages:{
                                title: {
                                    required : 'هذا الحقل مطلوب',
                                    minlength : 'هذا الحقل مطلوب اقل من المسموح',
                                },
                                title: {
                                    required : 'هذا الحقل مطلوب',
                                },
                                kind: {
                                    required : 'هذا الحقل مطلوب',
                                },
                                category_id: {
                                    required : 'هذا الحقل مطلوب',
                                },
                            }
                        });
                    }
                });
        });
    </script>
    <script>
        $('input:radio[name="kind"]').change(
            function(){
                if ($(this).is(':checked') && $(this).val() == 1) {
                    $('.file').show();
                    $('.link').hide();
                    $('input[name="file"]').val("");
                    $('input[name="link"]').val("");
                }else if ($(this).is(':checked') && $(this).val() == 0){
                    $('.file').hide();
                    $('.link').show();
                    $('input[name="file"]').val("");
                    $('input[name="link"]').val("");
                }
            });
    </script>
@endsection

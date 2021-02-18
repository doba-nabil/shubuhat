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
                        <h4 class="card-title">معلومات الموقع</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{ route('options.update' , 1) }}" enctype="multipart/form-data" id="myform">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="form-row">
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="title">عنوان الموقع</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="الاسم" value="{{ $option->title }}" required>
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="phone">رقم الهاتف </label>
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="رقم الهاتف" value="{{ $option->phone }}" required>
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="whatsapp">رقم الواتس اب </label>
                                        <input type="text" name="whatsapp" class="form-control" id="whatsapp" placeholder="رقم الواتس اب" value="{{ $option->whatsapp }}" required>
                                        @error('whatsapp')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="email">البريد الالكتروني</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="البريد الالكتروني" value="{{ $option->email }}" required>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="footer_text">نص عن الموقع في اسفل الموقع</label>
                                        <input type="text" name="footer_text" class="form-control" id="footer_text" placeholder="نص عن الموقع في اسفل الموقع" value="{{ $option->footer_text }}" required>
                                        @error('footer_text')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="facebook">رابط صفحة الفيس بوك</label>
                                        <input type="text" name="facebook" class="form-control" id="facebook" placeholder="رابط صفحة الفيس بوك" value="{{ $option->facebook }}">
                                        @error('facebook')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="insta">رابط صفحة الانستجرام</label>
                                        <input type="text" name="insta" class="form-control" id="insta" placeholder="رابط صفحة الانستجرام" value="{{ $option->insta }}">
                                        @error('insta')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="youtube">رابط قناة اليوتيوب</label>
                                        <input type="text" name="youtube" class="form-control" id="youtube" placeholder="رابط قناة اليوتيوب" value="{{ $option->youtube }}">
                                        @error('youtube')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="twitter">رابط تويتر</label>
                                        <input type="text" name="twitter" class="form-control" id="twitter" placeholder="رابط تويتر" value="{{ $option->twitter }}">
                                        @error('twitter')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="clearfix"></div>
                                        <hr>
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="start_at">وقت البداية للاسئلة</label>
                                        <input type="time" name="start_at" class="form-control" id="start_at" placeholder="وقت البداية للاسئلة" value="{{ $option->start_at }}">
                                        @error('start_at')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="end_at">وقت النهاية للاسئلة</label>
                                        <input type="time" name="end_at" class="form-control" id="end_at" placeholder="وقت النهاية للاسئلة" value="{{ $option->end_at }}">
                                        @error('end_at')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="clearfix"></div>
                                        <hr>
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="banner_title">عنوان بانر الصفحة الرئيسية</label>
                                        <input type="text" name="banner_title" class="form-control" id="banner_title" placeholder="عنوان بانر الصفحة الرئيسية" value="{{ $option->banner_title }}">
                                        @error('banner_title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="banner_title">رابط بانر الصفحة الرئيسية</label>
                                        <input type="text" name="banner_link" class="form-control" id="banner_link" placeholder="رابط بانر الصفحة الرئيسية" value="{{ $option->banner_link }}">
                                        @error('banner_link')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-image">
                                        <fieldset class="form-group">
                                            <label for="basicInputFile">صورة بانر البانر الاعلاني في منتصف الصفحة الرئيسية </label>
                                            <div class="custom-file">
                                                <input name="image" type="file" class="custom-file-input" id="image" onchange="readURL(this);" />
                                                <label class="custom-file-label" for="image">اضغط لاختيار الصورة</label>
                                            </div>
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </fieldset>
                                        @if(isset($option->banner_image))
                                            <div class="text-center">
                                                <img style="width: 100%" id="blah" src="{{ asset('pictures/options/' . $option->banner_image->image) }}" alt="{{ $option->title }}" />
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <img style="width: 100%" id="blah" class="blah_create" src="" alt="" />
                                            </div>
                                        @endif

                                    </div>
                                    <div class="col-md-12">
                                        <div class="clearfix"></div>
                                        <hr>
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="banner_title">رابط بانر اعلاني الملفات المتنوعة في الصفحة الرئيسية</label>
                                        <input type="text" name="folders_link" class="form-control" id="folders_link" placeholder="رابط بانر الملفات المتنوعة" value="{{ $option->folders_link }}">
                                        @error('folders_link')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-image">
                                        <fieldset class="form-group">
                                            <label for="basicInputFile">صورة بانر اعلاني الملفات المتنوعة في الصفحة الرئيسية </label>
                                            <div class="custom-file">
                                                <input name="folder_ad" type="file" class="custom-file-input" id="folder_ad" onchange="readURL2(this);" />
                                                <label class="custom-file-label" for="folder_ad">اضغط لاختيار الصورة</label>
                                            </div>
                                            @error('folder_ad')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </fieldset>
                                        @if(isset($option->folder_ad))
                                            <div class="text-center">
                                                <img style="width: 200px;height: 200px" id="blah2" src="{{ asset('pictures/options/' . $option->folder_ad->image) }}" alt="{{ $option->title }}" />
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <img style="width: 200px;height: 200px" id="blah2" class="blah_create" src="" alt="" />
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="clearfix"></div>
                                        <br>
                                        <hr>
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="terms">نص الخصوصية في صفحة ارسال السؤال</label>
                                        <input type="text" name="terms" class="form-control" id="terms" placeholder="نص الخصوصية في صفحة ارسال السؤال" value="{{ $option->terms }}">
                                        @error('terms')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                    phone: {
                        required: true,
                    },
                    whatsapp: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    footer_text: {
                        required: true,
                    },
                    banner_title: {
                        required: true,
                    },
                    banner_link: {
                        required: true,
                    },
                    start_at: {
                        required: true,
                    },
                    end_at: {
                        required: true,
                    },
                },
                messages:{
                    title: {
                        required : 'هذا الحقل مطلوب',
                        minlength : 'هذا الحقل مطلوب اقل من المسموح',
                    },
                    phone: {
                        required : 'هذا الحقل مطلوب',
                    },
                    whatsapp: {
                        required : 'هذا الحقل مطلوب',
                    },
                    email: {
                        required : 'هذا الحقل مطلوب',
                        email: 'يجب ان يكون بريد الكتروني',
                    },
                    footer_text: {
                        required : 'هذا الحقل مطلوب',
                    },
                    banner_title: {
                        required : 'هذا الحقل مطلوب',
                    },
                    banner_link: {
                        required : 'هذا الحقل مطلوب',
                    },
                    start_at: {
                        required : 'هذا الحقل مطلوب',
                    },
                    end_at: {
                        required : 'هذا الحقل مطلوب',
                    },
                }
            });
        });
    </script>
@endsection


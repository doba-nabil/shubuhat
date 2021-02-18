@extends('backend.layout.master')
@section('backend-head')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend') }}/app-assets/vendors/css/forms/select/select2.min.css">
    <link href="{{ asset('backend') }}/summernote.min.css" rel="stylesheet">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend') }}/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend') }}/app-assets/css-rtl/core/colors/palette-gradient.css">
    <!-- END: Page CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/custom-rtl.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/style-rtl.css">
    <style>
        .note-btn-group i {
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
                        <h4 class="card-title">اضافة فنان جديد</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{ route('artists.store') }}" enctype="multipart/form-data"
                                  id="myform">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="name_ar">الاسم بالعربية</label>
                                        <input type="text" name="name_ar" class="form-control" id="name_ar"
                                               placeholder="الاسم بالعربية" value="{{ old('name_ar') }}" required>
                                        @error('name_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="name_en">الاسم بالانجليزية</label>
                                        <input type="text" name="name_en" id="name_en" class="form-control"
                                               placeholder="الاسم بالانجليزية" value="{{ old('name_en') }}" required>
                                        @error('name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="details_ar">الشرح بالعربية</label>
                                        <textarea id="details_ar" class="form-control summernote" name="details_ar"
                                                  required>{{ old('details_ar') }}</textarea>
                                        @error('details_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="details_en">الشرح بالانجليزية</label>
                                        <textarea id="details_en" class="form-control summernote" name="details_en"
                                                  required>{{ old('details_en') }}</textarea>
                                        @error('details_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="phone">الهاتف</label>
                                        <input type="phone" name="phone" class="form-control" id="phone"
                                               placeholder="الهاتف" value="{{ old('phone') }}" required>
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="email">البريد الالكتروني</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                               placeholder="البريد الالكتروني" value="{{ old('email') }}" required>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="social">ايميل التواصل الاجتماعي</label>
                                        <input type="url" name="social" class="form-control" id="social"
                                               placeholder="ايميل التواصل" value="{{ old('social') }}" required>
                                        @error('social')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="website">الموقع الالكتروني للفنان</label>
                                        <input type="url" name="website" class="form-control" id="website"
                                               placeholder="الموقع الالكتروني للفنان" value="{{ old('website') }}"
                                               required>
                                        @error('website')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="text-bold-600 font-medium-2">
                                            التصنيف الرئيسي
                                        </div>
                                        <div class="form-group">
                                            <select name="category_id" class="select2 form-control" id="category_id">
                                                <option disabled selected hidden>اختر التصنيف الرئيسي</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title_ar }}
                                                        / {{ $category->title_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="text-bold-600 font-medium-2">
                                            التصنيف الفرعي
                                        </div>
                                        <div class="form-group">
                                            <select name="subcategory_id" id="subcategory_id"
                                                    class="select2 form-control">
                                                <option disabled selected hidden>اختر التصنيف الرئيسي اولا</option>
                                            </select>
                                        </div>
                                        @error('subcategory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="text-bold-600 font-medium-2">
                                            الدولة
                                        </div>
                                        <div class="form-group">
                                            <select id="country_id" name="country_id" id=""
                                                    class="select2 form-control">
                                                <option disabled selected hidden>اختر الدولة</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name_ar }}
                                                        / {{ $country->name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('country_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="text-bold-600 font-medium-2">
                                            المدينة
                                        </div>
                                        <div class="form-group">
                                            <select id="city_id" name="city_id" class="select2 form-control">
                                                <option disabled selected hidden>اختر الدولة اولا</option>
                                            </select>
                                        </div>
                                        @error('subcategory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="text-bold-600 font-medium-2">
                                            النوع
                                        </div>
                                        <div class="form-group">
                                            <select name="gender" id="" class="select2 form-control">
                                                <option disabled selected hidden>اختر النوع</option>
                                                <option value="male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-image">
                                        <fieldset class="form-group">
                                            <label for="basicInputFile">الصورة الرئيسية للفنان</label>
                                            <div class="custom-file">
                                                <input name="image" type="file" class="custom-file-input" id="image"
                                                       onchange="readURL(this);"/>
                                                <label class="custom-file-label" for="image">اضغط لاختيار الصورة</label>
                                            </div>
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </fieldset>
                                        <div class="text-center">
                                            <img id="blah" class="blah_create"
                                                 src="{{ asset('backend') }}/app-assets/images/pages/empty.jpg"
                                                 alt="your image"/>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <fieldset class="form-group">
                                            <label for="basicInputFile"> اضافة فيديو للفنان</label>
                                            <div class="custom-file">
                                                <input id="file-input" name="video" type="file"
                                                       class="custom-file-input" type="file" accept="video/*">
                                                <label class="custom-file-label" for="file-input">اضغط لاختار
                                                    الفيديو</label>
                                            </div>
                                            @error('video')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </fieldset>
                                        <div class="text-center">
                                            <video id="video" class="video_create" width="200" height="200"
                                                   controls></video>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="basicInputFile"> الصور الفرعية للفنان ( اختيار متعدد )</label>
                                            <div class="multi-images">
                                                    <span class="btn fileinput-button">
                                                        <span>اختيار الصور</span>
                                                        <input type="file" name="images[]" id="files" multiple
                                                               accept="image/jpeg, image/png, image/gif,"><br/>
                                                    </span>
                                                <br>
                                                <br>
                                                <output id="Filelist"></output>
                                            </div>
                                            @error('images')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if(count($types))
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="basicInputFile"> نوع الفعاليات</label>
                                            <ul class="list-unstyled mb-0">
                                                @foreach($types as $type)
                                                    <li class="d-inline-block mr-2">
                                                        <fieldset>
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input name="types[]" type="checkbox"
                                                                       value="{{ $type->id }}">
                                                                <span class="vs-checkbox vs-checkbox-sm">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                                <span class="">{{ $type->name_ar }}</span>
                                                            </div>
                                                        </fieldset>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                    </div>

                                    @endif
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
                                    <div class="col-sm-12 col-md-12">
                                        <li class="d-inline-block mr-5">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input name="chosen" type="checkbox" checked value="1">
                                                    <span class="vs-checkbox vs-checkbox-lg">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                    <span class="">فنان مختار</span>
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
    <script src="{{ asset('backend') }}/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function () {
            // validate signup form on keyup and submit
            $("#myform").validate({
                rules: {
                    name_ar: {
                        required: true,
                        minlength: 3,
                        maxlength: 100,
                    },
                    name_en: {
                        required: true,
                        minlength: 3,
                        maxlength: 100,
                    },
                    details_ar: {
                        required: true,
                        minlength: 20,
                        maxlength: 2000,
                    },
                    details_en: {
                        required: true,
                        minlength: 20,
                        maxlength: 2000,
                    },
                    category_id: {
                        required: true,
                    },
                    subcategory_id: {
                        required: true,
                    },
                    city_id: {
                        required: true,
                    },
                    country_id: {
                        required: true,
                    },
                    phone: {
                        required: true,
                        phonenu: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    social: {
                        required: true,
                    },
                    website: {
                        required: true,
                        url: true,
                    },
                    image: {
                        required: true,
                    },
                    video: {
                        required: true,
                    },
                    gender: {
                        required: true,
                    },
                },
                messages: {
                    name_ar: {
                        required: 'هذا الحقل مطلوب',
                        minlength: 'هذا الحقل مطلوب اقل من المسموح',
                    },
                    name_en: {
                        required: 'هذا الحقل مطلوب',
                        minlength: 'هذا الحقل مطلوب اقل من المسموح',
                    },
                    details_ar: {
                        required: 'هذا الحقل مطلوب',
                        minlength: 'هذا الحقل مطلوب اقل من المسموح',
                        maxlength: 'هذا الحقل مطلوب اكبر من المسموح',
                    },
                    details_en: {
                        required: 'هذا الحقل مطلوب',
                        minlength: 'هذا الحقل مطلوب اقل من المسموح',
                        maxlength: 'هذا الحقل مطلوب اكبر من المسموح',
                    },
                    gender: {
                        required: 'هذا الحقل مطلوب',
                    },
                    category_id: {
                        required: 'هذا الحقل مطلوب',
                    },
                    subcategory_id: {
                        required: 'هذا الحقل مطلوب',
                    },
                    city_id: {
                        required: 'هذا الحقل مطلوب',
                    },
                    country_id: {
                        required: 'هذا الحقل مطلوب',
                    },
                    phone: {
                        required: 'هذا الحقل مطلوب',
                        phonenu: 'رقم هاتف خاطئ',
                    },
                    email: {
                        required: 'هذا الحقل مطلوب',
                        email: 'يجب ان يكون بريد',
                    },
                    social: {
                        required: 'هذا الحقل مطلوب',
                        url: 'رابط خاطئ',
                    },
                    website: {
                        required: 'هذا الحقل مطلوب',
                        url: 'رابط خاطئ',
                    },
                    image: {
                        required: 'هذا الحقل مطلوب',
                    },
                    video: {
                        required: 'هذا الحقل مطلوب',
                    },
                }
            });
        });
    </script>
@endsection    

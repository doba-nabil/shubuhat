@extends('backend.layout.master')
@section('backend-head')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend') }}/app-assets/vendors/css/forms/select/select2.min.css">
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
                        <h4 class="card-title">تعديل المقال {{ $book->title }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{ route('books.update' , $book->id) }}"
                                  enctype="multipart/form-data" id="myform">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="form-row">
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="title">العنوان</label>
                                        <input type="text" name="title" class="form-control" id="title"
                                               placeholder="الاسم بالعربية" value="{{ $book->title }}" required>
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="body">نبذة</label>
                                        <textarea rows="10" name="body" class="form-control"
                                                  placeholder="نبذة" required>{{ $book->body }}</textarea>
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
                                                @foreach($categories as $parent)
                                                    <option
                                                            @if($book->category_id == $parent->id) selected @endif
                                                    value="{{ $parent->id }}">{{ $parent->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-image">
                                        <fieldset class="form-group">
                                            <label for="basicInputFile">الصورة</label>
                                            <div class="custom-file">
                                                <input name="image" type="file" class="custom-file-input" id="image" onchange="readURL(this);" />
                                                <label class="custom-file-label" for="image">اضغط لاختيار الصورة</label>
                                            </div>
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </fieldset>
                                        <div class="text-center">
                                            @if(isset($book->mainImage->image))
                                            <div class="image_class" style="width:200px;display:inline-block">
                                                <img id="blah" src="{{ asset('pictures/media/' . $book->mainImage->image) }}" alt="{{ $book->title }}" />
                                                <a  style="width: 200px;border-radius: 0;text-align: center" title="" onclick="return false;" object_id="{{ $book->mainImage->id }}"
                                                    delete_url="/delete_book_image/" class="btn btn-danger edit-btn-table delete_event_image" href="#">
                                                    حذف
                                                </a>
                                            </div>
                                            <img id="blah" class="blah_create" src="{{ asset('frontend/img/empty.png') }}" alt="{{ $book->title }}" />
                                            @else
                                                <img id="blah" src="{{ asset('frontend/img/empty.png') }}" alt="{{ $book->title }}" />
                                            @endif
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <fieldset class="form-group">
                                            <label for="basicInputFile">الكتاب بصيغة pdf , doc</label>
                                            <div class="custom-file">
                                                <input name="file" type="file" class="custom-file-input"/>
                                                <label class="custom-file-label" for="image">اضغط لاختيار الملف</label>
                                            </div>
                                            @error('file')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </fieldset>
                                        <div class="text-center">
                                            <a title="تصفح الكتاب" target="_blank" href="{{ asset('pictures/books/' . $book->file->file) }}">
                                                <i class="fa fa-book fa-3x"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <li class="d-inline-block mr-5">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input
                                                            @if($book->active == 1) checked @endif
                                                    name="active" type="checkbox" value="1">
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
        $(document).ready(function () {
            $("#myform").validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 3,
                        maxlength: 100,
                    },
                    category_id: {
                        required: true,
                    },
                },
                messages: {
                    title: {
                        required: 'هذا الحقل مطلوب',
                        minlength: 'هذا الحقل مطلوب اقل من المسموح',
                    },
                    category_id: {
                        required: 'هذا الحقل مطلوب',
                    },
                }
            });
        });
    </script>
@endsection


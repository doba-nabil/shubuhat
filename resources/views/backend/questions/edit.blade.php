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
                @include('common.errors')
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">تعديل السؤال {{ $question->mini_question }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{ route('questions.update' , $question->id) }}" id="myform">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="form-row">
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="question">نص السؤال كاملا</label>
                                        <textarea rows="10" name="question" class="form-control" id="question" placeholder="نص السؤال كاملا" required>{{ $question->question }}</textarea>
                                        @error('question')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="mini_question">السؤال بإختصار</label>
                                        <input type="text" name="mini_question" class="form-control" id="mini_question" placeholder="السؤال بإختصار" value="{{ $question->mini_question }}" required>
                                        @error('mini_question')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="text-bold-600 font-medium-2">
                                            التصنيفات ( عدد الـ " - " تدل على ترتيب التنصيف )
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <select name="category_ids[]" class="select2-customize-result form-control" multiple="multiple" id="select2-customize-result">
                                                @foreach($categories as $parent)
                                                    <option
                                                            @foreach($cat_questions as $cat_q)
                                                                    @if($cat_q->category_id == $parent->id)
                                                                    selected
                                                                    @endif
                                                            @endforeach
                                                            value="{{ $parent->id }}">{{ $parent->title }} -</option>
                                                @endforeach
                                                @foreach($categories as $parent)
                                                    @foreach($parent->subCategories as $parent)
                                                        <option
                                                                @foreach($cat_questions as $cat_q)
                                                                @if($cat_q->category_id == $parent->id)
                                                                selected
                                                                @endif
                                                                @endforeach
                                                                value="{{ $parent->id }}">{{ $parent->title }} --</option>
                                                    @endforeach
                                                @endforeach
                                                @foreach($categories as $parent)
                                                    @foreach($parent->subCategories as $parent)
                                                        @foreach($parent->subCategories as $parent)
                                                            <option
                                                                    @foreach($cat_questions as $cat_q)
                                                                    @if($cat_q->category_id == $parent->id)
                                                                    selected
                                                                    @endif
                                                                    @endforeach
                                                                    value="{{ $parent->id }}">{{ $parent->title }} ---</option>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                                @foreach($categories as $parent)
                                                    @foreach($parent->subCategories as $parent)
                                                        @foreach($parent->subCategories as $parent)
                                                            @foreach($parent->subCategories as $parent)
                                                                <option
                                                                        @foreach($cat_questions as $cat_q)
                                                                        @if($cat_q->category_id == $parent->id)
                                                                        selected
                                                                        @endif
                                                                        @endforeach
                                                                        value="{{ $parent->id }}">{{ $parent->title }} ----</option>
                                                            @endforeach
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                                @foreach($categories as $parent)
                                                    @foreach($parent->subCategories as $parent)
                                                        @foreach($parent->subCategories as $parent)
                                                            @foreach($parent->subCategories as $parent)
                                                                @foreach($parent->subCategories as $parent)
                                                                    <option
                                                                            @foreach($cat_questions as $cat_q)
                                                                            @if($cat_q->category_id == $parent->id)
                                                                            selected
                                                                            @endif
                                                                            @endforeach
                                                                            value="{{ $parent->id }}">{{ $parent->title }} -----</option>
                                                                @endforeach
                                                            @endforeach
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                                @foreach($categories as $parent)
                                                    @foreach($parent->subCategories as $parent)
                                                        @foreach($parent->subCategories as $parent)
                                                            @foreach($parent->subCategories as $parent)
                                                                @foreach($parent->subCategories as $parent)
                                                                    @foreach($parent->subCategories as $parent)
                                                                        <option
                                                                                @foreach($cat_questions as $cat_q)
                                                                                @if($cat_q->category_id == $parent->id)
                                                                                selected
                                                                                @endif
                                                                                @endforeach
                                                                                value="{{ $parent->id }}">{{ $parent->title }} ------</option>
                                                                    @endforeach
                                                                @endforeach
                                                            @endforeach
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category_ids')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <li class="d-inline-block mr-5">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input  @if($question->active == 1)
                                                            checked
                                                            @endif
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
                                <button class="btn btn-primary" type="submit">حفظ</button>
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
            $("#myform").validate({
                rules: {
                    question: {
                        required: true,
                    },
                    mini_question: {
                        required: true,
                    },
                    category_ids: {
                        required: true,
                    },
                },
                messages:{
                    question: {
                        required : 'هذا الحقل مطلوب',
                    },
                    mini_question: {
                        required : 'هذا الحقل مطلوب',
                    },
                    category_ids: {
                        required : 'هذا الحقل مطلوب',
                    },
                }
            });
        });
    </script>
@endsection


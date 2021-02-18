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
                        <h4 class="card-title">اضافة معروضات في الملف المسمى بـ( {{ $folder->title }} )</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{ route('folderfiles_form' , $folder->id) }}" id="myform">
                                @csrf
                                <div class="col-sm-12 col-12">
                                    <div class="text-bold-600 font-medium-2">
                                        الفديوهات
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <select name="video_ids[]" class="select2-customize-result form-control" multiple="multiple" id="select2-customize-result">
                                            @foreach($videos as $video)
                                                <option value="{{ $video->id }}">{{ $video->title }} -</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('video_ids')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="text-bold-600 font-medium-2">
                                        الصوتيات
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <select name="audio_ids[]" class="select2-customize-result form-control" multiple="multiple" id="select2-customize-resultt">
                                            @foreach($audios as $audio)
                                                <option value="{{ $audio->id }}">{{ $audio->title }} -</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('audio_ids')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="text-bold-600 font-medium-2">
                                        الكتب
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <select name="book_ids[]" class="select2-customize-result form-control" multiple="multiple" id="select2-customize-resulttt">
                                            @foreach($books as $book)
                                                <option value="{{ $book->id }}">{{ $book->title }} -</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('book_ids')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="text-bold-600 font-medium-2">
                                        المقالات
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <select name="article_ids[]" class="select2-customize-result form-control" multiple="multiple" id="select2-customize-resultttt">
                                            @foreach($articles as $article)
                                                <option value="{{ $article->id }}">{{ $article->title }} -</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('article_ids')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="text-bold-600 font-medium-2">
                                        الشبهات
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <select name="question_ids[]" class="select2-customize-result form-control" multiple="multiple" id="select2-customize-resulttttt">
                                            @foreach($questions as $question)
                                                <option value="{{ $question->id }}">{{ $question->mini_question }} -</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('question_ids')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <hr>
                                <button class="btn btn-primary" type="submit">اضافة</button>
                                <div class="clearfix"></div>
                                <br>
                                <a style="width: 100%" href="{{ route('folders.show' , $folder->slug) }}" class="btn btn-warning" type="submit">رجوع</a>
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
@endsection    

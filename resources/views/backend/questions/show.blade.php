@extends('backend.layout.master')
@section('backend-head')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend') }}/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend') }}/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <!-- END: Vendor CSS-->
    <link href="{{ asset('backend') }}/summernote.min.css" rel="stylesheet">
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
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend') }}/app-assets/css-rtl/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/pages/data-list-view.css">
    <!-- END: Page CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/custom-rtl.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/style-rtl.css">
    <!-- END: Custom CSS-->
@endsection
@section('backend-main')
    <!-- BEGIN: Content-->
    <div class="content-body">
        <div class="col-md-12">
            <button style="width: 100%" class="btn btn-danger mb-2"  data-toggle="modal" data-target="#send_question">
                ارسال السؤال لأحد المشرفين للاجابة
            </button>
        </div>
        <!-- start -send question modal -->
        <div class="modal fade" id="send_question" tabindex="-1" role="dialog" aria-labelledby="send_question_title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="send_question_title">اختر المشرف المراد ارسال الية الشبهة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('send_question_moderator') }}">
                            @csrf
                            <div class="form-row">
                                <input name="question_id" value="{{ $question->id }}" hidden>
                                <div class="col-md-12 col-12 mb-3">
                                    <label for="mini_question">اختر المشرف</label>
                                    <select name="moderator_id" class="form-control">
                                        @foreach($moderators as $moderator)
                                            <option value="{{ $moderator->id }}">
                                                {{ $moderator->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                <button type="submit" class="btn btn-primary">ارســـــــال</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- start modal edit mini question --}}
        <div class="modal fade" id="mini_question" tabindex="-1" role="dialog" aria-labelledby="mini_question_title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">تعديل اختصار السؤال</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <strong>السؤال : </strong>
                        <span>{{ $question->question }}</span>
                        <hr>
                        <form method="post" action="{{ route('mini_question') }}">
                            @csrf
                            <div class="form-row">
                                <input name="question_id" value="{{ $question->id }}" hidden>
                                <div class="col-md-12 col-12 mb-3">
                                    <label for="mini_question">اختصار السؤال</label>
                                    <textarea rows="5" name="mini_question" class="form-control" placeholder="اختصار السؤال"
                                              required>{{ $question->mini_question ?? ''}}</textarea>
                                    @error('mini_question')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                <button type="submit" class="btn btn-primary">حفظ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal edit mini question --}}
        {{-- start modal edit mini answer --}}
        <div style="overflow-y:scroll" class="modal fade" id="mini_answer" tabindex="-1" role="dialog" aria-labelledby="mini_answer_title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"> اجابة السؤال بشكل مختصر والمصادر</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <strong>السؤال : </strong>
                        <span>{{ $question->question }}</span>
                        <hr>
                        <form method="post" action="{{ route('mini_answer') }}"  enctype="multipart/form-data" >
                            @csrf
                            <div class="form-row">
                                <input name="question_id" value="{{ $question->id }}" hidden>
                                <div class="col-md-12 col-12 mb-3">
                                    <label for="mini_question">الاجابة بإختصار ( اختياري )</label>
                                    <textarea rows="5" name="mini_answer" class="form-control" placeholder="الاجابة بشكل مختصر">{{ $question->mini_answer ?? ''}}</textarea>
                                    @error('mini_answer')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 col-12 mb-3">
                                    <label for="sources">المصادر</label>
                                    <textarea rows="5" name="sources" class="form-control summernote" placeholder="المصادر">{{ $question->sources ?? ''}}</textarea>
                                    @error('sources')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <hr>
                                <div class="col-md-12 col-12 mb-3">
                                    <input @if($question->kind == 0) checked @endif type="radio" id="linkRadio" name="kind" value="0">
                                    <label for="linkRadio">رابط</label><br>
                                    <input @if($question->kind == 1) checked @endif type="radio" id="fileRadio" name="kind" value="1">
                                    <label for="fileRadio">ملف</label><br>
                                    @error('kind')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 col-12 mb-3 link">
                                    <label for="link">الرابط</label>
                                    <input type="text" name="link" class="form-control" id="link" placeholder="رابط اليوتيوب" value="{{ $question->link }}">
                                    <div class="col-md-12 text-center">
                                        @if(isset($question->file->link))
                                            <?php
                                            $string     =  $question->file->link ;
                                            $search     = '/youtube\.com\/watch\?v=([a-zA-Z0-9]+)/smi';
                                            $replace    = "youtube.com/embed/$1";
                                            $url = preg_replace($search,$replace,$string);
                                            ?>
                                            <iframe width="420" height="315" src='{{ $url }}?modestbranding=1' allowfullscreen>
                                            </iframe>
                                        @endif
                                    </div>
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
                                        @if(isset($question->file->file))
                                        <video id="old" width="300" height="300" controls>
                                            <source src="{{ asset('pictures/video/' . $question->file->file) }}">
                                        </video>
                                        @endif
                                        <video id="video" width="300" height="300" controls></video>
                                    </div>
                                    @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                <button type="submit" class="btn btn-primary">حفظ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal edit mini answer --}}
        {{-- create modal --}}
        <div class="modal fade" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createmodal">{{ $question->mini_question ?? '' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('answers.store') }}" id="myform">
                            @csrf
                            <div class="form-row">
                                <input name="question_id" value="{{ $question->id }}" hidden>
                                <div class="col-md-12 col-12 mb-3">
                                    <label for="title">العنصر</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="العنصر"
                                           value="{{ old('title') }}" required>
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 col-12 mb-3">
                                    <label for="answer">نص الاجابة</label>
                                    <textarea rows="10" name="answer" class="form-control summernote2" placeholder="نص الاجابة"
                                              required>{{ old('answer') }}</textarea>
                                    @error('answer')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-12">
                                <div class="text-bold-600 font-medium-2">
                                    الترتيب بالنسبة للعناصر
                                </div>
                                <div class="form-group">
                                    <input type="number" min="1" name="order" class="form-control" id="order" placeholder="ترتيب العناصر"
                                           value="{{ old('order') }}" required>
                                    @error('order')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @error('order')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <hr>
                            <button style="width: 100%" class="btn btn-primary" type="submit">اضافة</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- end create modal --}}
    <!-- Data list view starts -->
        <div class="col-12">
            @include('common.done')
            @include('common.errors')
        </div>
        <div class="row">
            <div class="col-md-10 col-sm-12 col-xs-12">
                <section id="global-settings" class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <span class="text-bold-700 border-bottom pb-1"> السؤال بإختصار :</span>
                            @if(!empty($question->mini_question))
                                {{ $question->mini_question }}
                            @else
                                <span class="alert alert-warning">لم يتم اضافة اختصار بعد</span>
                            @endif
                            <button type="button" class="btn btn-primary px-1" data-toggle="modal" data-target="#mini_question">
                                <i class="fa fa-edit"></i>
                            </button>
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-text">
                                <p>
                                    <span class="text-bold-700 pb-1">نص السؤال :</span>
                                    {{ $question->question }}
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div style="justify-content: space-between;display: flex;" class="col-md-2 col-sm-12 col-xs-12">
                <div style="width: 100%" class="card p-1 text-center">
                <span class="display-inline-block">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                    رقم السؤال
                    <br>
                    {{ $question->id }}
                </span>
                    <hr>
                    <span class="display-inline-block">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    عدد الزيارات
                        <br>
                        {{ $question->views }}
                </span>
                </div>
            </div>
        </div>
        <section id="data-thumb-view" class="data-thumb-view-header">
            <div class="action-btns d-none">
                <div class="btn-dropdown mr-1 mb-1">
                    <div class="btn-group dropdown actions-dropodown">
                        <button type="button" class="btn btn-success px-1 py-1 dropdown-toggle waves-effect waves-light"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            خيارات
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" type="button" data-toggle="modal" data-target="#createmodal">
                                <i class="fa fa-plus"></i>اضافة جديد
                            </a>
                            <a class="dropdown-item delete-all" onclick="return false;" delete_url="/delete_answers/">
                                حذف الكل</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- dataTable starts -->
            <div class="table-responsive">

                <table class="table data-thumb-view">
                    <thead>
                    <tr>
                        <th colspan="4">عناصر اجابة السؤال ( يتم اضافة عنصر في حالة عدم وجود عناصر متعددة )</th>
                    </tr>
                    <tr>
                        <th hidden></th>
                        <th>الترتيب</th>
                        <th>العنصر</th>
                        <th>تصفح</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($question->answers as $answer)
                        <div class="modal fade" id="exampleModalCenter{{ $answer->id }}" tabindex="-1"
                             role="dialog" aria-labelledby="exampleModalCenterTitle{{ $answer->id }}"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="exampleModalLongTitle{{ $answer->id }}">{{ substr( $answer->title, 0, 50 ) }}</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post"
                                              action="{{ route('answers.update' , $answer->id) }}"
                                              id="myform">
                                            @csrf
                                            {{ method_field('PATCH') }}
                                            <div class="form-row">
                                                <input name="question_id" value="{{ $question->id }}"
                                                       hidden>
                                                <div class="col-md-12 col-12 mb-3">
                                                    <label for="title{{ $answer->id }}">العنصر</label>
                                                    <input type="text" name="title" class="form-control"
                                                           id="title{{ $answer->id }}" placeholder="العنصر"
                                                           value="{{ $answer->title }}" required>
                                                    @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 col-12 mb-3">
                                                    <label for="answer{{ $answer->id }}">نص الاجابة</label>
                                                    <textarea rows="10" name="answer"
                                                              id="answer{{ $answer->id }}"
                                                              class="form-control summernote2"
                                                              placeholder="نص الاجابة"
                                                              required>{{ $answer->answer }}</textarea>
                                                    @error('answer')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12 col-12 mb-3">
                                                    <div class="text-bold-600 font-medium-2">
                                                        الترتيب بالنسبة للعناصر
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <input type="number" min="1" name="order" class="form-control" id="order" placeholder="ترتيب العناصر"
                                                                   value="{{ $answer->order }}" required>
                                                            @error('order')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @error('order')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <hr>
                                            <button style="width: 100%" class="btn btn-primary" type="submit">حفظ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <tr class="delete-all-cats">
                            <td hidden></td>
                            <td>
                                {{ $answer->order }}
                            </td>
                            <td class="product-name">{{ substr( $answer->title, 0, 50 ) }}</td>
                            <td class="product-name">
                                <a class="edit-btn-table" href="{{ route('answers.show' , $answer->id) }}">
                                    <i class="fa fa-eye fa-2x"></i></a>
                            </td>
                            <td class="product-action">
                                <a type="button" data-toggle="modal"
                                   data-target="#exampleModalCenter{{ $answer->id }}">
                                    <i class="feather icon-edit"></i>
                                </a>
                                <a title="" onclick="return false;" object_id="{{ $answer->id }}"
                                   delete_url="/answers/" class="edit-btn-table remove-alert" href="#">
                                    <i class="feather icon-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- dataTable ends -->
        </section>
        <!-- Data list view end -->
       <section id="global-settings" class="card mt-2">
            <div style="justify-content: space-between;display: flex;" class="card-header">
                <h4 class="card-title">
                    <span class="text-bold-700 border-bottom pb-1"> اختصار الاجابة والمصادر :</span>
                </h4>
                <button type="button" class="btn btn-primary px-1" data-toggle="modal" data-target="#mini_answer">
                    <i class="fa fa-edit"></i>
                </button>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="card-text">
                        <strong>الاجابة</strong>
                        <p class="mt-2">
                            @if(!empty($question->mini_answer))
                                {{ $question->mini_answer }}
                            @else
                                <span class="alert alert-warning">لم يتم اضافة اختصار للاجابة بعد</span>
                            @endif
                        </p>
                        <hr>
                        <strong>المصادر</strong>
                        <p class="mt-2">
                            @if(!empty($question->sources))
                                <?php echo htmlspecialchars_decode($question->sources) ?>
                            @else
                                <span class="alert alert-warning">لم يتم اضافة مصادر للاجابة بعد</span>
                            @endif
                        </p>
                        <hr>
                        <strong>الفيديو</strong>
                        <p class="mt-2">
                        @if(!empty($question->file->file) || isset($question->file->link))
                            <div class="col-md-12 col-12 mb-3 link">
                                <label for="link">الرابط</label>
                                <div class="col-md-12 text-center">
                                    @if(isset($question->file->link))
                                        <?php
                                        $string     =  $question->file->link ;
                                        $search     = '/youtube\.com\/watch\?v=([a-zA-Z0-9]+)/smi';
                                        $replace    = "youtube.com/embed/$1";
                                        $url = preg_replace($search,$replace,$string);
                                        ?>
                                        <iframe width="420" height="315" src='{{ $url }}?modestbranding=1' allowfullscreen>
                                        </iframe>
                                    @endif
                                </div>
                               <a style="width:100%" href="{{ route('delete_video' , $question->file->id) }}" class="btn btn-danger">حذف الفيديو</a>
                            </div>
                            <div class="col-md-12 col-12 mb-3 file">
                                <label for="link">الفيديو بصيغة ( 3gp , MP4 , flv )
                                    max 10 MB
                                </label>
                                <div class="col-md-12 text-center">
                                    @if(isset($question->file->file))
                                        <video id="old" width="300" height="300" controls>
                                            <source src="{{ asset('pictures/video/' . $question->file->file) }}">
                                        </video>
                                    @endif
                                    <video id="video" width="300" height="300" controls></video>
                                   <a style="width:100%" href="{{ route('delete_video' , $question->file->id) }}" class="btn btn-danger">حذف الفيديو</a>
                                </div>
                            </div>
                        @else
                            <span class="alert alert-warning">لم يتم اضافة فيديو</span>
                            @endif
                            </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- END: Content-->
@endsection
@section('backend-footer')
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('backend') }}/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('backend') }}/app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/dataTables.select.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('backend') }}/app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('backend') }}/app-assets/js/core/app.js"></script>
    <script src="{{ asset('backend') }}/app-assets/js/scripts/components.js"></script>
    <script src="{{ asset('backend') }}/custom-sweetalert.js"></script>
    <!-- END: Theme JS-->
    <script src="{{ asset('backend') }}/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                tabsize: 2,
                height: 100,
                toolbar: [
                    ['insert', ['link']],
                ],
            });
            $('.summernote2').summernote({
                tabsize: 2,
                height: 100,
            });
        });
        $(document).ready(function () {
            $("#myform").validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 3,
                    },
                    answer: {
                        required: true,
                    },
                },
                messages: {
                    title: {
                        required: 'هذا الحقل مطلوب',
                        minlength: 'هذا الحقل مطلوب اقل من المسموح',
                    },
                    answer: {
                        required: 'هذا الحقل مطلوب',
                    },
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
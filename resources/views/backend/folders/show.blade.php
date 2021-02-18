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
@endsection
@section('backend-main')
    <section class="tooltip-validations" id="tooltip-validation">
        <div class="row">
            <div class="col-md-12">
                @include('common.done')
                @include('common.errors')
            </div>
            <div style="justify-content: space-between;display: flex;" class="col-sm-12 my-1">
                <a  class="btn btn-success" href="{{ route('folderfiles_page' , $folder->id) }}"><i class="fa fa-plus"></i>اضافة جديد</a>
                <a style="color:#ffffff" class="btn btn-danger delete-all-folderfile" onclick="return false;" delete_url="/delete_folderfiles/"
                   object_id="{{ $folder->id }}">حذف الكل</a>
            </div>
        </div>
        <!-- Nav Justified Starts -->
        <section id="nav-justified">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card overflow-hidden">
                        <div class="card-header">
                            <h4 class="card-title">معروضات الملف المتنوع : </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <p>
                                    {{ $folder->title }}
                                </p>
                                <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab-justified" data-toggle="tab"
                                           href="#home-just" role="tab" aria-controls="home-just" aria-selected="true">المقالات</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab-justified" data-toggle="tab"
                                           href="#profile-just" role="tab" aria-controls="profile-just"
                                           aria-selected="true">الفديوهات</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="messages-tab-justified" data-toggle="tab"
                                           href="#messages-just" role="tab" aria-controls="messages-just"
                                           aria-selected="false">الكتب</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="settings-tab-justified" data-toggle="tab"
                                           href="#settings-just" role="tab" aria-controls="settings-just"
                                           aria-selected="false">الصوتيات</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="settings-tab-justified" data-toggle="tab"
                                           href="#question-just" role="tab" aria-controls="question-just"
                                           aria-selected="false">الشبهات</a>
                                    </li>
                                </ul>
                                <section id="data-thumb-view2" class="data-thumb-view-header">
                                    <!-- dataTable starts -->
                                    <div class="table-responsive">
                                        <div class="tab-content pt-1">
                                            <div class="tab-pane active" id="home-just" role="tabpanel"
                                                 aria-labelledby="home-tab-justified">
                                                <table style="width: 100%;" class="table data-thumb-view">
                                                    <thead>
                                                    <tr>
                                                        <th hidden=""></th>
                                                        <th>#</th>
                                                        <th>العنوان</th>
                                                        <th>التصنيف</th>
                                                        <th>مفعل</th>
                                                        <th>خيارات</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($articles as $article)
                                                        <tr class="delete-all-cats">
                                                            <td hidden></td>
                                                            <td>
                                                                {{ $loop->index + 1 }}
                                                            </td>
                                                            <td class="product-name">{{ $article->title }}</td>
                                                            <td class="product-category">{{ $article->category->title ?? '' }}</td>
                                                            <td>
                                                                {{ $article->getActive() }}
                                                            </td>
                                                            <td class="product-action">
                                                                <?php
                                                                    $folder_file = \App\Models\FolderFile::
                                                                    where('folder_id' , $folder->id)
                                                                        ->where('media_id' , $article->id)
                                                                        ->first();
                                                                ?>
                                                                <a title="" onclick="return false;"
                                                                   object_id="{{ $folder_file->id }}"
                                                                   delete_url="/folderfiles/"
                                                                   class="edit-btn-table remove-alert" href="#">
                                                                    <i class="feather icon-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="profile-just" role="tabpanel"
                                                 aria-labelledby="profile-tab-justified">
                                                <table style="width: 100%" class="table data-thumb-view">
                                                    <thead>
                                                    <tr>
                                                        <th hidden></th>
                                                        <th>#</th>
                                                        <th>الصورة</th>
                                                        <th>العنوان</th>
                                                        <th>التصنيف الرئيسي</th>
                                                        <th>مفعل</th>
                                                        <th>نوع الفيديو</th>
                                                        <th>تصفح</th>
                                                        <th>خيارات</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($videos as $video)
                                                        <div class="modal fade" id="exampleModalCenter{{ $video->id }}"
                                                             tabindex="-1" role="dialog"
                                                             aria-labelledby="exampleModalCenterTitle{{ $video->id }}"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                 role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLongTitle{{ $video->id }}">{{ $video->title }}</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <video id="old" style="width: 100%" controls>
                                                                            @if(isset($video->file->file))
                                                                                <source src="{{ asset('pictures/video/' . $video->file->file) }}">
                                                                            @endif
                                                                        </video>
                                                                        @if($video->file->link)
                                                                            <iframe style="width: 100%"
                                                                                    src='{{ $url }}?modestbranding=1'
                                                                                    allowfullscreen>
                                                                            </iframe>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <tr>
                                                            <td hidden></td>
                                                            <td>
                                                                {{ $loop->index +1 }}
                                                            </td>
                                                            <td class="product-img"><img
                                                                        src="{{ asset('pictures/media/' . $video->mainImage->image) ?? '--' }}"
                                                                        alt="{{ $video->title }}">
                                                            </td>
                                                            <td class="product-name">{{ $video->title }}</td>
                                                            <td class="product-category">{{ $video->category->title ?? '' }}</td>
                                                            <td>
                                                                {{ $video->getActive() }}
                                                            </td>
                                                            <td>
                                                                {{ $video->getVideoKind() }}
                                                            </td>
                                                            <td>
                                                                <a type="button" class="btn btn-primary"
                                                                   data-toggle="modal"
                                                                   data-target="#exampleModalCenter{{ $video->id }}">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            </td>
                                                            <td class="product-action">
                                                                <?php
                                                                $folder_file = \App\Models\FolderFile::
                                                                where('folder_id' , $folder->id)
                                                                    ->where('media_id' , $video->id)
                                                                    ->first();
                                                                ?>
                                                                <a title="" onclick="return false;"
                                                                   object_id="{{ $folder_file->id }}"
                                                                   delete_url="/folderfiles/"
                                                                   class="edit-btn-table remove-alert" href="#">
                                                                    <i class="feather icon-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="messages-just" role="tabpanel"
                                                 aria-labelledby="messages-tab-justified">
                                                <table style="width: 100%" class="table data-thumb-view">
                                                    <thead>
                                                    <tr>
                                                        <th hidden></th>
                                                        <th>#</th>
                                                        <th>الصورة</th>
                                                        <th>العنوان</th>
                                                        <th>التصنيف</th>
                                                        <th>مفعل</th>
                                                        <th>تصفح</th>
                                                        <th>خيارات</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($books as $book)
                                                        <tr class="delete-all-cats">
                                                            <td hidden></td>
                                                            <td>
                                                                {{ $loop->index + 1 }}
                                                            </td>
                                                            <td class="product-img"><img
                                                                        src="{{ asset('pictures/media/' . $book->mainImage->image) }}"/>
                                                            </td>
                                                            <td class="product-name">{{ $book->title }}</td>
                                                            <td class="product-category">{{ $book->category->title ?? '' }}</td>
                                                            <td>
                                                                {{ $book->getActive() }}
                                                            </td>
                                                            <td>
                                                                <a title="تصفح الكتاب" target="_blank"
                                                                   href="{{ asset('pictures/books/' . $book->file->file) }}">
                                                                    <i class="fa fa-book fa-2x"></i>
                                                                </a>
                                                            </td>
                                                            <td class="product-action">
                                                                <?php
                                                                $folder_file = \App\Models\FolderFile::
                                                                where('folder_id' , $folder->id)
                                                                    ->where('media_id' , $book->id)
                                                                    ->first();
                                                                ?>
                                                                <a title="" onclick="return false;"
                                                                   object_id="{{ $folder_file->id }}"
                                                                   delete_url="/folderfiles/"
                                                                   class="edit-btn-table remove-alert" href="#">
                                                                    <i class="feather icon-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane" id="settings-just" role="tabpanel"
                                                 aria-labelledby="settings-tab-justified">
                                                <table style="width: 100%;" class="table data-thumb-view">
                                                    <thead>
                                                    <tr>
                                                        <th hidden></th>
                                                        <th>#</th>
                                                        <th>العنوان</th>
                                                        <th>التصنيف</th>
                                                        <th>مفعل</th>
                                                        <th>الصوت</th>
                                                        <th>خيارات</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($audios as $audio)
                                                        <div class="modal fade" id="exampleModalCenter{{ $audio->id }}"
                                                             tabindex="-1" role="dialog"
                                                             aria-labelledby="exampleModalCenterTitle{{ $audio->id }}"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                 role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLongTitle{{ $audio->id }}">{{ $audio->title }}</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @if(!empty($audio->file->file))
                                                                            <audio controls>
                                                                                <source src="{{ asset('pictures/audio/' . $audio->file->file) }}">
                                                                            </audio>
                                                                        @else
                                                                            <div>
                                                                                {!! $audio->file->link !!}
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <tr class="delete-all-cats">
                                                            <td hidden></td>
                                                            <td>
                                                                {{ $loop->index + 1 }}
                                                            </td>
                                                            <td class="product-name">{{ $audio->title }}</td>
                                                            <td class="product-category">{{ $audio->category->title ?? '' }}</td>
                                                            <td>
                                                                {{ $audio->getActive() }}
                                                            </td>
                                                            <td>
                                                                <a type="button" class="btn btn-primary"
                                                                   data-toggle="modal"
                                                                   data-target="#exampleModalCenter{{ $audio->id }}">
                                                                    <i class="fa fa-headphones"></i>
                                                                </a>
                                                            </td>
                                                            <td class="product-action">
                                                                <?php
                                                                $folder_file = \App\Models\FolderFile::
                                                                where('folder_id' , $folder->id)
                                                                    ->where('media_id' , $audio->id)
                                                                    ->first();
                                                                ?>
                                                                <a title="" onclick="return false;"
                                                                   object_id="{{ $folder_file->id }}"
                                                                   delete_url="/folderfiles/"
                                                                   class="edit-btn-table remove-alert" href="#">
                                                                    <i class="feather icon-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="question-just" role="tabpanel"
                                                 aria-labelledby="settings-tab-justified">
                                                <table style="width: 100%" class="table data-thumb-view">
                                                    <thead>
                                                    <tr>
                                                        <th hidden=""></th>
                                                        <th>ID</th>
                                                        <th>اختصار السؤال</th>
                                                        <th>حالة الاجابة</th>
                                                        <th>صاحب السؤال</th>
                                                        <th>مفعل</th>
                                                        <th>خيارات</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($questions as $question)
                                                        <tr class="delete-all-cats">
                                                            <td hidden=""></td>
                                                            <td>
                                                                {{ $loop->index +1 }}
                                                            </td>
                                                            <td class="product-name">{{ $question->mini_question }}</td>
                                                            <td>
                                                                {{ $question->getAnswered() }}
                                                                {{ $question->answered_by ?? ''}}
                                                            </td>
                                                            <td>
                                                                @if(!empty($question->moderator))
                                                                    المشرف :  {{ $question->moderator->name }}
                                                                @else
                                                                    العضو :  {{ $question->user->name }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{ $question->getActive() }}
                                                            </td>
                                                            <td class="product-action">
                                                                <?php
                                                                $folder_file = \App\Models\FolderFile::
                                                                where('folder_id' , $folder->id)
                                                                    ->where('question_id' , $question->id)
                                                                    ->first();
                                                                ?>
                                                                <a title="" onclick="return false;"
                                                                   object_id="{{ $folder_file->id }}"
                                                                   delete_url="/folderfiles/"
                                                                   class="edit-btn-table remove-alert" href="#">
                                                                    <i class="feather icon-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Nav Justified Ends -->
    </section>
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
@endsection    

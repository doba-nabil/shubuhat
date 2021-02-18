@extends('backend.layout.master')
@section('backend-head')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/plugins/file-uploaders/dropzone.css">
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
        <!-- Data list view starts -->
        <div class="col-12">
            @include('common.done')
        </div>
        <section id="data-thumb-view" class="data-thumb-view-header">
            <div class="action-btns d-none">
                <div class="btn-dropdown mr-1 mb-1">
                    <div class="btn-group dropdown actions-dropodown">
                        <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            خيارات
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('videos.create') }}"><i class="fa fa-plus"></i>اضافة جديد</a>
                            <a class="dropdown-item delete-all" onclick="return false;" delete_url="/delete_videos/">
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
                        <div class="modal fade" id="exampleModalCenter{{ $video->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle{{ $video->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle{{ $video->id }}">{{ $video->title }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if($video->file->file)
                                        <video id="old" style="width: 100%" controls>
                                                <source src="{{ asset('pictures/video/' . $video->file->file) }}">
                                        </video>
                                        @endif
                                        @if($video->file->link)
                                            <?php
                                            $string     =  $video->file->link ;
                                            $search     = '/youtube\.com\/watch\?v=([a-zA-Z0-9]+)/smi';
                                            $replace    = "youtube.com/embed/$1";
                                            $url = preg_replace($search,$replace,$string);
                                            ?>
                                            <iframe style="width: 100%" src='{{ $url }}?modestbranding=1' allowfullscreen>
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
                            <td class="product-img">
                                @if(isset($video->mainImage))
                                    <img src="{{ asset('pictures/media/' . $video->mainImage->image)}}" alt="{{ $video->title }}">
                                @else
                                    <img src="{{ asset('frontend/img/empty.png') }}" alt=""/>
                                @endif

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
                                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{ $video->id }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                            <td class="product-action">
                                <span class="action-edit"><a href="{{ route('videos.edit' , $video->slug) }}"><i class="feather icon-edit"></i></a></span>
                                <a title="" onclick="return false;" object_id="{{ $video->id }}"
                                   delete_url="/videos/" class="edit-btn-table remove-alert" href="#">
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
@endsection
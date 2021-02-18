@extends('frontend.layout.master')
@section('pageTitle', 'التصنيفات')
@section('frontend-head')
@endsection
@section('frontend-main')
    <div class="clearfix"></div>
    <!-- maintab -->
    <div class="main-categories">
        <div class="maintab my-5">
            <div class="container condf">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="mainacc d-flex align-items-center">
                            <i class="fas fa-user-circle"></i>
                            <p>التصنيفات</p>
                        </div>
                    </div>
                </div>
                <div style="width: 100%;" class="row rowrescat">
                    <div class="col-md-4">
                        <div class="tab">
                            <div id="accordion">
                                <table id="tree-table" class="table table-hover table-bordered">
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr data-id="{{$category->id}}" data-parent="0" data-level="1">
                                            <td class="click glyphicon-chevron-right" data-column="name"
                                                onmouseover="openCity(event, '{{ $category->title }}')">
                                                <i class="fas fa-folder-open fa-w-18 mr-3"></i>
                                                <a href="{{ route('category.show' , $category->slug) }}">{{$category->title}}</a>
                                                @if(count($category->subCategories))
                                                    <i class="rotate fas fa-angle-left float-right"></i>
                                                @endif
                                            </td>
                                        </tr>
                                        @if(count($category->subCategories))
                                            @include('frontend.category.tree',['subcategories' => $category->subCategories, 'dataParent' => $category->id , 'dataLevel' => 1])
                                        @endif
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="main-tab-content col-md-8">
                        <!-- now shobohat  -->
                        <div class="categories w-100">
                            <!-- search  -->
                            <form method="post" action="{{ route('catSearch') }}">
                                @csrf
                                <div class="search">
                                    <div class="allsea">
                                        <input name="word" class="form-control" type="text" placeholder="إبحث عن شبهات عن طريق الشبهة او رقمها">
                                        <button type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                            <!-- end search  -->
                            <div class="content-hover">
                                <img src="{{ asset('frontend') }}/img/grid.png" alt="...">
                                <h4>عنوان التصنيف</h4>
                                <p>انقر على السهم لتوسيع التصنيف. انقر على العنوان لزيارة التصنيف. مرر مؤشر الماوس فوق
                                    العناوين للاطلاع على وصف.</p>
                                <div class="allcontent">
                                    @foreach($allcategories as $category)
                                        <div id="{{ $category->title }}" class="tabcontent text-center">
                                            {{ $category->title }}
                                            <br>
                                            <h6 style="color: black">{{ $category->subtitle ?? ''}}</h6>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- now shobohat  -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end maintab -->
    <div class="clearfix"></div>
@endsection
@section('frontend-footer')
    <script src="{{ asset('frontend/js/javascript.js') }}"></script>
@endsection
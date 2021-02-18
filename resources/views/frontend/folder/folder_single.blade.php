@extends('frontend.layout.master')
@section('frontend-head')
@endsection
@section('pageTitle', $folder->title)
@section('frontend-main')
    <!-- search  -->
    <div class="searchcat">
        <div class="container">
            <div class="allsea">
                <h4>{{$folder->title}}</h4>
            </div>
        </div>
    </div>
    <!-- end search  -->
    <!-- now shobohat  -->
    <div class="catshobohat">
        <div class="shobohat">
            <div class="container">
                <div class="allshobohat">
                    <div class="title">
                        <h4 class="titleshop">
                            شبهات جديدة
                        </h4>
                        <a class="btn catbtn" href="{{ route('folder.index') }}">
                            عودة للملفات المتنوعة
                        </a>
                    </div>
                    <div style="width: 100%;" class="row rowrescat">
                        <div class="main-tab-content col-md-12">
                            <div style="width: 100%" class="totaltotal">
                                @if(count($questions) > 0)
                                    <table class="table example  table-borderless" style="width:100%">
                                        <thead style="display:none;">
                                        <tr>
                                            <th hidden></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($questions as $question)
                                            <tr>
                                                <td hidden></td>
                                                <td>
                                                    <div class="totalshob">

                                                        <div class="oneshob d-colm">
                                                            <div class="rightshob d-colm">
                                                                @auth
                                                                    <?php
                                                                    $likee = \App\Models\Favourite::where('question_id', $question->id)->where('user_id', Auth::user()->id)->count();
                                                                    ?>
                                                                    @if($likee > 0)
                                                                        <a role="button" class="favourite_add color"
                                                                           ad="{{ $question->id }}"
                                                                           data-token="{{ csrf_token() }}">
                                                                            <i class="far fa-bookmark"></i>
                                                                        </a>
                                                                    @else
                                                                        <a role="button" class="favourite_add"
                                                                           ad="{{ $question->id }}"
                                                                           data-token="{{ csrf_token() }}">
                                                                            <i class="far fa-bookmark"></i>
                                                                        </a>
                                                                    @endif
                                                                @else
                                                                    <button type="button" class="btn"
                                                                            data-toggle="modal" data-target="#like">
                                                                        <i class="far fa-bookmark"></i>
                                                                    </button>
                                                                @endauth
                                                                <a href="{{ route('question.show' , $question->slug) }}">
                                                                    <p class="d-center">{{ $question->mini_question }}</p>
                                                                </a>
                                                            </div>
                                                            <div class="leftshob pigmartop">
                                                                <a href="{{ route('question.show' , $question->slug) }}">
                                                                    <p class="pigmartop">
                                                                        {{  Carbon\Carbon::parse($question->answered_date)->format('d-m-Y') }}
                                                                    </p>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-warning">
                                        <h3>
                                            لا يوجد شبهات في الملف....
                                        </h3>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- now shobohat  -->
    <!-- tabs  -->
    <div class="tabs">
        <div class="container">
            <div class="title">
                <h4 class="sectiontitle mb-5">
                    مكتبة الوسائط
                </h4>
            </div>
            <div class="alltabs">

                <div class="content">
                    <!-- Nav pills -->
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#vdio">
                                <i class="fas fa-video"></i>
                                فيديوهات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#record">
                                <i class="fas fa-volume-down"></i>
                                صوتيات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#book">
                                <i class="fas fa-book"></i>
                                كتب</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#artical">
                                <i class="far fa-newspaper"></i>
                                مقالات</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="vdio" class=" tab-pane active">
                            @if(count($videos) > 0)
                                <table class="table example table-borderless" style="width:100%">
                                    <thead style="display:none;">
                                    <tr>
                                        <th hidden></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($videos as $video)
                                        <tr>
                                            <td hidden></td>
                                            <td>
                                                <div class="allvideo d-colm">
                                                    <div class="rightsec d-colm">
                                                        <div class="secimg d-center">
                                                            @if(isset($video->mainImage->image))
                                                                <img src="{{ asset('pictures/media/' . $video->mainImage->image) ?? '--' }}"
                                                                     alt="{{ $video->title }}">
                                                            @else
                                                                <img src="{{ asset('frontend/img/empty.png') }}"
                                                                     alt=""/>
                                                            @endif
                                                            <div class="overlaysec"><i class="far fa-play-circle"></i>
                                                            </div>
                                                        </div>
                                                        <div class="viddeta d-colm">
                                                            <p class="namev">{{ $video->title }}</p>
                                                            <p class="catv">{{ $video->category->title ?? '' }}</p>
                                                            <p class="timev">{{  Carbon\Carbon::parse($video->created_at)->format('d-m-Y') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="leftsec">
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn shahed" data-toggle="modal"
                                                                data-target="#video_modal{{ $loop->index + 1 }}">
                                                            مشاهدة
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="video_modal{{ $loop->index + 1 }}"
                                                             tabindex="-1" role="dialog"
                                                             aria-labelledby="exampleModalCenterTitle"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                 role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLongTitle">
                                                                            مشاهدة الفيديو</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        @if(isset($video->file->file))
                                                                            <video width="420" height="340" controls>
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
                                                                            <iframe style="width: 100%"
                                                                                    src='{{ $url }}?modestbranding=1'
                                                                                    allowfullscreen>
                                                                            </iframe>
                                                                        @endif
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">اغلاق
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning">
                                    <h3>
                                        لا يوجد فيديوهات في الملف....
                                    </h3>
                                </div>
                            @endif
                        </div>
                        <div id="record" class=" tab-pane fade">
                            @if(count($audios))
                                <table class="table example table-borderless" style="width:100%">
                                    <thead style="display:none;">
                                    <tr>
                                        <th hidden></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($audios as $audio)
                                        <tr>
                                            <td hidden></td>
                                            <td>
                                                <div class="allaudio @if(empty($audio->file->file)) allvideo @endif">
                                                    <h4 @if(empty($audio->file->file)) class="text-center" @endif>
                                                        {{ $audio->title }}
                                                        @if(empty($audio->file->file))
                                                            <img class="" width="120px"
                                                                 src="{{ asset('frontend/img/sound.png') }}">
                                                        @endif
                                                    </h4>
                                                    <p class="adiotext">{{ $audio->subtitle }}</p>
                                                    @if(!empty($audio->file->file))
                                                        <div class="ready-player-{{ $audio->id }}">
                                                            <audio>
                                                                <source src="{{ asset('pictures/audio/' . $audio->file->file) }}">
                                                            </audio>
                                                        </div>
                                                    @else
                                                        <div class="modal fade"
                                                             id="exampleModalCenter{{ $audio->slug }}"
                                                             tabindex="-1" role="dialog"
                                                             aria-labelledby="exampleModalCenterTitle"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                 role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLongTitle">{{ $audio->title }}</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <div>
                                                                            {!! $audio->file->link !!}
                                                                            <div class="clearfix"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">اغلاق
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="leftsec">
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn shahed" data-toggle="modal"
                                                                    data-target="#exampleModalCenter{{ $audio->slug }}">
                                                                استماع
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning">
                                    <h3>
                                        لا يوجد صوتيات في الملف....
                                    </h3>
                                </div>
                            @endif
                        </div>
                        <div id="book" class=" tab-pane fade">
                            @if(count($books) > 0)
                                <table class="table example table-borderless">
                                    <thead style="display:none;">
                                    <tr>
                                        <th hidden></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($books as $book)
                                        <tr>
                                            <td hidden></td>
                                            <td>
                                                <div class="allvideo d-colm">
                                                    <div class="rightsec d-colm">
                                                        <div class="secimg">
                                                            @if(isset($book->mainImage->image))
                                                                <img src="{{ asset('pictures/media/' . $book->mainImage->image) }}"
                                                                     alt="{{ $book->title }}">
                                                            @else
                                                                <img src="{{ asset('frontend/img/empty.png') }}"
                                                                     alt=""/>
                                                            @endif
                                                        </div>
                                                        <div class="viddeta d-colm">
                                                            <p class="namev">{{ $book->title }}</p>
                                                            <p class="catv">{{ $book->category->title ?? '' }}</p>
                                                            <p class="timev">{{  Carbon\Carbon::parse($book->created_at)->format('d-m-Y') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="leftsec d-colm">
                                                        <a class="pigmarbot" href="{{ route('book.show' , $book->slug) }}">
                                                            <button type="button" class="btn shahed">
                                                                نبذة
                                                            </button>
                                                        </a>
                                                        <a class="pigmarbot" href="{{ asset('pictures/books/' . $book->file->file) }}"
                                                           target="_blank">
                                                            <button type="button" class="btn shahed">
                                                                تصفح
                                                            </button>
                                                        </a>
                                                        <a href="#">
                                                            <button type="button" class="btn shahed-dwon">
                                                                <a target="_blank"
                                                                   href="{{ asset('pictures/books/' . $book->file->file) }}"
                                                                   download="">
                                                                    تحميل
                                                                    <i class="fa fa-download"></i>
                                                                </a>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning">
                                    <h3>
                                        لا يوجد كتب في الملف....
                                    </h3>
                                </div>
                            @endif
                        </div>
                        <div id="artical" class=" tab-pane fade">
                            @if(count($articles) > 0)
                                <table class="table example table-borderless">
                                    <thead style="display:none;">
                                    <tr>
                                        <th hidden></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($articles as $article)
                                        <tr>
                                            <td hidden></td>
                                            <td>
                                                <div class="allvideo d-colm">
                                                    <div class="rightsec d-colm">
                                                        <div class="secimg">
                                                            @if(isset($article->mainImage->image))
                                                                <img src="{{ asset('pictures/media/' . $article->mainImage->image) }}"
                                                                     alt="{{ $article->title }}">
                                                            @else
                                                                <img src="{{ asset('frontend/img/empty.png') }}"
                                                                     alt=""/>
                                                            @endif
                                                        </div>
                                                        <div class="viddeta d-colm">
                                                            <p class="namev">{{ $article->title }}</p>
                                                            <p class="catv">{{ $article->category->title }}</p>
                                                            <p class="timev">{{  Carbon\Carbon::parse($article->created_at)->format('d-m-Y') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="leftsec">
                                                        <a href="{{ route('article.show' , $article->slug) }}"
                                                           type="button" class="btn shahed">
                                                            تصفح
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning">
                                    <h3>
                                        لا يوجد مقالات في الملف....
                                    </h3>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ens tabs  -->
@endsection
@section('frontend-footer')
    <script src="{{ asset('frontend/js/javascript.js') }}"></script>
    @foreach($audios as $audio)
        @if(!empty($audio->file->file))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    new GreenAudioPlayer('.ready-player-{{ $audio->id }}', {
                        showTooltips: true,
                        showDownloadButton: false,
                        enableKeystrokes: true
                    });
                });
            </script>
        @endif
    @endforeach
@endsection
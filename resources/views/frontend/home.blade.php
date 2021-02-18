@extends('frontend.layout.master')
@section('frontend-head')
@endsection
@section('pageTitle', 'الرئيسية')
@section('frontend-main')
    <!-- search  -->
    <div class="search">
        <div class="container">
            <form method="post" action="{{ route('catSearch') }}">
                @csrf
                <div class="search">
                    <div class="allsea">
                        <input name="word" class="form-control" type="text"
                               placeholder="إبحث عن شبهات عن طريق الشبهة او رقمها">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end search  -->
    <!-- new shobohat  -->
    <div class="shobohat">
        <div class="container">
            <div class="allshobohat">
                <div class="title">
                    <h4 class="titleshop">
                        شبهات جديدة
                    </h4>
                </div>
                <div class="totaltotal">
                    <table class="table example table-borderless" style="width:100%">
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
                                            <span hidden>
                                                {{$question->id}}
                                            </span>
                                        <div class="oneshob d-colm">
                                            <div class="rightshob d-colm">
                                                @auth
                                                    <?php
                                                    $likee = \App\Models\Favourite::where('question_id', $question->id)->where('user_id', Auth::user()->id)->count();
                                                    ?>
                                                    @if($likee > 0)
                                                        <a role="button" class="favourite_add color"
                                                           ad="{{ $question->id }}" data-token="{{ csrf_token() }}">
                                                            <i class="far fa-bookmark"></i>
                                                        </a>
                                                    @else
                                                        <a role="button" class="favourite_add" ad="{{ $question->id }}"
                                                           data-token="{{ csrf_token() }}">
                                                            <i class="far fa-bookmark"></i>
                                                        </a>
                                                    @endif
                                                @else
                                                    <button type="button" class="btn" data-toggle="modal" data-target="#like">
                                                        <i class="far fa-bookmark"></i>
                                                    </button>
                                                @endauth
                                                <a href="{{ route('question.show' , $question->slug) }}">
                                                    <p class="d-center">
                                                        {{ $question->mini_question }}
                                                    </p>
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
                    <div class="moretab ">
                        <p style="color: #ffffff" class="text-right"><a href="{{ route('question.index') }}">المزيد . . .</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- now shobohat  -->
    <!-- banar  -->
    @if(isset($option->banner_image))
    <div class="banar mt-5">
        <div class="overlaypar">
            <a href="{{ $option->banner_link }}">
                <img src="{{ asset('pictures/options/' . $option->banner_image->image) }}" alt='{{ $option->banner_title }}'>
                <div class="overlaychi"></div>
                <h3>{{ $option->banner_title }}</h3>
            </a>
        </div>
    </div>
    @endif
    <!--end banar  -->
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
                                @foreach($videos as $video)
                                    <div class="allvideo d-colm">
                                        <div class="rightsec d-colm">
                                            <div class="secimg d-center">
                                                @if(isset($video->mainImage->image))
                                                    <img src="{{ asset('pictures/media/' . $video->mainImage->image)  }}">
                                                @else
                                                    <img src="{{ asset('frontend/img/empty.png') }}" alt=""/>
                                                @endif

                                                <div class="overlaysec"><i class="far fa-play-circle"></i></div>
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
                                                    data-target="#exampleModalCenter{{ $video->slug }}">
                                                مشاهدة
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter{{ $video->slug }}"
                                                 tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="exampleModalLongTitle">{{ $video->title }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            @if(isset($video->file->file))
                                                                <video width="420" height="340" controls>
                                                                    <source src="{{ asset('pictures/video/' . $video->file->file) }}">
                                                                </video>
                                                            @elseif($video->file->link)
                                                                <?php
                                                                $string     =  $video->file->link ;
                                                                $search     = '/youtube\.com\/watch\?v=([a-zA-Z0-9]+)/smi';
                                                                $replace    = "youtube.com/embed/$1";
                                                                $url = preg_replace($search,$replace,$string);
                                                                ?>
                                                                <iframe width="420" height="340"
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
                                @endforeach
                                <div class="moretab ">
                                    <p class="text-right"><a href="{{ route('video.index') }}">المزيد . . .</a></p>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <h4>
                                        لا يوجد فيديوهات بعد ....
                                    </h4>
                                </div>
                            @endif
                        </div>
                        <div id="record" class=" tab-pane fade">
                            @if(count($audios) > 0)
                                @foreach($audios as $audio)
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
                                            <div class="ready-player-{{ $audio->id  }}">
                                                <audio>
                                                    <source src="{{ asset('pictures/audio/' . $audio->file->file) }}">
                                                </audio>
                                            </div>
                                        @else
                                            <div class="modal fade" id="exampleModalCenter{{ $audio->slug }}"
                                                 tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="exampleModalLongTitle">{{ $audio->title }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
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
                                @endforeach
                                <div class="moretab ">
                                    <p class="text-right"><a href="{{ route('audio.index') }}">المزيد . . .</a></p>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <h4>
                                        لا يوجد صوتيات بعد ....
                                    </h4>
                                </div>
                            @endif
                        </div>
                        <div id="book" class=" tab-pane fade">
                            @if(count($books) > 0)
                                @foreach($books as $book)
                                    <div class="allvideo d-colm">
                                        <div class="rightsec d-colm">
                                            <div class="secimg">
                                                @if(isset($book->mainImage->image))
                                                    <img src="{{ asset('pictures/media/' . $book->mainImage->image) }}">
                                                @else
                                                    <img src="{{ asset('frontend/img/empty.png') }}" alt=""/>
                                                @endif

                                            </div>
                                            <div class="viddeta d-colm">
                                                <p class="namev">{{ $book->title }}</p>
                                                <p class="catv">{{ $book->category->title }}</p>
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
                                            <button type="button" class="btn shahed-dwon">
                                                <a href="{{ asset('pictures/books/' . $book->file->file) }}"
                                                   download="">
                                                    تحميل
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="moretab ">
                                    <p class="text-right"><a href="{{ route('book.index') }}">المزيد . . .</a></p>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <h4>
                                        لا يوجد كتب بعد ....
                                    </h4>
                                </div>
                            @endif
                        </div>
                        <div id="artical" class=" tab-pane fade">
                            @if(count($articles) > 0)
                                @foreach($articles as $article)
                                    <div class="allvideo d-colm">
                                        <div class="rightsec d-colm">
                                            <div class="secimg">
                                                @if(isset($article->mainImage->image))
                                                    <img src="{{ asset('pictures/media/' . $article->mainImage->image) }}"
                                                         alt="{{ $article->title }}">
                                                @else
                                                    <img src="{{ asset('frontend/img/empty.png') }}" alt=""/>
                                                @endif
                                            </div>
                                            <div class="viddeta d-colm">
                                                <p class="namev">{{ $article->title }}</p>
                                                <p class="catv">{{ $article->category->title }}</p>
                                                <p class="timev">{{  Carbon\Carbon::parse($article->created_at)->format('d-m-Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="leftsec">
                                            <a href="{{ route('article.show' , $article->slug) }}">
                                                <button type="button" class="btn shahed">
                                                    تصفح
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="moretab ">
                                    <p class="text-right"><a href="{{ route('article.index') }}">المزيد . . .</a></p>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <h4>
                                        لا يوجد مقالات بعد ....
                                    </h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ens tabs  -->

    <!-- different -->
    <div class="different mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="titledef">
                        <h4>ملفات متنوعة</h4>
                    </div>
                </div>
                <div class="col-md-8 taall">
                    <div class="owl1 owl-carousel owl-carousel1 owl-theme">
                        @foreach($folders as $folder)
                            <div class="item">
                                <div class="totalimg">
                                    <a class="imgmain" href="{{ route('folder.show' , $folder->slug) }}">
                                        @if(isset($folder->mainImage->image))
                                            <img src="{{ asset('pictures/folders/' . $folder->mainImage->image) }}"
                                                 alt="{{ $folder->title }}">
                                        @else
                                            <img src="{{ asset('frontend/img/empty.png') }}" alt=""/>
                                        @endif
                                    </a>
                                </div>
                                <div class="text">
                                    <p><a href="{{ route('folder.show' , $folder->slug) }}"
                                          class="textshow">{{ $folder->title }}</a></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="moredif">
                        <p class="text-right">
                            <a href="{{ route('folder.index') }}">
                                <i class="far fa-newspaper"></i>
                                المزيد من الملفات المتنوعة
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 ">
                    <div class="totimg">
                        <a href="{{ url($option->folders_link) }}">
                            {{--<div class="back">--}}
                                {{--<h4>{{ $folders[0]->title }}</h4>--}}
                            {{--</div>--}}
                            @if(isset($option->banner_image->image))
                                <img src="{{ asset('pictures/options/' . $option->folder_ad->image) }}" alt="">
                            @else
                                <img src="{{ asset('frontend/img/empty.png') }}" alt=""/>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end different -->
@endsection
@section('frontend-footer')
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
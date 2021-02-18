@extends('frontend.layout.master')
@section('frontend-head')
    <style>

        a {
            color: #c40030;
            background-color: transparent;
            -webkit-text-decoration-skip: objects;
        }
        .v-card {
            text-decoration: none;
        }

        .v-card > :first-child:not(.v-btn):not(.v-chip) {
            border-top-left-radius: inherit;
            border-top-right-radius: inherit;
        }

        .v-card > :last-child:not(.v-btn):not(.v-chip) {
            border-bottom-left-radius: inherit;
            border-bottom-right-radius: inherit;
        }

        .v-sheet {
            display: block;
            border-radius: 2px;
            position: relative;
        }
        .elevation-2 {
            box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14),
            0 1px 5px 0 rgba(0, 0, 0, 0.12) !important;
        }
        .title {
            font-size: 20px !important;
            font-weight: 700;
            line-height: 1 !important;
            letter-spacing: 0.02em !important;
        }

        .caption {
            font-weight: 400;
            font-size: 12px !important;
        }

        .theme--light.v-btn {
            color: rgba(0, 0, 0, 0.87);
        }

        .theme--light.v-btn:not(.v-btn--icon):not(.v-btn--flat) {
            background-color: #f5f5f5;
        }

        .theme--light .v-card {
            box-shadow: rgba(0, 0, 0, 0.11) 0 15px 30px 0px,
            rgba(0, 0, 0, 0.08) 0 5px 15px 0 !important;
        }

        .theme--light.application .v-card {
            box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.11),
            0 5px 15px 0 rgba(0, 0, 0, 0.08) !important;
            color: #102c3c !important;
        }

        .theme--light.v-card,
        .theme--light.v-sheet {
            border-radius: 10px;
            background-color: #fff;
            border-color: #fff;
            color: rgba(0, 0, 0, 0.87);
        }

        a,
        a:hover {
            text-decoration: none !important;
        }

        .wrapper {
            overflow: auto;
        }

        .answers {
            padding-left: 64px;
        }

        .comment {
            overflow-y: auto;
            margin-left: 32px;
            margin-right: 16px;
        }

        .comment p {
            font-size: 14px;
            margin-bottom: 7px;
        }

        .displayName {
            margin-left: 24px;
        }

        .actions {
            display: flex;
            flex: 1;
            flex-direction: row;
            justify-content: flex-end;
        }

        .google-span[data-v-35838f51] {
            font-size: 14px;
            color: rgba(0, 0, 0, 0.54);
        }

        .google-button[data-v-35838f51] {
            background-color: #fff;
            height: 40px;
            margin: 0;
        }

        .headline {
            margin-left: 32px;
        }

        .sign-in-wrapper {
            margin-top: 16px;
            margin-left: 32px;
        }


        .error-message {
            font-style: oblique;
            color: #c40030;
        }

        ::-moz-selection,
        ::selection {
            background-color: #b3d4fc;
            color: #000;
            text-shadow: none;
        }

        .card,
        .card {
            padding: 32px 16px;
            margin-bottom: 32px;
            display: flex;
            flex-direction: column;
        }

        .application a,
        [type="button"],
        button {
            cursor: pointer;
        }

        @media screen and (max-width: 640px) {
            .comment-container {
                width: 100%;
            }
            .comments {
                padding: 20px;
            }
        }
    </style>
@endsection
@section('pageTitle', $question->mini_question)
@section('frontend-main')
    <div class="print-image text-center mb-3">
        <img src="{{ asset('frontend/img/222.png') }}">
    </div>
    <div class="total-artical">
        <div class="sobts">
            <div class="shobohat mb-5">
                <div class="container">
                    <div class="allshobohat">
                        <div class="title">
                            <h4 class="titleshop mt-5 mb-5">
                                {{ $question->mini_question }}
                            </h4>
                        </div>
                        <div class="download-share d-colm">
                            <div class="row download-sharebox">
                                <div class="col-md-2 numbs minimartop d-colmm">
                                    <i class="fas fa-stream"></i>
                                    {{ $question->id }}
                                </div>
                                <div class="vl"></div>
                                <div class="col-md-3 time-date minimartop d-colmm">
                                    تاريخ النشر : {{ $question->answered_date }}
                                </div>
                                <div class="vl"></div>
                                <div class="col-md-6 views d-colm minimartop d-centerr">
                                    المشاهدات : {{ $question->views }}
                                    <div class="icondownlod minimartop">
                                        <a style="cursor: pointer" type="button" data-toggle="modal" data-target="#share">
                                            <i class="fas fa-share-alt"></i>
                                        </a>
                                        <button style="font-size:inherit" class="btn p-0 m-0 mt-1" onclick="display()">
                                            <i class="fas fa-print"></i>
                                        </button>
                                        <a href="#"></a>
                                        <a href="{{ route('question_pdf', $question->id )}}"><i class="fas fa-download"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="mainques">
                                <h4>السؤال</h4>
                                <p>
                                    {{ $question->question }}
                                </p>
                            </div>
                            @if(!empty($question->mini_answer))
                                <div class="cutans">
                                    <h4>ملخص الجواب</h4>
                                    <p>
                                        {{ $question->mini_answer }}
                                    </p>
                                </div>
                            @endif
                            <div class="textans">
                                <h4>نص الجواب</h4>
                                @if(count($question->answers) > 1)
                                    <a class="btn anaser mb-3" data-toggle="collapse" href="#collapseExample"
                                       role="button"
                                       aria-expanded="false" aria-controls="collapseExample">
                                        <i class="far fa-clone"></i>
                                        العناصر
                                    </a>
                                    <div class="collapse show" id="collapseExample">
                                        <div class="card card-body">
                                            @foreach($question->answers as $answer)
                                                <p>{{ $answer->title }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <p>الحمد لله</p>
                                @foreach($question->answers as $answer)
                                    <h4>{{ $answer->title }}</h4>
                                    <p><?php echo htmlspecialchars_decode($answer->answer) ?></p>
                                    @if(!$loop->last)
                                        <hr/>
                                    @endif
                                @endforeach
                            </div>
                            @if(!empty($question->file->file) || isset($question->file->link))
                            <div class="textans video-que-section">
                                <h4>فيديو الشبهة</h4>
                                @if(!empty($question->file->file) || isset($question->file->link))
                                    <div class="col-md-12 col-12 mb-3 link">
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
                                    </div>
                                    <div class="col-md-12 col-12 mb-3 file">
                                        <div class="col-md-12 text-center">
                                            @if(isset($question->file->file))
                                                <video poster="{{ asset('frontend/img/empty.png') }}" style="width: 100%" id="old" controls>
                                                    <source src="{{ asset('pictures/video/' . $question->file->file) }}">
                                                </video>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shobohat mb-5">
        <div class="container">
            <div class="allshobohat">
                <div class="title">
                    <h4 class="titleshop mt-5 mb-5">
                        التعليقات
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(count($question->comments) > 0)
                <div class="comment-container theme--light">
                    <div class="comments">
                        @foreach($question->comments as $comment)
                            <div>
                                <div  class="card v-card v-sheet theme--light elevation-2">
                                    <div style="display: flex;justify-content: space-between;" class="header">
                                        <span  class="displayName title">{{ $comment->user->name }}</span>
                                        <span  class="displayName caption">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <br>
                                    <div  class="wrapper comment">
                                        <p>
                                            {{ $comment->comment }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @else
                    <div class="alert alert-warning">
                        <h3>
                            لم يتم اضافة تعليقات بعد ....
                        </h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="resource">
        <div class="container">
            <div class="resourceall">
                <div class="restext">
                    @if(!empty($question->sources))
                        <p>
                            <span>المصدر : </span>
                            <?php echo htmlspecialchars_decode($question->sources) ?>
                        </p>
                    @endif
                </div>
                <div class="restext">
                    <!-- Button trigger modal -->
                    @auth()
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            اضف تعليقا
                        </button>
                    @else
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#like">
                            اضف تعليقا
                        </button>
                    @endauth
                <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">اضف تعليقك</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="comment_body">التعليق</label>
                                        <textarea name="comment" class="form-control" id="comment_body"
                                                  rows="3"></textarea>
                                    </div>
                                    <button onclick="return false;" ad="{{ $question->id }}"
                                            data-token="{{ csrf_token() }}" type="submit" class="btn btn-secondary sub"
                                            data-dismiss="modal">حفظ
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- share modale -->
    <div class="modal fade" id="share" tabindex="-1" role="dialog" aria-labelledby="share_title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="share_title">مشاركة الشبهة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
                    <ul>
                        <li title="مشاركة على فيس بوك">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $actual_link; ?>" target="_blank">
                                <img src="{{ asset('frontend/img/facebook.png') }}">
                            </a>
                        </li>
                        <li title="مشاركة على تويتر">
                            <a href="http://twitter.com/home?status={{ $question->mini_question }}+<?= $actual_link; ?>"
                               target="_blank">
                                <img src="{{ asset('frontend/img/twitter.png') }}">
                            </a>
                        </li>
                        <li title="مشاركة على الواتس اب">
                            <a href="https://api.whatsapp.com://send?text=<?= $actual_link; ?>" target="_blank" title="Share on whatsapp">
                                <img src="{{ asset('frontend/img/whatsapp.png') }}">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('frontend-footer')
    <script>
        function display() {
            window.print();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection
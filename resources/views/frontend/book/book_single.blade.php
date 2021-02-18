@extends('frontend.layout.master')
@section('pageTitle', $book->title)
@section('frontend-main')
    <div class="total-artical">
        <div class="sobts">
            <div class="shobohat mb-5">
                <div class="container">
                    <div class="allshobohat">
                        <div class="title">
                            <h4 class="titleshop mt-5 mb-5">
                               {{ $book->title }}
                            </h4>
                        </div>
                        <div class="download-share d-colm">
                            <div class="row download-sharebox">
                                <div class="col-md-2 numbs minimartop">
                                    <i class="fas fa-stream"></i>
                                    {{ $book->id }}
                                </div>
                                <div class="vl"></div>
                                <div class="col-md-3 time-date minimartop">
                                    تاريخ النشر :
                                    {{  Carbon\Carbon::parse($book->created_at)->format('d-m-Y') }}
                                </div>
                                <div class="vl"></div>
                                <div class="col-md-6 views d-colm minimartop">
                                    المشاهدات :
                                    {{ $book->views }}
                                    <div class="icondownlod minimartop">
                                        <a style="cursor: pointer" type="button" data-toggle="modal" data-target="#share">
                                            <i class="fas fa-share-alt"></i>
                                        </a>
                                        <a href="{{ asset('pictures/books/' . $book->file->file) }}" download=""><i class="fas fa-download"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="textans textansmine">
                                <div class="row">
                                    <div class="col-md-2">
                                        @if(isset($book->mainImage->image))
                                            <img style="width: 100%" src="{{ asset('pictures/media/' . $book->mainImage->image) }}">
                                        @else
                                            <img style="width: 100%" src="{{ asset('frontend/img/empty.png') }}" alt=""/>
                                        @endif
                                    </div>
                                    <div class="col-md-10">
                                        <h4>نبذة عن الكتاب</h4>
                                        <p>
                                            {{ $book->body }}
                                        </p>
                                    </div>
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
                            <a href="http://twitter.com/home?status={{ $book->title }}+<?= $actual_link; ?>" target="_blank">
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
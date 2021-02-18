@extends('frontend.layout.master')
@section('pageTitle', 'المقالات')
@section('frontend-main')
    <!-- now shobohat  -->
    <div class="sobts">
        <div class="shobohat mb-5">
            <div class="container">
                <div class="allshobohat">
                    <div class="title">
                        <h4 class="titleshop mt-4 mb-5">
                            نتائج البحث عن {{ $keyword }}
                        </h4>
                    </div>
                    <!-- search  -->
                    <div class="search">
                        <div class="">
                            <div class="allsea">
                                <form style="width: 100%" method="post" action="{{ route('catSearch') }}">
                                    @csrf
                                    <div class="search">
                                        <div class="allsea">
                                            <input name="word" class="form-control" type="text" placeholder=" إبحث عن شبهات عن طريق الشبهة او رقمها">
                                            <button type="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end search  -->
                    <div class="totaltotal">
                        @if(count($questions) > 0)
                        @foreach($questions as $question)
                            <div class="totalshob">

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
                                                            <a role="button" class="favourite_add"
                                                               ad="{{ $question->id }}"
                                                               data-token="{{ csrf_token() }}">
                                                                <i class="far fa-bookmark"></i>
                                                            </a>
                                                        @endif
                                                    @else
                                                        <button type="button" class="btn" data-toggle="modal"
                                                                data-target="#like">
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
                        @endforeach
                        @else
                            <div class="alert alert-warning">
                                <h3>لم يتم العثور على اي شبهات </h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- now shobohat  -->
@endsection
@section('frontend-footer')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "language": {
                    "url": "{{ asset('frontend/js/ar_table.json') }}"
                }
            });
        });
    </script>
@endsection
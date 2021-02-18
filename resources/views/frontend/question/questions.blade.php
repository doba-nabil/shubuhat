@extends('frontend.layout.master')
@section('pageTitle', 'الشبهات')
@section('frontend-main')
    <!-- now shobohat  -->
    <div class="sobts">
        <div class="shobohat mb-5">
            <div class="container">
                <div class="allshobohat">
                    <div class="title">
                        <h4 class="titleshop mt-4 mb-5">
                            الشبهات
                        </h4>
                        <p>إنقر لإختيار كل الشبهات أو تحديد تصنيف من التصنيفات التي تحتوي على شبهات </p>
                    </div>
                    <!-- search  -->
                    <div class="search">
                        <div class="">
                            <div class="allsea">
                                <form method="post" action="{{ route('cat_search') }}" class="formwid">
                                    @csrf
                                    <div style="width:100%" class="form-group display-inline">
                                        <select name="category_id" class="form-control display-inline-block"
                                                id="exampleFormControlSelect1"  onchange="this.form.submit();">
                                            <option value="0" @if($catId ?? '' == 0) selected @endif>كل الشبهات</option>
                                            @foreach($categories as $category)
                                                <option @if(isset($catId)) @if($catId  == $category->id) selected
                                                        @endif @endif value="{{ $category->id }}">
                                                    {{ $category->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{--<button class="display-inline-block" type="submit"><i class="fas fa-search"></i>--}}
                                    {{--</button>--}}
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end search  -->
                    <div class="totaltotal">
                        <table id="example" class="table  table-borderless" style="width:100%">
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
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
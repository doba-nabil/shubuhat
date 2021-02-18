<div id="Tokyo" class="tabcontent">
    <!-- now shobohat  -->
    <div class="sobts">
        <div class="shobohat mb-5">
            <div class="">
                <div class="allshobohat">
                    <!-- search  -->
                    <div class="search">
                        <div class="">
                            <div class="allsea">
                            </div>
                        </div>
                    </div>
                    <!-- end search  -->
                    <div class="totaltotal">
                        @if(count($like_questions) > 0)
                        <table class="table example table-borderless" style="width:100%">
                            <thead style="display:none;">
                            <tr>
                                <th hidden></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($like_questions as $question)
                                <tr>
                                    <td hidden></td>
                                    <td>
                                        <div class="totalshob">
                                            <div class="oneshob d-colm">

                                                <div class="rightshob d-colm">
                                                    <?php
                                                    $likee = \App\Models\Favourite::where('question_id', $question->id)->where('user_id', $user->id)->count();
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
                        @else
                            <br>
                            <div class="alert alert-warning">
                                <h3>
                                    لا يوجد شبهات في المفضلة ....
                                </h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- now shobohat  -->
</div>
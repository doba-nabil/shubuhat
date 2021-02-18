<div id="Paris" class="tabcontent">
    <div class="tabs">
        <div class="container">
            <div class="title">
                <h4 class="sectiontitle mb-5">
                    أسئلتى
                </h4>
            </div>
            <div class="alltabs">
                <div class="content">
                    <!-- Nav pills -->
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#ask">
                                أسئلة قيد الإجابة حالياً</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#answer">
                                أسئلة تم الإجابة عليها</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="ask" class=" tab-pane active">
                            <div class="row quesdetails">
                                <div class="col-md-2">رقم</div>
                                <div class="col-md-5">موضوع السؤال</div>
                                <div class="col-md-3 text-center">تاريخ السؤال</div>
                                <div class="col-md-2">حذف</div>
                            </div>
                            @if(count($not_answered_questions) > 0)
                            <table class="table example table-borderless" style="width:100%">
                                <thead style="display:none;">
                                <tr>
                                    <th hidden></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($not_answered_questions as $question)
                                    <tr>
                                        <td hidden></td>
                                        <td>
                                            <div class="allques">
                                                <div class="row quesdetailsans">
                                                    <div class="col-md-2 d-center pigmartop">{{ $question->id }}</div>
                                                    <div class="col-md-5 d-center pigmartop">{{ $question->mini_question }}</div>
                                                    <div class="col-md-3 text-center d-center pigmartop"> <i class="fas fa-calendar-alt"></i>
                                                        {{  Carbon\Carbon::parse($question->created_at)->format('d-m-Y') }}
                                                    </div>
                                                    <div class="col-md-2 text-center d-center pigmartop"><h4 class="m-0"><span class="badge"></span></h4>
                                                    </div>
                                                </div>
                                                <div class="row quesmoredetails">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-8  questext d-center pigmartop">{{ $question->question }}</div>
                                                    <div class="col-md-2  text-center trash">
                                                        <a title="" onclick="return false;" object_id="{{ $question->id }}"
                                                           delete_url="/delete/question/" class="edit-btn-table remove-alert" href="#">
                                                            <i class="fas fa-trash-alt"></i>
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
                                        لا يوجد اسئلة قيد الاجابة....
                                    </h3>
                                </div>
                            @endif
                        </div>
                        <div id="answer" class=" tab-pane fade">

                            <div class="row quesdetails">
                                <div class="col-md-2">رقم</div>
                                <div class="col-md-5">موضوع السؤال</div>
                                <div class="col-md-3 text-center">تاريخ الاجابة</div>
                                <div class="col-md-2">التعليقات</div>
                            </div>
                            @if(count($answered_questions) > 0)
                            <table class="table example table-borderless" style="width:100%">
                                <thead style="display:none;">
                                <tr>
                                    <th hidden></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($answered_questions as $question)
                                    <tr>
                                        <td hidden></td>
                                        <td>
                                            <div class="allques">
                                                <div class="row quesdetailsans">
                                                    <div class="col-md-2 d-center pigmartop">{{ $question->id }}</div>
                                                    <div class="col-md-5 d-center pigmartop">
                                                        <a href="{{ route('question.show' , $question->slug) }}">
                                                            {{ $question->mini_question }}
                                                        </a>
                                                    </div>
                                                    <div class="col-md-3 text-center d-center pigmartop"> <i class="fas fa-calendar-alt"></i>
                                                        {{  Carbon\Carbon::parse($question->answered_date)->format('d-m-Y') }}
                                                    </div>
                                                    <div class="col-md-2 text-center d-center pigmartop">
                                                        <h4 class="m-0">
                                                            <span class="badge">
                                                                {{ count($question->comments) }}
                                                            </span>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="row quesmoredetails">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-8  questext d-center pigmartop">
                                                        {{ $question->question }}
                                                    </div>
                                                    <div class="col-md-2  text-center trash">
                                                        <a title="" onclick="return false;" object_id="{{ $question->id }}"
                                                           delete_url="/delete/question/" class="edit-btn-table remove-alert" href="#">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                @if(count($question->comments) > 0)
                                                    <div class="anscomment">
                                                        <h3 class="commenttitle">
                                                            التعليقات على السؤال
                                                        </h3>
                                                        @foreach($question->comments as $comment)
                                                            <p class="textcomment">
                                                            {{ $comment->comment }}
                                                            @if(!$loop->last)
                                                                <hr>
                                                                @endif
                                                                </p>
                                                                @endforeach
                                                    </div>
                                                @endif
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
                                        لا يوجد اسئلة تم الاجابة عليها ....
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
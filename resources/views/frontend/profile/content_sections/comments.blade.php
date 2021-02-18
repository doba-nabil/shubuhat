<div id="comments" class="tabcontent">
    <div class="tabs">
        <div class="container">
            <div class="title">
                <h4 class="sectiontitle mb-5">
                    تعليقاتي
                </h4>
            </div>
            <div class="alltabs">
                <div class="content">
                    <div class="tab-content">
                        <div class=" tab-pane active">
                            <div class="row quesdetails">
                                <div class="col-md-2"> رقم السؤال</div>
                                <div class="col-md-5">موضوع السؤال</div>
                                <div class="col-md-3 text-center">تاريخ التعليق</div>
                                <div class="col-md-2">حذف</div>
                            </div>
                            @if(count($comments) > 0)
                            <table class="table example table-borderless" style="width:100%">
                                <thead style="display:none;">
                                <tr>
                                    <th hidden></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $comment)
                                    <tr>
                                        <td hidden></td>
                                        <td>
                                            <div class="allques">
                                                <div class="row quesdetailsans">
                                                    <div class="col-md-2 d-center pigmartop">{{ $comment->question->id }}</div>
                                                    <div class="col-md-5 d-center pigmartop">{{ $comment->question->mini_question }}</div>
                                                    <div class="col-md-3 text-center d-center pigmartop"> <i class="fas fa-calendar-alt"></i>
                                                        {{  Carbon\Carbon::parse($comment->created_at)->format('d-m-Y') }}
                                                    </div>
                                                    <div class="col-md-2 text-center d-center pigmartop"><h4 class="m-0"><span class="badge"></span></h4>
                                                    </div>
                                                </div>
                                                <div class="row quesmoredetails">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-8  questext d-center pigmartop">التعليق : {{ $comment->comment }}</div>
                                                    <div class="col-md-2  text-center trash">
                                                        <a title="" onclick="return false;" object_id="{{ $comment->id }}"
                                                           delete_url="/delete/comment/" class="edit-btn-table remove-alert" href="#">
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
                                        لم تقم بإضافة تعليق بعد ....
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
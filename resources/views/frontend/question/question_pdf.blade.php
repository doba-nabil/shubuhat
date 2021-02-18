<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="rtl" lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
         body, *{
            direction: rtl;
             font-family: DejaVu Sans, sans-serif;
             text-align: right;
        }
        body{
            background-color: #F6FAFB;
        }
        .total-artical{
            border: 3px solid #4699B7;
            border-radius: 5px;
            padding: 0px 20px;
        }
        @page{
            size:A4;
            text-align:center;
        }
        @page p{
            margin-right:0px;
            text-align:center;
        }
    </style>
    <title>الشبهات سؤال وجواب</title>
</head>
<body>
<div class="total-artical">
    <div class="sobts">
        <div class="shobohat mb-5">
            <div class="container">
                <div class="allshobohat">
                    <div class="download-share d-colm">
                        <div class="textans textansmine">
                            <p> ملخص السؤال :  {{ $question->mini_question }}</p>
                            <br>
                            <p>  السؤال   {{ $question->question }} :</p>
                            <hr>
                            <p>الحمد لله</p>
                            @if(!empty($question->mini_answer))
                                <div class="cutans">
                                    <p>ملخص الجواب</p>
                                    <p>
                                        {{ $question->mini_answer }}
                                    </p>
                                </div>
                            @endif
                            <p>نص الجواب</p>
                            @if(count($question->answers) > 1)
                                <a class="btn anaser mb-3" data-toggle="collapse" href="#collapseExample"
                                   role="button"
                                   aria-expanded="false" aria-controls="collapseExample">
                                    <i class="far fa-clone"></i>
                                    العناصر
                                </a>
                              
                                    <p class="card card-body">
                                        @foreach($question->answers as $answer)
                                            <p>{{ $answer->title }}</p>
                                        @endforeach
                                    </p>
                                
                            @endif
                            <hr style="width: 50%">
                            @foreach($question->answers as $answer)
                                <p>{{ $answer->title }}</p>
                                <p>{{ $answer->answer }}</p>
                                @if(!$loop->last)
                                    <hr/>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
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
                            <p>{{ $article->title }}</p>
                            <hr>
                            <p>الحمد لله</p>
                            <br>
                            <p style="direction:ltr;text-align:right">
                                
                                <?php
                                   $body = strip_tags($article->body, '<hr>');
                                ?>
                            {{ $body }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
@extends('frontend.layout.master')
@section('frontend-head')
    <style>
        fieldset {
            border: 1px solid #ccc;
            padding: 15px;
            max-width: 345px;
            background-color: #fff;
            border-radius: 5px;
        }

        section { padding: 0 15px; }

        .CaptchaWrap { position: relative; }
        .CaptchaTxtField {
            border-radius: 5px;
            border: 1px solid #ccc;
            display: block;
            box-sizing: border-box;
        }

        #UserCaptchaCode {
            padding: 15px 10px;
            outline: none;
            font-size: 18px;
            font-weight: normal;
            font-family: 'Open Sans', sans-serif;
            width: 100%;
        }
        #CaptchaImageCode {
            text-align:center;
            margin-top: 15px;
            padding: 0px 0;
            width: 300px;
            overflow: hidden;
        }

        .capcode {
            font-size: 46px;
            display: block;
            -moz-user-select: none;
            -webkit-user-select: none;
            user-select: none;
            cursor: default;
            letter-spacing: 1px;
            color: #ccc;
            font-family: 'Roboto Slab', serif;
            font-weight: 100;
            font-style: italic;
        }

        .ReloadBtn {
            background:url('https://cdn3.iconfinder.com/data/icons/basic-interface/100/update-64.png') left top no-repeat;
            background-size : 100%;
            width: 32px;
            height: 32px;
            border:none;

            position: absolute;
            bottom: 30px;
            left : 310px;
            outline: none;
            cursor: pointer; /**/
        }
        .btnSubmit {
            margin-top: 15px;
            border: 0px;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            background-color: #1285c4;
            color: #fff;
            cursor: pointer;
            width: 100%;
        }

        .error {
            color: red;
            font-size: 12px;
            display: none;
        }
        .success {
            color: green;
            font-size: 18px;
            margin-bottom: 15px;
            display: none;
        }
    </style>
@endsection
@section('pageTitle', 'اتصل بنا')
@section('frontend-main')
    <!--  callus  -->
    <div class="callus">
        <div class="aboutus">
            <div class="container">
                <div class="allaboutus">
                    <div class="title">
                        <h4 class="titleabout">
                            إتصل بنا
                        </h4>
                        <p class="cont">لا يمكن طرح الأسئلة من هذا النموذج</p>
                    </div>
                    <form method="post" action="{{ route('contact_form') }}" id="contact_form" class="formsty">
                        @csrf
                        <div class="form-group">
                            <label for="name">الإسم</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="اسم الراسل">
                        </div>
                        <div class="form-group">
                            <label for="email">البريد الإلكترونى</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="بريد الراسل">
                        </div>
                        <div class="form-group ">
                            <label for="exampleFormControlSelect1">نوع الرسالة</label>
                            <select name="kind" class="form-control form-groupw" id="exampleFormControlSelect1" >
                                <option class="optiondis" value="" disabled selected hidden> أختر نوع الرسالة</option>
                                <option>اقتراحات</option>
                                <option>ملاحظة فنية</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">عنوان الرسالة</label>
                            <input name="title" type="text" class="form-control" id="title" placeholder=" أكتب عنواناً لرسالتك">
                        </div>
                        <div class="form-group">
                            <label for="message">الرسالة</label>
                            <textarea name="message" class="form-control" id="message" cols='3' rows="3" placeholder="اكتب نص الرسالة"></textarea>
                        </div>
                                <span id="SuccessMessage" class="success">
                                    <button class="btn btnformse">إرسال</button>
                                </span>
                        <section>
                            <fieldset>
                                <input type="text" id="UserCaptchaCode" class="CaptchaTxtField" placeholder='قم بإدخال النص بالصورة لاظهار '>
                                <span id="WrongCaptchaError" class="error"></span>
                                <div class='CaptchaWrap'>
                                    <div id="CaptchaImageCode" class="CaptchaTxtField">
                                        <canvas id="CapCode" class="capcode" width="300" height="80"></canvas>
                                    </div>
                                    <input type="button" class="ReloadBtn" onclick='CreateCaptcha();'>
                                </div>
                                <input type="button" class="btnSubmit" onclick="CheckCaptcha();" value="التحقق">
                            </fieldset>
                        </section>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- end callus  -->
@endsection
@section('frontend-footer')
<script>
    $("#contact_form").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            name: {
                required: true,
            },
            title: {
                required: true,
            },
            kind: {
                required: true,
            },
            message: {
                required: true,
            },
        },
        messages:{
            email: {
                required : 'هذا الحقل مطلوب',
                minlength : 'هذا الحقل مطلوب اقل من المسموح',
            },
            name: {
                required : 'هذا الحقل مطلوب',
            },
            title: {
                required : 'هذا الحقل مطلوب',
            },
            kind: {
                required : 'هذا الحقل مطلوب',
            },
            message: {
                required : 'هذا الحقل مطلوب',
            },
        }
    });
</script>
    <script>
        var cd;
        $(function(){
            CreateCaptcha();
        });

        // Create Captcha
        function CreateCaptcha() {
            //$('#InvalidCapthcaError').hide();
            var alpha = new Array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
            var i;
            for (i = 0; i < 6; i++) {
                var a = alpha[Math.floor(Math.random() * alpha.length)];
                var b = alpha[Math.floor(Math.random() * alpha.length)];
                var c = alpha[Math.floor(Math.random() * alpha.length)];
                var d = alpha[Math.floor(Math.random() * alpha.length)];
                var e = alpha[Math.floor(Math.random() * alpha.length)];
                var f = alpha[Math.floor(Math.random() * alpha.length)];
            }
            cd = a + ' ' + b + ' ' + c + ' ' + d + ' ' + e + ' ' + f;
            $('#CaptchaImageCode').empty().append('<canvas id="CapCode" class="capcode" width="300" height="80"></canvas>')
            var c = document.getElementById("CapCode"),
                ctx=c.getContext("2d"),
                x = c.width / 2,
                img = new Image();
            img.src = "https://pixelsharing.files.wordpress.com/2010/11/salvage-tileable-and-seamless-pattern.jpg";
            img.onload = function () {
                var pattern = ctx.createPattern(img, "repeat");
                ctx.fillStyle = pattern;
                ctx.fillRect(0, 0, c.width, c.height);
                ctx.font="46px Roboto Slab";
                ctx.fillStyle = '#ccc';
                ctx.textAlign = 'center';
                ctx.setTransform (1, -0.12, 0, 1, 0, 15);
                ctx.fillText(cd,x,55);
            };
        }
        // Validate Captcha
        function ValidateCaptcha() {
            var string1 = removeSpaces(cd);
            var string2 = removeSpaces($('#UserCaptchaCode').val());
            if (string1 == string2) {
                return true;
            }
            else {
                return false;
            }
        }
        // Remove Spaces
        function removeSpaces(string) {
            return string.split(' ').join('');
        }
        // Check Captcha
        function CheckCaptcha() {
            var result = ValidateCaptcha();
            if( $("#UserCaptchaCode").val() == "" || $("#UserCaptchaCode").val() == null || $("#UserCaptchaCode").val() == "undefined") {
                $('#WrongCaptchaError').text('من فضلك قم بإدخال النص الموضع بالصورة.').show();
                $('#UserCaptchaCode').focus();
            } else {
                if(result == false) {
                    $('#WrongCaptchaError').text('نص خاطئ , يرجى المحاولة مره اخرى.').show();
                    CreateCaptcha();
                    $('#UserCaptchaCode').focus().select();
                }
                else {
                    $('#UserCaptchaCode').val('').attr('place-holder','قم بإدخال النص بالصورة');
                    CreateCaptcha();
                    $('#WrongCaptchaError').fadeOut(100);
                    $('#SuccessMessage').fadeIn(500).css('display','block').delay(5000).fadeOut(250);
                    $('section').fadeOut(500).css('display','block').delay(5000).fadeIn(250);
                }
            }
        }
    </script>
@endsection
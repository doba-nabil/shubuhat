<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="so2al  , shobohat">
    <meta name="author" content="doba nabil , shobohat , so2l , quraan">
    <title>تسجيل الدخول  الى لوحة تحكم الشبهات</title>
    <link rel="icon" href="{{ asset('backend') }}/app-assets/images/pages/i-icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <link href="{{ asset('backend/mine.css') }}" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<section class="login">
    <div class="container" style="height: 100%">
        <div class="row" style="height: 100%">
            <div class="col-md-4" style="height: 100%">
                <div class="login-section text-center">
                    <img class="mb-3" src="{{ asset('backend') }}/app-assets/images/pages/logo-b.png">
                    <h1>اهلا بك  </h1>
                    <h2>يرجى مـلء الحقول لزيارة لوحة التحكم</h2>
                    @include('common.errors')
                    <form method="POST" action="{{ route('backendLogin') }}">
                        {{ csrf_field() }}
                        <input id="email" name="email" type="email" placeholder="البريد الإلكتروني">
                        <input id="password" name="password" type="password" placeholder="الرقم السري ">
                        <input type="submit" value="تسجيل الدخول" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>

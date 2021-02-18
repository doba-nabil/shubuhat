<div class="tophead">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="socialhead d-center">
                    @if(!empty($option->facebook))
                        <a href="{{ $option->facebook }}"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if(!empty($option->twitter))
                        <a href="{{ $option->twitter }}"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if(!empty($option->youtube))
                        <a href="{{ $option->youtube }}"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if(!empty($option->insta))
                        <a href="{{ $option->insta }}"><i class="fab fa-instagram"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-md-4 minimartop">
                <div class="datehead text-center d-flex align-items-center justify-content-center ">
                    <p>
                        {{ $date }}
                    </p>
                </div>
            </div>
            @auth()
                <div class="col-md-4 d-center minimartop">
                    <div class="accounthead d-center">
                        <div class="dropdown ">
                            <button class="dropbtn ">
                                {{ Auth::user()->name }}
                                <i class="fas fa-user-circle"></i>
                            </button>
                            <div class="dropdown-content">
                                <a href="{{ route('profile') }}">
                                    <i class="fas fa-user"></i>
                                    بياناتى الشخصية
                                </a>
                                <a title="تسجيل الخروج" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    تسجيل الخروج
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-4 d-center minimartop">
                    <div class="accounthead d-center">
                        <div class="dropdown">
                            <button class="dropbtn w-100 h-100">
                                تسجيل الدخول <i class="fas fa-user-circle"></i>
                            </button>
                            <div class="dropdown-content">
                                <a>
                                    <i class="fas fa-user"></i>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn" data-toggle="modal"
                                            data-target="#exampleModalCenter1">
                                        تسجيل الدخول
                                    </button>
                                </a>
                                <a>
                                    <i class="fas fa-question"></i>
                                    <button type="button" class="btn" data-toggle="modal"
                                            data-target="#exampleModalCenter2">
                                        انشاء حساب
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal register-->
                <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">تسجيل الدخول</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="loginform">
                                    <div class="top">
                                        <div class="textfo">
                                            <h3>أهلاً بعودتك</h3>
                                            <p>قم بتسجيل الدخول لموقع شبهات</p>
                                        </div>
                                        <img src="{{ asset('frontend') }}/img/Image 10.png" alt="banner">
                                    </div>
                                    <div class="logformsty">
                                        <img src="{{ asset('frontend') }}/img/222.png" alt="logo">
                                        <form method="POST" action="{{ route('login') }}" class="login_form">
                                            @csrf
                                            <div class="form-group">
                                                <label for="email">البريد الإلكترونى</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ old('email') }}" required autocomplete="email"
                                                       placeholder="Admin@engaz.com">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="pass">كلمة المرور </label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                       name="password" required autocomplete="current-password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="gridCheck">
                                                            تذكرنى
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn loginfornsty">تسجيل الدخول</button>
                                                </div>
                                            </div>
                                        </form>
                                        {{--<h2 class="or"><span class="orspan">او</span></h2>--}}
                                        {{--<div class="login-box">--}}
                                            {{--<a href="#" class="social-button" id="facebook-connect"> <span>قم بتسجيل الدخول عن طريق فيسبوك</span></a>--}}
                                            {{--<a href="#" class="social-button" id="google-connect"> <span>قم بتسجيل الدخول عن طريق جوجل</span></a>--}}
                                        {{--</div>--}}

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <!-- Modal login-->
                <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">تسجيل جديد </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="loginform">
                                    <div class="top">
                                        <div class="textfo">
                                            <p>قم بانشاء حساب لموقع شبهات</p>
                                        </div>
                                        <img src="{{ asset('frontend') }}/img/Image 10.png" alt="banner">
                                    </div>
                                    <div class="logformsty">
                                        <img src="{{ asset('frontend') }}/img/222.png" alt="logo">
                                        <form method="POST" action="{{ route('register') }}" class="register_form">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">اسم المستخدم</label>
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required >
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email2">البريد الإلكترونى</label>
                                                <input id="email2" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password2">كلمة المرور </label>
                                                <input id="password2" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password-confirm">اعادة كلمة المرور</label>
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                                                        <label class="form-check-label" for="gridCheck1">
                                                            تذكرنى
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn loginfornsty">تسجيل الدخول</button>
                                                </div>
                                            </div>
                                        </form>
                                        {{--<h2 class="or"><span class="orspan">او</span></h2>--}}
                                        {{--<div class="login-box">--}}
                                            {{--<a href="#" class="social-button" id="facebook-connect"> <span>قم بتسجيل الدخول عن طريق فيسبوك</span></a>--}}
                                            {{--<a href="#" class="social-button" id="google-connect"> <span>قم بتسجيل الدخول عن طريق جوجل</span></a>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
            @endauth
        </div>
    </div>
</div>
<!-- end top head  -->
<div id="fady"></div>
<!-- navbar  -->
<div id="navbar" class="mainnavbar">
    <div class="container container1">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('frontend') }}/img/لوجو الشبهات.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link hvr-underline-from-center" href="/">
                            <i class="fas fa-home"></i>
                            الرئيسية
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link hvr-underline-from-center" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-list"></i>
                            التصنيفات
                            <i class="fas fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($categories as $category)
                                <a class="dropdown-item" href="{{ route('category.show' , $category->slug) }}">{{ $category->title }}</a>
                            @endforeach
                            <a class="dropdown-item" href="{{ route('category.index') }}">جميع التصنيفات ....</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <i class="fas fa-place-of-worship"></i>
                        <a class="nav-link hvr-underline-from-center" href="{{ route('question.index') }}">الشبهات</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link hvr-underline-from-center" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-images"></i>
                            مكتبة الوسائط
                            <i class="fas fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('video.index') }}"> فيديوهات</a>
                            <a class="dropdown-item" href="{{ route('audio.index') }}"> صوتيات</a>
                            <a class="dropdown-item" href="{{ route('book.index') }}"> كتب</a>
                            <a class="dropdown-item" href="{{ route('article.index') }}"> مقالات</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <i class="far fa-copy"></i>
                        <a class="nav-link hvr-underline-from-center" href="{{ route('folder.index') }}">ملفات متنوعة</a>
                    </li>
                    <li class="nav-item">
                        <i class="fas fa-question-circle"></i>
                        <a class="nav-link hvr-underline-from-center" href="{{ url('page/about-us') }}">من نحن</a>
                    </li>
                    <li class="nav-item">
                        @auth
                        <a class="nav-link hvr-underline-from-center" href="{{ route('profile') }}">
                            <i class="fas fa-question-circle"></i>
                            أرسل سؤال</a>
                        @else
                            <a style="cursor: pointer" class="nav-link hvr-underline-from-center" data-toggle="modal"
                               data-target="#exampleModalCenter1">
                                <i class="fas fa-question-circle"></i>
                                أرسل سؤال</a>
                        @endauth
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hvr-underline-from-center" href="{{ route('contact_page') }}">
                            <i class="fas fa-phone-alt"></i>
                            إتصل بنا</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- end navbar  -->
<!-- messages -->
<div class="messages">
    @include('common.done_frontend')
    @include('common.errors_frontend')
</div>
<!-- end messages  -->


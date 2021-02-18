@extends('frontend.layout.master')
@section('frontend-head')
@endsection
@section('pageTitle', ' تسجيل جديد')
@section('frontend-main')
    <!--  callus  -->
    <div class="callus">
        <div class="aboutus">
            <div class="container">
                <div  style="width:100%" class="loginform">
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
        </div>
    </div>
    <!-- end callus  -->
@endsection

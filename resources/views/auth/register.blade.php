@extends('frontend.layout.master')
@section('frontend-head')
@endsection
@section('pageTitle', ' تسجيل جديد')
@section('frontend-main')
    <!--  callus  -->
    <div class="callus">
        <div class="aboutus">
            <div class="container">
                <div style="width:100%" class="loginform">
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
        </div>
    </div>
    <!-- end callus  -->
@endsection

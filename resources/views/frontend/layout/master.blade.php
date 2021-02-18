<!DOCTYPE html>
<html lang="ar">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('frontend.layout.head')
    <title>{{ $option->title }} - @yield('pageTitle')</title>
</head>
<body>
<!-- end navbar  -->
@include('frontend.layout.header')
<input type="hidden" value="{{URL::to('/')}}" id="base_url">
@section('frontend-main')

@show
@guest()
    <!-- login to like Modal -->
    <div class="modal fade" id="like" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="fas fa-exclamation-triangle fa-8x mb-4"></i>
                    <h3 class="text-danger mb-4">
                        يرجى التسجيل اولا لاضافة
                        {{ Request::is('question*')? 'تعليق....': 'الشبهة الى المفضلة....' }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal --}}
@endguest

@include('frontend.layout.footer')
</body>
</html>
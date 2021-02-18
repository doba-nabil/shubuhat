@extends('frontend.layout.master')
@section('frontend-head')
@endsection
@section('pageTitle', 'الملف الشخصي')
@section('frontend-main')
    <div class="clearfix"></div>
    <!-- maintab -->
    <div class="maintab my-5">
        <div class="container condf">
            <div class="titlemaintab mb-5">
                <h4 class="titleabout">
                    الملف الشخصي
                </h4>
                <p class="cont">مرحباً بك {{ $user->name }}</p>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="mainacc d-flex align-items-center">
                        <i class="fas fa-user-circle"></i>
                        <p>حسابى</p>
                    </div>
                </div>
            </div>
            <div style="width: 100%;" class="row rowresp">
                <div class="col-md-4">
                    @include('frontend.profile.tabs')
                </div>
                <div class="main-tab-content col-md-8">
                   @include('frontend.profile.content_sections.edit_profile')
                   @include('frontend.profile.content_sections.comments')
                   @include('frontend.profile.content_sections.favourite')
                   @include('frontend.profile.content_sections.question')
                   @include('frontend.profile.content_sections.send_question')
                </div>
            </div>
        </div>
    </div>
    <!-- end maintab -->
    <div class="clearfix"></div>
@endsection
@section('frontend-footer')

@endsection
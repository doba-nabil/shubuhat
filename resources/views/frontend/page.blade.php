@extends('frontend.layout.master')
@section('frontend-head')
@endsection
@section('pageTitle', $page->title)
@section('frontend-main')
    <!--  aboutus  -->
    <div class="aboutus">
        <div class="container">
            <div class="allaboutus">
                <div class="title">
                    <h4 class="titleabout">
                        {{ $page->title }}
                    </h4>
                </div>
                <div class="totalaboutus text-center">
                    @if(isset($page->mainImage->image))
                        <div class="aboutimg text-center">
                            <img src="{{ asset('pictures/pages/' . $page->mainImage->image) }}"
                                 alt="{{ $page->title }}">
                        </div>
                    @endif
                    <div class="abouttext">
                        <p>
                            <?php echo htmlspecialchars_decode($page->text) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end shobohat  -->
@endsection
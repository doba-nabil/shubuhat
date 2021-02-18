@extends('frontend.layout.master')
@section('pageTitle', 'المقالات')
@section('frontend-main')
    <!-- tabs  -->
    <div class="tabs">
        <div class="container">

            <div class="title">
                <h4 class="sectiontitle mb-5">
                    المقالات
                </h4>
            </div>
            <div class="alltabs">
                <div class="content">
                    <div class="tab-content">
                        <div id="artical" class=" tab-pane active">
                            <table id="example" class="table  table-borderless">
                                <thead style="display:none;">
                                <tr>
                                    <th hidden></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($articles as $article)
                                    <tr>
                                        <td hidden></td>
                                        <td>
                                            <div class="allvideo d-colm">
                                                <div class="rightsec d-colm">
                                                    <div class="secimg">
                                                        @if(isset($article->mainImage->image))
                                                            <img src="{{ asset('pictures/media/' . $article->mainImage->image) }}"
                                                                 alt="{{ $article->title }}">
                                                        @else
                                                            <img src="{{ asset('frontend/img/empty.png') }}" alt="" />
                                                        @endif

                                                    </div>
                                                    <div class="viddeta d-colm">
                                                        <p class="namev">{{ $article->title }}</p>
                                                        <p class="catv">{{ $article->category->title }}</p>
                                                        <p class="timev">{{  Carbon\Carbon::parse($article->created_at)->format('d-m-Y') }}</p>
                                                    </div>
                                                </div>
                                                <div class="leftsec">
                                                    <a href="{{ route('article.show' , $article->slug) }}" type="button" class="btn shahed">
                                                        تصفح
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ens tabs  -->
@endsection
@section('frontend-footer')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "language": {
                    "url": "{{ asset('frontend/js/ar_table.json') }}"
                }
            });
        });
    </script>
@endsection
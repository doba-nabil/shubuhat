@extends('frontend.layout.master')
@section('frontend-head')
@endsection
@section('pageTitle', 'الملفات المتنوعة')
@section('frontend-main')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 my-3">
                <div class="pull-right my-5">
                    <div class="btn-group">
                        <h4>ملفات متنوعة</h4>
                        <div class="listgridbtnres">
                            <button class="btn" id="list">
                                <i class="fas fa-list"></i>
                            </button>
                            <button class="btn " id="grid">
                                <i class="fas fa-th"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="products" class="row view-group folders-doba">
            @include('frontend.folder.pagination_data')
        </div>
    </div>
@endsection
@section('frontend-footer')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });
            function fetch_data(page)
            {
                $.ajax({
                    url:"/pagination/folders?page="+page,
                    success:function(data)
                    {
                        $('#products').html(data);
                    }
                });
            }
        });
    </script>
@endsection
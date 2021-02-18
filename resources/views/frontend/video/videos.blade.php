@extends('frontend.layout.master')
@section('pageTitle', 'المقالات')
@section('frontend-main')
    <!-- tabs  -->
    <div class="tabs">
        <div class="container">
            <div class="title">
                <h4 class="sectiontitle mb-5">
                    الفيديوهات
                </h4>
            </div>
            <div class="alltabs">
                <div class="content">
                    <div class="tab-content">
                        <div id="vdio" class=" tab-pane active">
                            <table id="example" class="table  table-borderless" style="width:100%">
                                <thead style="display:none;">
                                <tr>
                                    <th hidden></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($videos as $video)
                                    <tr>
                                        <td hidden></td>
                                        <td>
                                            <div class="allvideo d-colm">
                                                <div class="rightsec d-colm">
                                                    <div class="secimg d-center">
                                                        @if(isset($video->mainImage->image))
                                                            <img src="{{ asset('pictures/media/' . $video->mainImage->image) ?? '--' }}"
                                                                 alt="{{ $video->title }}">
                                                        @else
                                                            <img src="{{ asset('frontend/img/empty.png') }}" alt="" />
                                                        @endif
                                                        <div class="overlaysec"><i class="far fa-play-circle"></i></div>
                                                    </div>
                                                    <div class="viddeta d-colm">
                                                        <p class="namev">{{ $video->title }}</p>
                                                        <p class="catv">{{ $video->category->title ?? '' }}</p>
                                                        <p class="timev">{{  Carbon\Carbon::parse($video->created_at)->format('d-m-Y') }}</p>
                                                    </div>
                                                </div>
                                                <div class="leftsec">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn shahed" data-toggle="modal"
                                                            data-target="#video_modal{{ $loop->index + 1 }}">
                                                        مشاهدة
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="video_modal{{ $loop->index + 1 }}"
                                                         tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                                        مشاهدة الفيديو</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    @if(isset($video->file->file))
                                                                        <video width="420" height="340" controls>
                                                                            <source src="{{ asset('pictures/video/' . $video->file->file) }}">
                                                                        </video>
                                                                    @endif
                                                                    @if($video->file->link)
                                                                            <?php
                                                                            $string     =  $video->file->link ;
                                                                            $search     = '/youtube\.com\/watch\?v=([a-zA-Z0-9]+)/smi';
                                                                            $replace    = "youtube.com/embed/$1";
                                                                            $url = preg_replace($search,$replace,$string);
                                                                            ?>
                                                                        <iframe style="width: 100%"
                                                                                src='{{ $url }}?modestbranding=1'
                                                                                allowfullscreen>
                                                                        </iframe>
                                                                    @endif
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">اغلاق
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
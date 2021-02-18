@extends('frontend.layout.master')
@section('pageTitle', 'الصوتيات')
@section('frontend-main')
    <!-- tabs  -->
    <div class="tabs">
        <div class="container">
            <div class="title">
                <h4 class="sectiontitle mb-5">
                    الصوتيات
                </h4>
            </div>
            <div class="alltabs">
                <div class="content">
                    <div class="tab-content">
                        <div id="record" class=" tab-pane active">
                        <table id="example" class="table  table-borderless" style="width:100%">
                            <thead style="display:none;">
                            <tr>
                                <th hidden></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($audios as $audio)
                                <tr>
                                    <td hidden></td>
                                    <td>
                                        <div class="allaudio @if(empty($audio->file->file)) allvideo @endif">
                                            <h4 @if(empty($audio->file->file)) class="text-center" @endif>
                                                {{ $audio->title }}
                                                @if(empty($audio->file->file))
                                                    <img class="" width="120px"
                                                         src="{{ asset('frontend/img/sound.png') }}">
                                                @endif
                                            </h4>
                                            <p class="adiotext">{{ $audio->subtitle }}</p>
                                        @if(!empty($audio->file->file))
                                                <div class="ready-player-{{ $audio->id }}">
                                                    <audio>
                                                        <source src="{{ asset('pictures/audio/' . $audio->file->file) }}">
                                                    </audio>
                                                </div>
                                            @else
                                                <div class="modal fade" id="exampleModalCenter{{ $audio->slug }}"
                                                     tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="exampleModalLongTitle">{{ $audio->title }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <div>
                                                                    {!! $audio->file->link !!}
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">اغلاق
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="leftsec">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn shahed" data-toggle="modal"
                                                            data-target="#exampleModalCenter{{ $audio->slug }}">
                                                        استماع
                                                    </button>
                                                </div>
                                            @endif
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
    @foreach($audios as $audio)
        @if(!empty($audio->file->file))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    new GreenAudioPlayer('.ready-player-{{ $audio->id }}', { showTooltips: true, showDownloadButton: false, enableKeystrokes: true });
                });
            </script>
        @endif
    @endforeach
@endsection
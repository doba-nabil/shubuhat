@if(count($data) > 0)
    @foreach($data as $folder)
<div class="item col-xs-4 col-lg-4">
    <a href="{{ route('folder.show' , $folder->slug) }}">
        <div class="thumbnail card">
            <div class="img-event">
                @if(isset( $folder->mainImage->image))
                    <img class="group image  list-group-image img-fluid" src="{{ asset('pictures/folders/' . $folder->mainImage->image) }}" alt="{{ $folder->title }}">
                @else
                    <img class="group image  list-group-image img-fluid" src="{{ asset('frontend/img/empty.png') }}" alt="" />
                @endif
            </div>
            <div class="caption card-body">
                <h4 class="group group1 card-title inner list-group-item-heading list-group-item-heading2">
                    {{ $folder->title }}</h4>
                <p class="group group2 inner list-group-item-text list-group-item2">
                    {{ $folder->body }}
                </p>
            </div>
        </div>
    </a>
</div>
    @endforeach
    <div class="col-md-12 text-center mt-5">
        <div style="display: inline-block">
            {!! $data->links() !!}
        </div>
    </div>
@else
    <div class="col-md-12">
        <br>
        <div class="alert alert-warning text-center">
            <h3>
                لا يوجد ملفات متنوعة....
            </h3>
        </div>
    </div>
@endif


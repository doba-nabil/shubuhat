@foreach($subcategories as $subcategory)
    <tr data-id="{{$subcategory->id}}" data-parent="{{$dataParent}}" data-level = "{{$dataLevel + 1}}">
        <?php
            $margin = $dataLevel * 30;
            $font = 20 - $dataLevel;
        ?>
        <td class="click glyphicon-chevron-right" style="padding-right: {{ $margin }}px!important" data-column="name" onmouseover="openCity(event, '{{ $subcategory->title }}')">
            <i style="font-size: {{$font}}px" class="fas fa-folder-open mr-3"></i>
            <a href="{{ route('category.show' , $subcategory->slug) }}">
                {{$subcategory->title}}
            </a>
            @if(count($subcategory->subCategories))
                <i class="rotate fas fa-angle-left float-right"></i>
            @endif
        </td>
    </tr>
    @if(count($subcategory->subCategories))
        @include('frontend.category.tree',['subcategories' => $subcategory->subCategories, 'dataParent' => $subcategory->id, 'dataLevel' => $dataLevel + 1 ])
    @endif
@endforeach
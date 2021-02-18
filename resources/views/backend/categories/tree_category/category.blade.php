<li title="تعديل التصنيف">
    <a href="{{ route('subcategories.edit' , $child_category->slug) }}"> {{ $child_category->title }}</a>
</li>
@if ($child_category->childrenTree)
    <ul>
        @foreach ($child_category->childrenTree as $childCategory)
            @include('backend.categories.tree_category.category', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif

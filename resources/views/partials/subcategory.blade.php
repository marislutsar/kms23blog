<li>
    <a href="{{route('category', ['category' => $category])}}">{{$category->name}}</a>
    <ul>
        @foreach($category->children as $child)
            @include('partials.subcategory', ['category' => $child])
        @endforeach
    </ul>
</li>

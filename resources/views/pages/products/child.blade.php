<a class="dropdown-item" data-value="{{$childs->id}}" data-level="{{$level}}" href="">{{$childs->name}}</a>

@if($childs->childrenRecursive)
    @foreach($childs->childrenRecursive as $child)
        @include('pages.products.child',['childs'=>$child,'level'=>$level+1])
    @endforeach
@endif

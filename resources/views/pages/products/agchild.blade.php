<li class="fw-medium fs-14"><span><i class="ri-add-circle-fill align-bottom"></i>{{$childs->name}}</span>
@if($childs->childrenRecursive)
    <ul class="te">
    @foreach($childs->childrenRecursive as $child)
        @include('pages.products.agchild',['childs'=>$child])
    @endforeach
    </ul>
@endif
</li>

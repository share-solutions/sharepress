@if($content !== null)
    <h2 class="cpt008 karla karla--e5" style="@if(!!$post) color: {{$post->category->parent_category->cor}} @endif">{{$content}}</h2>
@endif
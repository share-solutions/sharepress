@if(isset($reference) && !!$reference)
    <div class="cpt001 cpt001__horizontal">
        {!! $reference->featuredImage('raw', 'medium', ['class' => 'cpt001__img']) !!}
        <div class="cpt001">
            <p class="cpt001__tag karla karla--e7"><a href="{{$reference->category->permalink}}">{!! $reference->category->name!!}</a></p>
            <h1 class="cpt001__title karla karla--e4"><a href="{{$reference->permalink}}">{{$reference->post_title}}</a></h1>
        </div>
    </div>
    <br/>
@endif
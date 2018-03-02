<div class="cpt001 @if(isset($extraClasses)) {{ $extraClasses }} @endif">
    @if(isset($image))
    <a href="{{ $url }}">
        {!! $image !!}
    </a>
    @endif
    <div class="cpt001__text">
        @if(isset($name))
            <p class="cpt001__name karla karla--e7">{{ $name }}</p>
        @endif
        @if(isset($tag))
                <p class="cpt001__tag karla @if(isset($sponsor)) karla--white @endif karla--e7"><a href="{{ get_category_link($tag) }}">{!! $tag->name !!}</a></p>
        @endif
        @if(isset($title))
        <h1 class="cpt001__title karla @if(isset($sponsor)) karla--white @endif karla--e5"><a href="{{ $url }}">{{ $title }}</a></h1>
        @endif
        @if(isset($paragraph))
            <p class="cpt001__paragraph playfair @if(isset($sponsor)) playfair--white              @endif playfair--e10">{!! $paragraph !!}</p>
        @endif
        @if(isset($description))
            <p class="cpt001__description playfair playfair--e10">{{ $description }}</p></p>
        @endif
    </div>
</div>
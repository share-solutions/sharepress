<div class="cpt001 cpt001__horizontal @if(isset($extraClasses)) {{ $extraClasses }} @endif">
    @if(isset($isPerson))
    <div class="cpt001__person-mobile">
        @if(isset($image))
            {!! $image !!}
        @endif
        <p class="cpt001__name cpt001__person-mobile-show karla karla--e7">{!! $nameMobile !!}</p>
    </div>
    @else
        @if(isset($image))
            {!! $image !!}
        @endif
    @endif
    <div class="cpt001 @if(isset($contentExtraClasses)) {{ $contentExtraClasses }} @endif">
        @if(isset($name))
        <p class="cpt001__name @if(isset($isPerson)) cpt001__person-mobile-hide @endif karla karla--e7">{{ $name }}</p>
        @endif
        @if(isset($tag))
        <p class="cpt001__tag karla karla--e7">{{ $tag }}</p>
        @endif
        <h1 class="cpt001__title karla karla--e4"><a href="{{ $url }}">{{ $title }}</a></h1>
        @if(isset($paragraph))
            <p class="cpt001__paragraph playfair playfair--e10">{{ $paragraph }}</p>
        @endif
    </div>
</div>
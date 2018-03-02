<div class="cpt004 @if(isset($extraClasses)) {{ $extraClasses }} @endif">
    @if(isset($barTitle) && !empty($barTitle))
        <h1 class="@if(isset($extraHeaderClass)) {{ $extraHeaderClass }} @endif"><span class="cpt004__icon icon-asterisk"></span> {{ $barTitle }} </h1>
    @endif
    @if(isset($blackBar) && !!$blackBar)
        <span class="cpt004__bar @if(isset($extraBarClass)) {{ $extraBarClass }}    @endif"></span>
    @endif
</div>
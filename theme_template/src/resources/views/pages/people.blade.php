@extends('layouts.prevenir-master')
@section('content')
    <div class="specialist col-lg-12">

        <!-- spe001 -->
        <section class="spe001 margin-bottom">
            <div class="cpt006 row">
                <div class="cpt006__img col-sm-12 col-lg-7"></div>
                <div class="cpt006__text cpt006__text--right cpt006__text--bck-especialista cpt006__centered col-sm-12 col-lg-5">
                    @if($isSpecialist)<p class="cpt006__tag karla--white karla--e7">{{__('os nossos especialistas')}}</p>@endif
                    <h1 class="cpt006__title karla--white karla--e3">{{ $person->post_title }}</h1>
                    <p class="cpt006__title playfair--white playfair--e10">{{ $person->post_excerpt }}</p>
                </div>
            </div>
        </section>
        <!-- /spe001 -->

        <!-- spe002 -->
        <section class="spe002 row margin-bottom">
            <div class="spe002__articles col-lg-12">
                @if(isset($contributedPosts) && !!$contributedPosts)
                    <div class="col-lg-4 border-grey-right load-more-template" style="display: none">
                        <div class="cpt001">
                            <div class="img-container"></div>
                            <div class="cpt001__text">
                                <p class="cpt001__tag karla karla--e7"><a href="#"></a></p>
                                <h1 class="cpt001__title karla karla--e4"><a href="#"></a></h1>
                                <p class="cpt001__paragraph playfair playfair--e10"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4" id="load-more-target">
                    @foreach($contributedPosts as $index => $contributedPost)
                        @if($index + 1 % 3 === 0)
                        <div class="col-lg-4">
                        @else
                        <div class="col-lg-4 border-grey-right">
                        @endif
                            <div class="cpt001">
                                <div class="img-container">
                                    {!! $contributedPost->featuredImage('raw', 'medium', ['class' => 'cpt001__img']) !!}
                                </div>
                                <div class="cpt001__text">
                                    <p class="cpt001__tag karla karla--e7"><a href="{{ $contributedPost->category->permalink }}">{!! $contributedPost->category->name !!}</a></p>
                                    <h1 class="cpt001__title karla karla--e4"><a href="{{ $contributedPost->permalink }}">{{ $contributedPost->post_title }}</a></h1>
                                    <p class="cpt001__paragraph playfair playfair--e10">{{ $contributedPost->post_excerpt }}</p>
                                </div>
                            </div>
                        </div>
                        @if($index + 1 % 3 === 0)
                    </div>
                            @if($index + 1 < count($contributedPosts))
                    <div class="row mb-4">
                            @endif
                        @endif
                    @endforeach
                    </div>
                    @if(isset($loadMore) && !!$loadMore)
                    <div class="cpt003 row">
                        <a href="#" class="cpt003__link"
                           data-loadmore-target="#load-more-target"
                           data-loadmore-template=".load-more-template"
                           data-loadmore-handler="{{$ajaxHandler}}"
                           data-loadmore-page="{{$nextPage}}"
                           data-loadmore-params='@json($loadMore)'
                           data-loadmore-nodata=""
                           data-loadmore-showhidecontainer=""
                           data-loadmore-wait="true">{{ __('Carregar mais artigos') }}</a>
                    </div>
                    @endif
                @endif
            </div>
        </section>
        <!-- /spe002 -->

        @if(isset($conselhoCientifico) && !!$conselhoCientifico)
        <!-- spe003 -->
        <section class="spe003 row margin-bottom">
            @include('components.cpt004', [
                   'extraClasses' => 'cpt004--center margin-bottom',
                   'barTitle' => 'o nosso conselho científico',
               ])
            <div class="spe003__articles col-12">
                    @foreach($conselhoCientifico as $conselhoCientificoElement)
                        <div class="cpt001 cpt001__centered">
                            <a href="{{ $conselhoCientificoElement->permalink }}">
                                <img class="cpt001__img--circle" src="{{$conselhoCientificoElement->thumbnail['url']}}">
                            </a>
                            <div class="cpt001">
                                <p class="cpt001__name karla karla--e7">
                                    <a href="{{ $conselhoCientificoElement->permalink }}">
                                        {{ $conselhoCientificoElement->post_title }}
                                    </a>
                                </p>
                                <p class="cpt001__description playfair playfair--e10">{{ $conselhoCientificoElement->descritivo }}</p>
                            </div>
                        </div>
                    @endforeach
            </div>
            <div class="cpt003">
                <a href="" class="cpt003__link">Ver todos</a>
            </div>
        </section>
        <!-- /spe003 -->
        @endif

    </div>
@endsection
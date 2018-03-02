@extends('layouts.prevenir-master')
@section('content')

    @if(isset($categoryPostsTop) && !!$categoryPostsTop)
    <!-- ctg001 -->
    <section class="ctg001">
        <div class="cpt006 row">
            <div class="cpt006__img col-sm-12 col-lg-7" style="background-image: url({{$categoryPostsTop->featured_image_url}});"></div>
            <div class="cpt006__text cpt006__text--right cpt006__centered col-sm-12 col-lg-5" style="background-color: @if(isset($categoryPostsTop->top_category)){{$categoryPostsTop->top_category->cor}}@else #000 @endif">
                {{-- <p class="cpt006__tag karla--white karla--e7">patrocinado por Barral</p> --}}
                <h1 class="cpt006__title karla--white karla--e3"><a href="{{$categoryPostsTop->permalink}}">{{ $categoryPostsTop->post_title }}</a></h1>
                <p class="cpt006__title playfair--white playfair--e10">{{ $categoryPostsTop->split['striped_excerpt'] }}</p>
            </div>
        </div>
    </section>
    <!-- / ctg001 -->
    @endif

    <!-- ctg002 -->
    <section class="ctg002 border-grey-bottom row">
        @if(isset($categoryPostsFirstLine) && !!$categoryPostsFirstLine)
        <div class="ctg002__articles col-lg-8">
            <div class="row">
                @foreach($categoryPostsFirstLine as $item)
                <div class="col-lg-6 border-grey-right">
                    <div class="cpt001">
                        {!! $item->featuredImage('raw', 'full', ['class' => 'cpt001__img']) !!}
                        <div class="cpt001__text">
                            <p class="cpt001__tag karla karla--e7">{!! isset($item->category) ? $item->category->name : "" !!}</p>
                            <h1 class="cpt001__title karla karla--e4"><a href="{{$item->permalink}}">{{ $item->post_title }}</a></h1>
                            <p class="cpt001__paragraph playfair playfair--e10">{!! $item->split['striped_excerpt'] !!}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        <div class="ctg002__ads col-lg-4 d-none d-lg-block">
            <div class="border-grey-bottom" style="height:250px; background-color:gray;"></div>
            @if(isset($mostRead) && !!$mostRead)
                @include('components.cpt004', [
                   'extraClasses' => 'cpt004--center cpt004-alimentacao margin-top margin-bottom',
                   'barTitle' => 'mais lidos',
               ])

            <div class="cpt009 cpt009--black karla karla--e6">
                @foreach($mostRead as $item)
                <div class="cpt009-row">
                    <span>></span><a href="{{$item->permalink}}">{{$item->post_title}}</a>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    <!-- / ctg002 -->

    {{--
    <!-- ctg003 -->
    <section class="ctg003 d-none d-sm-block">
        <div class="cpt006 row">
            <div class="cpt006__text cpt006__text--left cpt006__text--bck-sponsor cpt006__centered col-sm-12 col-lg-5">
                <p class="cpt006__tag karla--white karla--e7">patrocinado por Barral</p>
                <h1 class="cpt006__title karla--white karla--e3">Antibióticos:<br>
                    7 erros comuns</h1>
                <p class="cpt006__title playfair--white playfair--e10">Usar antibióticos de forma desadequada ontribui para o aumento da resistência a estes fármacos, ou seja, tornam-se menos capazes de controlar ou matar bactérias.</p>
            </div>
            <div class="cpt006__img cpt006__img--border-sponsor col-sm-12 col-lg-7">

            </div>
        </div>
    </section>
    <!-- /ctg003 -->
    --}}

    @if(isset($categoryPostsContinuance) && !!$categoryPostsContinuance)
    <!-- ctg004 -->
    <section class="ctg004 row">

        <div class="col-lg-4 border-grey-right load-more-template" style="display: none">
            <div class="cpt001">
                <div class="img-container"></div>
                <div class="cpt001__text">
                    <p class="cpt001__tag karla karla--e7"></p>
                    <h1 class="cpt001__title karla karla--e4"><a href="#"></a></h1>
                    <p class="cpt001__paragraph playfair playfair--e10"></p>
                </div>
            </div>
        </div>

        <div class="ctg004-inner col-12 mb-5">
            <div class="row" id="load-more-target">
                @foreach($categoryPostsContinuance as $item)
                    <div class="col-lg-4 border-grey-right">
                        <div class="cpt001">
                            <div class="img-container">
                                {!! $item->featuredImage('raw', 'medium', ['class' => 'cpt001__img']) !!}
                            </div>
                            <div class="cpt001__text">
                                <p class="cpt001__tag karla karla--e7">{!! isset($item->category) ? $item->category->name : "" !!}</p>
                                <h1 class="cpt001__title karla karla--e4"><a href="{{$item->permalink}}">{{ $item->post_title }}</a></h1>
                                <p class="cpt001__paragraph playfair playfair--e10">{!! $item->split['striped_excerpt'] !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @if(isset($loadMore) && !!$loadMore)
        <div class="cpt003">
            <a href=""
               class="cpt003__link"
               data-loadmore-target="#load-more-target"
               data-loadmore-template=".load-more-template"
               data-loadmore-handler="{{$ajaxHandler}}"
               data-loadmore-page="{{$nextPage}}"
               data-loadmore-params='@json($loadMore)'
               data-loadmore-nodata=""
               data-loadmore-showhidecontainer=""
               data-loadmore-wait="true">Carregar mais Artigos</a>
        </div>
        @endif
    </section>
    <!-- /ctg004 -->
    @endif


@endsection
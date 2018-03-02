@extends('layouts.prevenir-master')
@section('content')
    <div class="row">
        <!-- Recipe Body -->
        <div class="rec001 border-grey-right col-lg-8">
            <div class="rec001-header">
                @include('components.cpt007', [
                    'category' => $post->category,
                    'infos' => $post->infos
                ])
                <h1 class="rec001-header__title karla karla--e2">{!! $post->post_title !!}</h1>
                {!! $post->featuredImage('raw', 'full', [ 'class' => 'rec001-header__img' ]) !!}
            </div>
            <div class="rec001-body__text-inner row">
                @include('components.cpt010', [
                    'imageFacebook' => '<img src="/' . get_stylesheet_directory_uri() . '/build/images/facebook-footer.png" alt="">',
                    'imageTwitter' => '<img src="/' . get_stylesheet_directory_uri() . '/build/images/twitter-footer.png" alt="">',
                    'imageEmail' => '<img src="/' . get_stylesheet_directory_uri() . '/build/images/email.png" alt="">',
                    'imagePrinter' => '<img src="/' . get_stylesheet_directory_uri() . '/build/images/printer.png" alt="">',
                ])
                <article class="rec001-body col-md-11">
                    <div class="rec001-body__headline playfair playfair--e9">
                        {!! $post->split['excerpt'] !!}
                    </div>
                    <div class="art001-body__writers mb-5 pb-3 pt-3 border-grey-bottom">
                        @if(isset($post->autores) && count($post->autores) > 0)
                            @foreach($post->autores as $author)
                                @include('components.cpt017', [
                                    'image' => '<img class="cpt017__img" src="' . $author->thumbnail['url'] . '" alt="">',
                                    'title' => 'Autoria',
                                    'name' => $author->post_title,
                                    'description' => $author->post_excerpt,
                                    'url' => $author->permalink,
                                ])
                            @endforeach
                        @endif
                        @if(isset($post->colaboradores) && count($post->colaboradores) > 0)
                            @foreach($post->colaboradores as $colaborator)
                                @include('components.cpt017', [
                                    'image' => '<img class="cpt017__img" src="' . $colaborator->thumbnail['url'] . '" alt="">',
                                    'title' => 'Colaboração',
                                    'name' => $colaborator->post_title,
                                    'description' => $colaborator->post_excerpt,
                                    'url' => $colaborator->permalink,
                                ])
                            @endforeach
                        @endif
                    </div>
                    @include('components.cpt016', [
                        'extraClasses' => 'cpt016 d-block d-lg-none',
                        'ingredientsTitle' => __('ingredientes'),
                        'ingredients' => $post->ingredients
                    ])

                    @include('components.cpt013', [
                        'instructionsTitle' => __('Modo de preparação'),
                        'instructions' => $post->modo_de_preparacao
                    ])

                    <div class="rec001-body__content">
                        {!! wpautop($post->split['content']) !!}
                    </div>

                    @include('components.cpt015', [
                        'extraClassesMobile' => 'd-block d-lg-none',
                        'nutritionTitle' => __('tabela nutricional'),
                        'nutritionalTable' => $post->tabela_nutricional
                    ])

                    @if(isset($post->tags) && !!$post->tags)
                    <div class="rec001-body__tags">
                        <p>{{ __('Mais sobre') }}:</p>
                            @foreach($post->tags as $tag)
                                <a href="{{ $tag->permalink }}">{{ $tag->name }}</a>
                            @endforeach
                    </div>
                    @endif

                </article>
            </div>
        </div>
        <!-- / Recipe Body-->

        <!-- Sidebar -->
        <div class="rec002 col-lg-4">
            <div class="rec002-inner">
                <div class="d-none d-lg-block"
                     style="margin: 0 30px 30px 30px; width:300px; height:250px; background-color:#7d7d7d;"></div>
                @include('components.cpt016', [
                    'extraClasses' => 'cpt016 d-none d-lg-block',
                    'ingredientsTitle' => __('ingredientes'),
                    'ingredients' => $post->ingredients
                ])
                @include('components.cpt015', [
                    'extraClassesDesktop' => 'd-none d-lg-block',
                    'nutritionTitle' => __('tabela nutricional'),
                    'nutritionalTable' => $post->tabela_nutricional
                ])
            </div>
            <div class="cpt011">
                @if(isset($directionalPosts['prev']) && !!$directionalPosts['prev'])
                    <div class="cpt011__prev">
                        <a href="{{ $directionalPosts['prev']->permalink }}">
                            <h3 class="karla karla--e8"><i class="fa fa-long-arrow-left"></i> {{ __('Anterior') }}</h3>
                            <h2 class="karla karla--e4">{{ $directionalPosts['prev']->post_title }}</h2>

                        </a>
                    </div>
                @endif
                @if(isset($directionalPosts['next']) && !!$directionalPosts['next'])
                    <div class="cpt011__next">
                        <a href="{{ $directionalPosts['next']->permalink }}">
                            <h3 class="karla karla--e8">{{ __('Seguinte') }} <i class="fa fa-long-arrow-right"></i></h3>
                            <h2 class="karla karla--e4">{{ $directionalPosts['next']->post_title }}</h2>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- /Sidebar -->
    </div>

    @section('related-posts')
        <!-- Artigos Recomendados -->
        <section class="art003 row">
            @include('components.cpt004', [
                'extraClasses' => 'cpt004--center margin-bottom',
                'barTitle' => 'artigos recomendados',
            ])
            <div class="art003-inner col-12">
                <div class="row">
                    @foreach($post->tag_related_through as $relatedPost)
                        <div class="cpt001 col-lg-4">
                            {!! $relatedPost->featuredImage('raw', 'medium', ['class' => 'cpt001__img']) !!}
                            <div class="cpt001__text">
                                <p class="cpt001__tag karla karla--e7">{!! $relatedPost->category->name !!}</p>
                                <h1 class="cpt001__title karla karla--e4"><a href="{{ $relatedPost->permalink }}">{{ $relatedPost->post_title }}</a>
                                </h1>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- /Artigos Recomendados-->
    @endsection

@endsection
@extends('layouts.prevenir-master')
@section('content')
    <div class="row">
        <!-- Article Body -->
        @if(!$post->is_sponsored)
        <div class="art001 border-grey-right col-lg-8">
        @else
        <div class="art001 col-lg-8 col-12 offset-lg-2 offset-0 border-0">
        @endif
            <div class="art001-header">
                <div class="cpt007 karla karla--e7">
                    @if($post->is_sponsored)
                    <div>
                        <img src="{{ $post->sponsor_image['sizes']['thumbnail'] }}" alt="{{ $post->sponsor_image['title'] }}"/>
                        <span>{{ $post->sponsor_name }}</span>
                    </div>
                    @endif
                    @if(isset($post->categories_hierarchy) && !!$post->categories_hierarchy)
                    <div class="cpt007__art cpt007__art-beleza">
                        @foreach($post->categories_hierarchy as $index => $category)
                        <a href="{{$category->permalink}}">{!! $category->name !!} </a> @if($index !== count($post->categories_hierarchy) - 1) <span>></span> @endif
                        @endforeach
                    </div>
                    @endif
                    @if(isset($post->tempo_leitura))<p class="cpt007__art-info">Tempo de Leitura: {{$post->tempo_leitura}}.</p>@endif
                </div>
                <h1 class="art001-header__title karla karla--e2">{{ $post->post_title }}</h1>
                {!! $post->featuredImage('raw', 'full', ['class' => 'art001-header__img']) !!}
            </div>
            <div class="art001-body__text-inner row">
                @include('components.cpt010', [
                    'imageFacebook' => '<img src="/' . get_stylesheet_directory_uri() . '/build/images/facebook-footer.png" alt="">',
                    'imageTwitter' => '<img src="/' . get_stylesheet_directory_uri() . '/build/images/twitter-footer.png" alt="">',
                    'imageEmail' => '<img src="/' . get_stylesheet_directory_uri() . '/build/images/email.png" alt="">',
                    'imagePrinter' => '<img src="/' . get_stylesheet_directory_uri() . '/build/images/printer.png" alt="">',

                ])
                <article class="art001-body col-md-11">
                    <div class="art001-body__headline playfair playfair--e9 border-grey-bottom">
                        {!! $post->split['excerpt'] !!}
                    </div>
                    <div class="art001-body__writers mb-5 pb-3 pt-3 border-grey-bottom">
                        @if(isset($post->autores) && !!$post->autores)
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
                        @if(isset($post->colaboradores) && !!$post->colaboradores)
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

                    <div class="article-content art001-body__text playfair playfair--e10">
                        {!! $post->split['content'] !!}
                    </div>

                    @if(!!$post->ultima_revisao)
                        <div>
                            Última revisão: {{$post->ultima_revisao}}
                        </div>
                    @endif


                    @if(isset($post->tags) && !!$post->tags)
                        <div class="art001-body__tags">
                            <p>{{ __('Mais sobre') }}:</p>
                            @foreach($post->tags as $tag)
                                <a href="{{ $tag->permalink }}">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    @endif
                </article>
            </div>
        </div>
        <!-- / Article Body-->

        @if(!$post->is_sponsored)
        <!-- Sidebar -->
        <div class="art002 col-lg-4">
            @if(isset($mostRead) && !!$mostRead)
            <div class="art002-inner">
                <div class="cpt004 cpt004--center margin-top margin-bottom">
                    <h1><span class="cpt004__icon icon-asterisk"></span>{{ __('mais populares') }}</h1>
                </div>
                @foreach($mostRead as $item)
                    <div class="cpt001__text">
                        <p class="cpt001__tag karla karla--e7"><a href="{{$item->category->permalink}}">{{$item->category->name}}</a></p>
                        <h1 class="cpt001__title karla karla--e5"><a href="{{$item->permalink}}">{{$item->post_title}}</a></h1>
                    </div>
                @endforeach
            </div>
            @endif
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
        @endif
    </div>
@endsection

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
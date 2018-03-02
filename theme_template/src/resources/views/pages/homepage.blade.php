@extends('layouts.prevenir-master')
@section('content')
    <section class="hp001 border-grey-bottom row">
        <!-- cpt005 -->
        <div class="cpt005 border-grey-right col-12 col-lg-8">
            <div class="cpt005__inner">
                @if(isset($highlights) && !!$highlights)
                    @foreach($highlights as $highlight)
                        @include('components.cpt005', [
                            'url' => $highlight->permalink,
                            'image' => $highlight->featuredImage('raw', 'large', ['class' => 'inner__img']),
                            'backgroundColor' => $highlight->category->parent_category->cor,
                            'tag' => $highlight->category->name,
                            'title' => $highlight->post_title,
                            'paragraph' => $highlight->split['striped_excerpt']
                        ])
                    @endforeach
                @endif
            </div>
        </div>
        @if(isset($mostRead) && !!$mostRead)
        <div class="hp001-articles col-12 col-lg-4 mt-3">
            @include('components.cpt004', [
                'extraClasses' => 'cpt004--center mb-lg-5 mb-4 ',
                'barTitle' => 'mais populares',
            ])
            @foreach($mostRead as $item)
                @include('components.cpt001', [
                    'extraClasses' => 'cpt001--list-item',
                    'tag' => $item->category,
                    'url' => $item->permalink,
                    'title' =>  $item->post_title
                ])
            @endforeach
        </div>

        <!-- / cpt005 -->
        @endif
    </section>

    <!-- hp002 -->

    <section class="hp002 row">
        <div class="hp002__articles col-lg-8">
            @if(isset($lastPosts) && !!$lastPosts)
            <div class="row">
                @foreach($lastPosts as $index => $lastPost)
                    @if($index % 2 === 0)
                        <div class="col-lg-6 border-grey-right">
                    @else
                        <div class="col-lg-6">
                    @endif
                    @include('components.cpt001', [
                        'image' => $lastPost->featuredImage('raw', 'medium', ['class' => 'cpt001__img']),
                        'tag' => $lastPost->category,
                        'paragraph' => $lastPost->split['striped_excerpt'],
                        'url' => $lastPost->permalink,
                        'title' => $lastPost->post_title
                    ])
                        </div>
                    @if(($index + 1) % 2 === 0 && $index !== count($lastPosts) - 1)
                        </div>
                        <div class="row mt--sm-4 mt--xs-0">
                    @endif
                @endforeach
            </div>
            @endif
        </div>
        <div class="hp002__ads col-lg-4 d-none d-lg-block">
            <div style="height:300px; background-color:gray; margin:20px;"></div>
            <div style="height:875px; background-color:gray;"></div>
        </div>

    </section>

    <!-- / hp002 -->

    <!-- hp003 -->

    <div class="hp003 row">
        <div class="cpt002 col-12">
            <h4 class="cpt002__title museo museo--e1">Subscreva a nossa newsletter</h4>
            <form class="cpt002__form" action="submit">
                <input class="form__input playfair playfair--e10" type="text" value="O seu email">
                <input class="form__submit karla karla--e8" type="submit" value="Enviar">
            </form>

        </div>

    </div>

    <!-- / hp003 -->

    @if(isset($especialistasArticles) && !!$especialistasArticles)
    <!-- hp004 -->
    <section class="hp004 border-grey-bottom row pb-lg-5">
        <div class="hp004__articles col-12 col-lg-8 border-grey-right">

            @include('components.cpt004', [
                'extraClasses' => 'cpt004--center mb-lg-5 mb-4',
                'barTitle' => 'os especialistas respondem'
            ])

            @foreach($especialistasArticles as $article)
                @include('components.cpt001--horizontal', [
                    'isPerson' => true,
                    'extraClasses' => 'mb-lg-4',
                    'contentExtraClasses' => 'cpt001--no-padding',
                    'image' => isset($article->autores[0]) ? '<img class="cpt001__img--circle mr-lg-4" src="' . $article->autores[0]->thumbnail['url'] . '" alt="">' : '',
                    'name' => isset($article->autores[0]) ? $article->autores[0]->titulo . ' ' . $article->autores[0]->post_title : '',
                    'nameMobile' => isset($article->autores[0]) ? $article->autores[0]->titulo . '<br/>' . $article->autores[0]->post_title : '',
                    'paragraph' => $article->split['striped_excerpt'],
                    'url' => $article->permalink,
                    'title' => $article->post_title
                ])
            @endforeach

        <!-- cpt003 -->
            @include('components.cpt003', [
                'url' => '#',
                'slot' => 'Ver todos'
            ])
        <!-- /cpt003 -->
        </div>
        <div class="hp004__ads col-12 col-lg-4 d-none d-lg-block">
            <div style="width:300px; height:600px; background-color:gray;"></div>
        </div>
    </section>
    <!-- / hp004 -->
    @endif


    <!-- hp005 -->
    <section class="hp005 d-none d-sm-block mt-5 pb-5">
        @include('components.cpt006', [
            'extraClasses' => 'cpt006__text--left cpt006__text--bck-sponsor cpt006__centered col-sm-12 col-lg-5',
            'tag' => 'patrocinado por Barral',
            'title' =>  'Antibióticos:<br> 7 erros comuns',
            'paragraph' => 'Usar antibióticos de forma desadequada ontribui para o aumento da resistência a estes fármacos, ou seja, tornam-se menos capazes de controlar ou matar bactérias.',
            'imageRight' => true
        ])
    </section>

    <!-- /hp005 -->


    @if(isset($experimenteArticles) && count($experimenteArticles) > 0)
    <!-- hp006 -->
    <section class="hp006 row mb-5">
        @include('components.cpt004', [
            'extraClasses' => 'cpt004--left cpt004--left-bar mb-5 mt-5 col-12',
            'barTitle' => 'experimente',
            'extraHeaderClass' => 'd-inline-flex',
            'blackBar' => true
        ])
        <div class="hp006-articles col-12">
            @foreach($experimenteArticles as $experimenteArticle)
            @include('components.cpt001--horizontal', [
                'extraClasses' => 'mb-lg-5 mb-2',
                'contentExtraClasses' => 'cpt001__horizontal-mobile',
                'image' => $experimenteArticle->featuredImage('raw', 'large', ['class' => "cpt001__img mr-lg-4",'style' => "width: auto; height: auto;"]),
                'tag' => $experimenteArticle->category->name,
                'paragraph' => $experimenteArticle->split['striped_excerpt'],
                'url' => $experimenteArticle->permalink,
                'title' => $experimenteArticle->post_title
            ])
            @endforeach
        <!-- cpt003 -->

            @include('components.cpt003', [
                'extraClasses' => 'mb-5',
                'url' => '#',
                'slot' => 'Ver todos'
            ])

        <!-- /cpt003 -->

        </div>

        @include('components.cpt004', [
            'extraClasses' => 'cpt004--left-bar',
            'blackBar' => true,
            'extraBarClass' => 'cpt004__bar--nomargin'
        ])

    </section>
    <!-- / hp006 -->
    @endif



    @if(isset($conselhoCientifico) && !!$conselhoCientifico)
        <!-- hp007 -->
        <section class="hp007 row pt-5 mb-5">
            <div class="hp007__header col-12">
                @include('components.cpt004', [
                    'extraClasses' => 'cpt004--center mb-lg-5 mb-4',
                    'barTitle' => 'o nosso conselho científico'
                ])
            </div>
            <div class="hp007__articles mb-4 col-12">
                @foreach($conselhoCientifico as $conselhoCientificoElement)
                    @include('components.cpt001', [
                        'extraClasses' => 'cpt001__centered',
                        'url' => $conselhoCientificoElement->permalink,
                        'image' => '<img class="cpt001__img cpt001__img--circle mb-3" src="' . $conselhoCientificoElement->thumbnail['url'] . '" alt="">',
                        'name' => $conselhoCientificoElement->post_title,
                        'description' => $conselhoCientificoElement->descritivo
                    ])
                @endforeach
            </div>

            <!-- /hp007 -->

            <!-- cpt003 -->

        @include('components.cpt003', [
            'url' => $scientificCouncilTerm->permalink,
            'slot' => 'Ver todos'
        ])

        <!-- /cpt003 -->

        </section>

        <!-- / hp007 -->
    @endif

@endsection
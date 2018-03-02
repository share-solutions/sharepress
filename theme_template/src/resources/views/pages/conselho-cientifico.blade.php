@extends('layouts.prevenir-master')
@section('content')

    <div class="page-content col-lg-8">
        <div class="cpt004 cpt004--center margin-bottom">
            <h1><span class="cpt004__icon icon-asterisk"></span>{{ mb_strtolower($page->post_title, 'utf-8') }}</h1>
        </div>
        <div class="page-content playfair playfair--e10">
            {!! $page->split['content'] !!}
        </div>

        @if(isset($people) && !!$people)
            <!-- ctg004 -->
            <section class="ctg004 row">
                <div class="ctg004-inner col-12 mb-5">
                    <div class="row" id="load-more-target">
                        @foreach($people as $person)
                            @include('components.cpt001', [
                                'extraClasses' => 'cpt001__centered',
                                'url' => $person->permalink,
                                'image' => '<img class="cpt001__img cpt001__img--circle mb-3" src="' . $person->thumbnail['url'] . '" alt="">',
                                'name' => $person->post_title,
                                'description' => $person->descritivo
                            ])
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- /ctg004 -->
        @endif
    </div>


@endsection
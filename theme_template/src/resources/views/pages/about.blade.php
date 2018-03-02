@extends('layouts.prevenir-master')
@section('content')

    <section class="abo001 col-lg-8">
        @include('components.abo001', [
            'percentage' => '98%',
            'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'percentage2' => '20%',
            'info2' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'percentage3' => '50%',
            'info3' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ])

    </section>
    <section class="abo002 col-lg-8 mb-5">
        <div class="abo002__social mb-5 mt-5">
            @include('components.abo002-social', [
                'imageFacebook' => '<img class="header-social__img" src="/' . get_stylesheet_directory_uri() . '/build/images/facebook.png" alt="">',
                'imageTwitter' => '<img class="header-social__img" src="/' . get_stylesheet_directory_uri() . '/build/images/twitter.png" alt="">',
                'imageInstagram' => '<img class="header-social__img" src="/' . get_stylesheet_directory_uri() . '/build/images/instagram.png" alt="">'
            ])
        </div>
    </section>
    <section class="contact-form col-lg-8 mt-5">
        <div class="contact-form__text mb-4">
            <div class="contact-form__text-col">
                <p class="karla karla--e6">Assuntos Editoriais</p>
                <a class="playfair playfair--e10">editorial@howmedia.pt</a>
            </div>
            <div class="contact-form__text-col">
                <p class="karla karla--e6">Assuntos Comerciais</p>
                <a class="playfair playfair--e10">comercial@howmedia.pt</a>
            </div>
        </div>
    </section>

@endsection
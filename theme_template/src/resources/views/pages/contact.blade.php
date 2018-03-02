@extends('layouts.prevenir-master')
@section('content')


    <div class="contact-form col-lg-8">
        <div class="cpt004 cpt004--center margin-bottom">
            <h1><span class="cpt004__icon icon-asterisk"></span>contacto</h1>
        </div>
        <p class="contact-form__intro playfair playfair--e10">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam lectus felis, pulvinar sed ultricies a, tempor vel tortor. Suspendisse potenti. Sed eget orci nec tellus pretium tincidunt. Integer pellentesque sit amet lectus non accumsan. Proin non purus ante.</p>
        <h4 class="contact-form__title karla karla--e6">Deixe a sua mensagem</h4>
        <div class="page-content">
            {!! $page->split['content'] !!}
        </div>
    </div>




@endsection
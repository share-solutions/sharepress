@extends('layouts.prevenir-master')
@section('content')
    <div class="page-content col-lg-8">
        @include('components.cpt004', [
            'extraClasses' => 'cpt004--center mb-5',
            'barTitle' => mb_strtolower($page->post_title, 'utf-8'),
        ])
        <div class="page-content playfair playfair--e10">
            {!! $page->split['content'] !!}
        </div>
    </div>
@endsection
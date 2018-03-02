<!DOCTYPE html>
<html {{ language_attributes() }} class="no-js no-svg" lang="pt">

<head>
    <meta charset="{{ bloginfo( 'charset' ) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    {{ wp_head() }}
</head>

<body {{ body_class() }}>
    @section('header')
        @include('foundation.prevenir-header')
    @show

    <main class="container">
        @yield('content')
        @yield('related-posts')
    </main>

    @section('footer')
        @include('foundation.prevenir-footer', ['menuItems' => $footerMenuItems, 'disclaimer' => $footerDisclaimer])
    @show


    {{ wp_footer() }}
</body>
</html>
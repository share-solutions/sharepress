<!DOCTYPE html>
<html {{ language_attributes() }} class="no-js no-svg">
<head>
    <meta charset="{{ bloginfo( 'charset' ) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    {{ wp_head() }}
</head>

<body {{ body_class() }}>
<div id="page" class="site">
    @component('foundation.header')
    @endcomponent
    <div class="site-content-contain">
        <div id="content" class="site-content">
            @yield('content')
        </div><!-- #content -->
        @component('foundation.footer')
        @endcomponent
    </div><!-- .site-content-contain -->
</div><!-- #page -->
{{ wp_footer() }}
</body>
</html>
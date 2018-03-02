<!-- HEADER/NAVIGATION -->
<header>
    <div class="container header-container--top py-3 py-md-0">
        <div class="row header-inner">
            <div class="header-social col-6 col-md-4  align-self-center">
                <img class="header-social__img" src="{{ get_stylesheet_directory_uri() }}/build/images/facebook.png" alt="facebook-icon">
                <img class="header-social__img" src="{{ get_stylesheet_directory_uri() }}/build/images/twitter.png" alt="twitter-icon">
                <img class="header-social__img" src="{{ get_stylesheet_directory_uri() }}/build/images/instagram.png" alt="instagram-icon">
            </div>
            <div class="header-logo main-logo col-6 col-md-4 align-self-center d-flex justify-content-center">
                <a href="/"><img class="header-logo__img" src="{{ get_stylesheet_directory_uri() }}/build/images/LOGO.png" alt="logo-prevenir"></a>
            </div>
            <div class="header-subscribe d-none col-md-4 align-self-center d-md-flex justify-content-end">
                <p class="karla karla--e8 header-subscribe__text text-center align-self-center">Subscrever</p>
                <img class="header-subscribe__img" src="{{ get_stylesheet_directory_uri() }}/build/images/REVISTA.png" alt="revista-subscrever">
            </div>
        </div>
    </div>
    <div class="container-fluid header-container__bottom">
        <div class="row black-border-full">
            <div class="header-container__top-white-background"></div>
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="navbar-toggler">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>
                    <a href="/" class="navbar-brand"><img src="{{ get_stylesheet_directory_uri() }}/build/images/LOGO.png" /></a>
                    <div class="navbar-collapse justify-content-center">
                        @if(isset($headerMenuItems) && !!$headerMenuItems)
                            <ul class="navbar-nav">
                                @foreach($headerMenuItems as $collectionIndex => $headerMenuItemsCollection)
                                    @foreach($headerMenuItemsCollection as $item)
                                    <li class="nav-item dropdown" data-hover-color="{{$item->cor}}">
                                        <a class="nav-link _hover-lightgreen karla karla--e8" href="{{$item->url}}" role="button" aria-haspopup="true"
                                           aria-expanded="false">{{$item->title}}
                                            <span class="sr-only">(current)</span>
                                        </a>
                                        @if(count($item->children) > 0)
                                        <div class="dropdown-menu">
                                            @foreach($item->children as $child)
                                            <a class="dropdown-item" href="{{$child->url}}">{{$child->title}}</a>
                                            @endforeach
                                        </div>
                                        @endif
                                    </li>
                                    @endforeach
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="search">
                        <div class="search__container">
                            <div class="search__form">
                                <form action="" method="GET">
                                    <input type="text" name="s" placeholder="O que quer pesquisar na Prevenir">
                                </form>
                                <i class="fa fa-search"></i>
                                <i class="fa fa-close"></i>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>


</header>
<!-- /HEADER /NAVIGATION -->

<!-- FOOTER -->
<footer class="footer-main">
    <div class="container">
        <div class="row py-5">
            @if(isset($menuItems) && !!$menuItems)
                @foreach($menuItems as $collectionIndex => $menuItemsCollection)
                    <div class="footer-column d-none d-sm-block col-sm-6 col-md-3">
                        @foreach($menuItemsCollection as $index => $item)
                        <div class="column-inner">
                            <ul class="column-inner__list">
                                <li class="column-inner__item">
                                    <a class="column-inner__link column-inner__link--title karla karla--e8" href="{{$item->url}}">{{$item->title}}</a>
                                </li>
                                @if(count($item->children) > 0)
                                    @foreach($item->children as $child)
                                        <li class="column-inner__item">
                                            <a class="column-inner__link playfair playfair--e10" href="{{$child->url}}">{{$child->title}}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        @endforeach
                        @if($collectionIndex == 2)
                            <div class="column-inner footer-center">

                                <ul class="column-inner__list">
                                    <li class="column-inner__item">
                                        <a class="column-inner__link column-inner__link--title karla karla--e8" href="#">Redes Sociais</a>
                                    </li>
                                </ul>

                                <ul class="">
                                    <a class="column-inner__link" href="#">
                                        <img src="{{ get_stylesheet_directory_uri() }}/build/images/facebook-footer.png" alt="" srcset="">
                                    </a>


                                    <a class="column-inner__link" href="#">
                                        <img src="{{ get_stylesheet_directory_uri() }}/build/images/twitter-footer.png" alt="" srcset="">
                                    </a>


                                    <a class="column-inner__link" href="#">
                                        <img src="{{ get_stylesheet_directory_uri() }}/build/images/instagram-footer.png" alt="" srcset="">
                                    </a>
                                </ul>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
            <div class="footer-column footer-center col-12 col-sm-6 col-md-3 pl-3 pl-sm-5 pl-md-0">
                <div class="column-inner">
                    <img class="column-inner__img pb-3" src="{{ get_stylesheet_directory_uri() }}/build/images/logo-footer.png" alt="logo prevenir">
                    <p class="column-inner__text">{!! $disclaimer !!}</p>
                </div>


            </div>
        </div>
    </div>
</footer>

<!-- /FOOTER -->
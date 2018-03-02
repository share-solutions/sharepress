<div class="cpt007 karla karla--e7">
    <a href="{{ get_category_link($category) }}"><p class="cpt007__rec">{{ $category->name }}</p></a>
    @if(isset($infos) && !!$infos)
        <div class="cpt007__rec-info">
            @foreach($infos as $info)
                <div class="cpt007__rec">
                    <img src="{{ get_stylesheet_directory_uri() }}/build/images/{{ $info['imagem'] }}.png"
                         alt="" class="cpt007__rec-info-icon">
                    <p class="cpt007__rec-info">{{ $info['texto'] }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
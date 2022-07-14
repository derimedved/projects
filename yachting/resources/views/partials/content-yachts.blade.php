
<div class="slide">
    @if (get_field('gallery'))
    <figure class="img-slider owl-carousel">
        @foreach (get_field('gallery') as $slide)
        <div class="img-wrap">
            <img src="{{ $slide['sizes']['390x300'] }}" alt="{{ $slide['alt'] }}">
        </div>   
        @endforeach
    </figure>
    @endif
    <div class="text-wrap">
        <h6>{{ get_the_title() }} <span><i class="fas fa-users"></i> <b>{{ get_field('capacity') }}</b></span></h6>
        <div class="stars-wrap">
            @if (get_field('rating'))
            <div class="wrap">
                @for ($i = 0; $i < get_field('rating'); $i++)
                <i class="fas fa-star"></i>
                @endfor
            </div>  
            @endif
            <a href="{{ get_permalink() }}#comments">{{ get_comments_number()?:0 }} {{ __('reviews','yachting') }}</a>
        </div>
        <div class="bottom">
            <p class="cost">{{ __('From',) }} {{ get_field('currency','options') }} {{ get_field('price_p_h') }}
                {{ __('per hour','yachting') }}</p>
            <a href="{{ get_permalink() }}" class="btn-default btn-blue btn-big">{{ __('BOOK NOW','yachting') }}</a>
        </div>
    </div>
    <div class="text-wrap-line">
        <div class="top-info">
            <div class="name">
                <h6>{{ get_the_title() }} </h6>
                <div class="stars-wrap">
                    @if (get_field('rating'))
                    <div class="wrap">
                        @for ($i = 0; $i < get_field('rating'); $i++)
                        <i class="fas fa-star"></i>
                        @endfor
                    </div>  
                    @endif
                    <a href="{{ get_permalink() }}#comments">{{ get_comments_number()?:0 }} {{ __('reviews','yachting') }}</a>
                </div>
            </div>
            @if (get_field('characteristics'))
            <div class="info-item">
                <ul>
                    @foreach (get_field('characteristics') as $characteristics)
                     <li>
                        <p><i class="{{ $characteristics['icon'] }}"></i>{{ $characteristics['label'] }}</p>
                        <h6>{{ $characteristics['value'] }}</h6>
                    </li>   
                    @endforeach
                </ul>
            </div>
            @endif

        </div>
        {!! get_field('text') !!}
        @if (get_field('equipment')[1]['list'])
        <ul class="list-point">
            @foreach (get_field('equipment')[1]['list'] as $list)
            <li>{{ $list['text'] }}</li>
            @endforeach
        </ul>
        @endif
        <div class="cost-wrap">
            <ul>
                @if (get_field('price_p_h'))
                <li>
                    <img src="{{ ASSETS }}img/icon-4.svg" alt="">
                    <p>{{ __('Per hour','yachting') }}</p>
                    <h6>{{ get_field('currency','options') }} {{ get_field('price_p_h') }}</h6>
                </li>
                @endif
                @if (get_field('price_p_d'))
                <li>
                    <img src="{{ ASSETS }}img/icon-5.svg" alt="">
                    <p>{{ __('Per day','yachting') }}</p>
                    <h6>{{ get_field('currency','options') }} {{ get_field('price_p_d') }}</h6>
                </li>
                @endif
                <li>
                    <a href="{{ get_permalink() }}" class="btn-default btn-blue">{{ __('BOOK NOW','yachting') }}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
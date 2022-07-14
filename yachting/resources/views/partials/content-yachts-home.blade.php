@php
$id=$id?:get_the_ID()
@endphp
<div class="slide">
    @if (get_field('gallery',$id))
    <figure class="img-slider owl-carousel">
        @foreach (get_field('gallery',$id) as $slide)
        <div class="img-wrap">
            <img src="{{ $slide['sizes']['390x300'] }}" alt="{{ $slide['alt'] }}">
        </div>   
        @endforeach
    </figure>
    @endif
    <div class="text-wrap">
        <h6><a href="#">{{ get_the_title($id) }} </a><span><i class="fas fa-users"></i> <b>{{ get_field('capacity',$id) }}</b></span></h6>
        <div class="stars-wrap">
            <div class="wrap">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <a href="{{ get_permalink($id) }}#comments">{{ get_comments_number($id)?:0 }} {{ __('reviews','yachting') }}</a>
        </div>
        <div class="bottom">
            <p class="cost">{{ __('From',) }} {{ get_field('currency','options') }} {{ get_field('price_p_h',$id) }}
                {{ __('per hour','yachting') }}</p>
            <a href="{{ get_permalink($id) }}" class="btn-default btn-blue btn-big">{{ __('BOOK NOW','yachting') }}</a>
        </div>
    </div>
</div>
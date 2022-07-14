@extends('layouts.app')
@section('content')

    @if ($img||$text||$link||$title)
    <section class="home-top"<?php if($img) printf('background: url(%s) no-repeat center;
    background-size: cover;',$img->size->{'1920x700'})?>>
        <div class="content-width">
            <div class="text-wrap">
                <p class="top">{{ $text }}</p>
                <h1>{{ $title }}</h1>
                @if ($link)
                <div class="btn-wrap">
                    <a href="{{ $link->url }}" target="{{ $link->target }}" class="btn-default  btn-border-white">{{ $link->title }}</a>
                </div>
                @endif
            </div>
            <div class="filter-wrap">
                <form action="{{ get_permalink($acf_options->yachting_page) }}" class="filter-form" name="filter-form">
                    <div class="datepicker-wrap">
                        <div class="item-date item-date-1">
                            <label for="start">{{ __('Date from','yachting') }} <span><i class="far fa-chevron-down"></i></span></label>
                            <input type='text' id='start' name="date_from" data-range="true" autocomplete="off"
                                placeholder="Select date">

                        </div>
                        <div class="item-date item-date-2" data-range="true">
                            <label for="end">{{ __('To','yachting') }} <span><i class="far fa-chevron-down"></i></span></label>
                            <input type='text' id='end' name="date_to" autocomplete="off" placeholder="Select date">
                        </div>
                    </div>
                    <div class="range-wrap">
                        <label for="range">{{ __('Number of guests','yachting') }}</label>
                        <input type="text" name="capacity" class="js-range-slider" value="" id="range"  data-from="{{ $acf_options->capacity_from?:0 }}" data-min="{{ $acf_options->capacity_from?:0 }}" data-to="{{ $acf_options->capacity_to?:100 }}" data-max="{{ $acf_options->capacity_to?:100 }}" />
                    </div>
                    <div class="input-wrap">
                        <button type="submit" class="btn-default btn-big">{{ __('FIND YACHT','yachting') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @endif

    @if ($title_1||$subtitle||$yachts||$link_1)
    <section class="yachts">
        <div class="content-width">
            <h2>{{ $title_1 }}</h2>
            <div class="line"><span></span></div>
            <p class="top">{{ $subtitle }}</p>
            @if ($yachts)
            <div class="yachts-slider yachts-slider-js owl-carousel content">
            @foreach ($yachts as $yacht)
                @include('partials.content-yachts-home',['id'=>$yacht])
            @endforeach
            </div>
            @endif
            @if ($link_1)
            <div class="btn-wrap">
                <a href="{{ $link_1->url }}" target="{{ $link_1->target }}" class="btn-default  btn-border">{{ $link_1->title }}</a>
            </div>
            @endif
        </div>
    </section>
    @endif

    @if ($title_2||$subtitle_1||$packages||$link_2)
    <section class="packages" id="packages">
        <div class="content-width">
            <h2>{{ $title_2 }}</h2>
            <div class="line"><span></span></div>
            <p class="top">{{ $subtitle_1 }}</p>
            @if ($packages)
            {{-- included_in --}}
            <div class="content">
                @foreach ($packages as $package)
                <div class="item <?php if(($loop->iteration % 3)-2 == 0) echo 'item-big'; ?>">
                    <h3>{{ get_the_title($package) }}</h3>
                    <figure>
                        @if (has_post_thumbnail($package))
                        <img src="{{ get_the_post_thumbnail_url($package,'390x300') }}" alt="">
                        @endif
                    </figure>
                    <p>{{ get_field('included_in',$package) }}</p>
                    <div class="line line-small"><span></span></div>
                    @if (get_field('list',$package))
                    <ul>
                        @foreach (get_field('list',$package) as $list)
                            <li>{{ $list['text'] }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <div class="btn-wrap">
                        <a href="#" class="btn-default btn-blue">BOOK NOW</a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            @if ($link_2)
            <div class="btn-wrap">
                <a href="{{ $link_2->url }}" target="{{ $link_2->target }}" class="btn-default  btn-border">{{ $link_2->title }}</a>
            </div>
            @endif
        </div>
    </section>
    @endif

    @if ($title_3||$background||$steps)
    <section class="charter-yachts"<?php if($background) printf('background: url(%s) no-repeat center;
    background-size: cover;',$background->size->{'1920x700'})?>>
        <div class="content-width">
            <h3>{{ $title_3 }}</h3>
            <div class="line-bg">
                <img src="{{ ASSETS }}img/line-bg.png" alt="">
            </div>
            @if ($steps)
            <div class="content">
                <ul>
                    @foreach ($steps as $step)
                    <li class="item item-{{ $loop->iteration }}">
                        @if ($loop->iteration%2!=0)
                            <p>{{ $step->text }}</p>
                        @endif
                        
                        @if ($step->icon)
                        <figure>
                            
                            <img src="{{ $step->icon->sizes->{'80x80'} }}" alt="{{ $step->icon->alt }}">
                            
                        </figure>
                        @endif

                        @if ($loop->iteration%2==0)
                            <p>{{ $step->text }}</p>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </section>
    @endif

    @if ($column_left||$column_right)
    <section class="add-services" id="add-services">
        <div class="content-width">
            @if ($column_left)
            <div class="left">
                <h2>{{ $column_left->title }}</h2>
                <div class="line"><span></span></div>
                @if ($column_left->list)
                <ul>
                    @foreach ($column_left->list as $list)
                    <li>
                        <h3>{{ $list->title }}</h3>
                        {!! $list->text !!}
                    </li>
                    @endforeach
                </ul>
                @endif
                @if ($column_left->link)
                <div class="btn-wrap">
                    <a href="{{ $column_left->link->url }}" target="{{ $column_left->link->target }}" class="btn-default">{{ $column_left->link->title }}</a>
                </div>
                @endif
            </div>
            @endif
            @if ($column_right)
            <div class="right">
                <h2>{{ $column_right->title }}</h2>
                <div class="line"><span></span></div>
                @if ($column_right->list)
                <ul>
                    @foreach ($column_right->list as $list)
                    <li>
                        <figure>
                            @if ($list->image)
                            <img src="{{ $list->image->sizes->{'390x300'} }}" alt="{{ $list->image->alt }}">
                            <figcaption>{{ $list->image->description }}</figcaption>
                            @endif
                        </figure>
                        <p>{{ $list->title }}</p>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
            @endif
        </div>
    </section>
    @endif

    @if ($title_4||$image||$text_1)
    <section class="about" id="about">
        <div class="content-width">
            <figure>
                @if ($image)
                    <img src="{{ $image->sizes->{'600x400'} }}" alt="">
                @else
                    <img src="{{ ASSETS }}img/img-4.jpg" alt="">
                @endif
            </figure>
            <div class="text-wrap">
                <h2>{{ $title_4 }}</h2>
                <div class="line"><span></span></div>
                {!! $text_1 !!}
            </div>
        </div>
    </section>
    @endif

    @if ($title_5||$subtitle_2||$icon||$reviews||$link_3)
    <section class="reviews">
        <div class="content-width">
            <h2>{{ $title_5 }}</h2>
            <div class="line"><span></span></div>
            <p class="top">{{ $subtitle_2 }}</p>
            <figure>
                @if ($icon)
                <img src="{{ $icon->url }}" alt="">
                @endif
            </figure>
            @if ($reviews)
            <div class="reviews-slider owl-carousel">
                @foreach ($reviews as $review)
                <div class="slide">
                    <div class="left">
                        <p class="name">{{ $review->name }}</p>
                        @if ($review->rating)
                        <div class="stars-wrap">
                            @for ($i = 0; $i < $review->rating; $i++)
                            <i class="fas fa-star"></i>
                            @endfor
                        </div>  
                        @endif
                    </div>
                    <div class="text-wrap">
                        <p>{{ $review->text }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            @if ($link_3)
            <div class="btn-wrap">
                <a href="{{ $link_3->url }}" target="{{ $link_3->target }}" class="btn-default  btn-border">{{ $link_3->title }}</a>
            </div>
            @endif
        </div>
    </section>
    @endif

@endsection

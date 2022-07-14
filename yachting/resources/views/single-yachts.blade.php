@extends('layouts.app')

@section('content')
    <section class="product-inner">
        <div class="content-width">
            <div class="left">
                @if ($gallery)
                <div class="swiper-container gallery-top">
                    <div class="swiper-wrapper">
                        @foreach ($gallery as $slide)
                        <div class="swiper-slide">
                            <img src="{{ $slide->sizes->{'680x420'} }}" alt="{{ $slide->alt }}">
                        </div>   
                        @endforeach
                    </div>
                </div>
                <div class="wrap">
                    <div class="swiper-container gallery-thumbs">
                        <div class="swiper-wrapper">
                            @foreach ($gallery as $slide)
                            <div class="swiper-slide">
                                <img src="{{ $slide->sizes->{'150x100'} }}" alt="{{ $slide->alt }}">
                            </div>   
                            @endforeach
                        </div>

                    </div>
                    <div class="nav-wrap">
                        <div class="swiper-button-next swiper-button-next-2"></div>
                        <div class="swiper-button-prev swiper-button-prev-2"></div>
                    </div>
                </div>
                @endif
                <div class="wrap-text">
                    <div class="info-wrap">
                        <div class="name">
                            <h2>{{ get_the_title() }} </h2>
                            <div class="stars-wrap">
                                @if ($rating)
                                <div class="wrap">
                                    @for ($i = 0; $i < $rating; $i++)
                                    <i class="fas fa-star"></i>
                                    @endfor
                                </div>  
                                @endif
                                <a href="#comments">{{ get_comments_number()?:0 }} {{ __('reviews','yachting') }}</a>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            @if ($characteristics)
                            <ul>
                                @foreach ($characteristics as $characteristics)
                                <li>
                                    <p><i class="{{ $characteristics->icon }}"></i>{{ $characteristics->label }}</p>
                                    <h6>{{ $characteristics->value }}</h6>
                                </li>   
                                @endforeach
                            </ul>
                            @endif
                            @if ($owner&&is_int($owner))
                            <div class="text">
                                @if (get_field('owner','user_'.$owner))
                                <p>{{ __('Offered by','yachting') }}: <a href="#">{{ get_field('owner','user_'.$owner)['title'] }}</a></p>
                                @endif
                            </div>  
                            @endif
                        </div>

                    </div>
                    @if ($text)
                    <div class="item item-1">
                        <h3>{{ $title?:__('DESCRIPTION','yachting') }}</h3>
                        <div class="line line-small"><span></span></div>
                        <div class="wrap-show">
                            <div class="wrap-collapse">
                                {!! $text !!}
                            </div>
                        </div>
                    </div>
                    @endif
                    @if ($equipment)
                    <div class="item item-2">
                        <h3>{{ $title_1?:__('EQUIPMENT','yachting') }}</h3>
                        <div class="line line-small"><span></span></div>
                        <div class="content-equipment">
                            @foreach ($equipment as $row)
                            <ul>
                                <li>
                                    <h6>{{ $row->title }} </h6>
                                </li>
                                @if ($row->list)
                                @foreach ($row->list as $list)
                                <li>
                                    <p>
                                    @if ($list->icon)
                                        <img src="{{ $list->icon->sizes->{'80x80'} }}" alt="{{ $list->icon->alt }}">
                                    @endif
                                    {{ $list->text }}</p>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                            @endforeach
                        </div>
                        <div class="btn-wrap">
                            <button class="cuttr-readmore ">{{ __('SHOW MORE','yachting') }}</button>
                        </div>
                    </div>
                    @endif
                    <div class="item item-3">
                        <div class="reviews-content">
                            @if ($owner&&is_int($owner))
                                @if (get_field('owner','user_'.$owner))
                                <div class="reviews-item">
                                    <h3>{{ __('BOAT OWNER','yachting') }}</h3>
                                    <div class="line line-small"><span></span></div>
                                    {!! get_field('owner','user_'.$owner)['text'] !!}
                                    @php
                                    $user = get_userdata( $owner );
                                    if($user)
                                    $email = $user->user_email;
                                    @endphp
                                    @if ($email)
                                    <div class="btn-wrap">
                                        <a href="mailto:{{ $email }}" class="btn-default btn-blue" target="_blank">{{ __('SEND MESSAGE','yachting') }}</a>
                                    </div>
                                    @endif
                                </div>
                                @endif
                            @endif
                            @if ($rating_block)
                            <div class="rating-item">
                                <h3>{{ __('RATING','yachting') }}</h3>
                                <div class="line line-small"><span></span></div>
                                @if ($rating_block->list)
                                <ul class="rating-list">
                                    @foreach ($rating_block->list as $list)
                                    <li>
                                        <p>{{ $list->text }}</p>
                                        @if ($list->range)
                                        <div class="stars-wrap">
                                            @for ($i = 0; $i < $list->range; $i++)
                                            <i class="fas fa-star"></i>
                                            @endfor
                                        </div>  
                                        @endif
                                    </li>  
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                            @endif
                            <div class="add-reviews">
                                <h6>Reviews</h6>
                                <div class="testimonials-item">
                                    <div class="user-testimonials">
                                        <p class="name">John Doe</p>
                                        <p class="date">March 31, 2021 - 15:03</p>
                                        <div class="stars-wrap">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <p class="text">My wife and I had an unbelievable experience with the White
                                            Ocean Yacht
                                            of Abu Dhabi Yachts. I really will recommend this boat owners and his
                                            yacht.
                                            The commuincation and reception was above our expectation and we felt
                                            really welcome at the dock. The captain of the yacht Antonio also was
                                            very
                                            nice. Definitely worth all the pennies!</p>
                                        <div class="answer-testimonials">
                                            <p class="name">Abu Dhabi Yachts</p>
                                            <p class="date">April 1, 2021 - 10:32</p>
                                            <p class="text">Thank you very much John! Good to hear you had a great
                                                time!</p>
                                        </div>
                                    </div>


                                </div>
                                <div class="testimonials-item">
                                    <div class="user-testimonials">
                                        <p class="name">Jack Dawson</p>
                                        <p class="date">March 31, 2021 - 15:03</p>
                                        <div class="stars-wrap">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <p class="text">Simply said: BEST TIME EVER! Definitely come back soon with
                                            my friend!</p>
                                        <div class="answer-testimonials">
                                            <p class="name">Abu Dhabi Yachts</p>
                                            <p class="date">April 1, 2021 - 10:32</p>
                                            <p class="text">Nice one Jack! See you soon, thank you.</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    @if ($subtitle||$map)
                    <div class="item item-4">
                        <h3>{{ $title_2?:__('LOCATION','yachting') }}</h3>
                        <div class="line line-small"><span></span></div>
                        <div class="map-content">
                            <p>{!! $subtitle !!}</p>
                            @if ($map)
                            <div id="map" data-lat="{{ $map->lat }}" data-lng="{{ $map->lng }}"></div>
                            @endif
                        </div>
                    </div>
                    @endif

                    @php
                    $yachts = get_posts( array(
                        'numberposts' => 2,
                        'fields' => 'ids',
                        'post_type'   => get_post_type(),
                        'orderby' => 'rand',
                        'order'    => 'ASC',
                        'exclude' => [get_the_ID()],
                    ) ); wp_reset_postdata(  );
                    @endphp
                    @if ($yachts)
                    <div class="item item-5">
                        <h3>{{ __('YOU MAY ALSO LIKE THESE YACHTS','yachting') }}</h3>
                        <div class="line line-small"><span></span></div>
                        <div class="yachts-slider">
                            @foreach ($yachts as $yacht)
                                @include('partials.content-yachts-home',['id'=>$yacht])
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>
            </div>
            <div class="right">
                <div class="item">
                    <h3>{{ __('Select your date and time','yachting') }}</h3>
                    <form action="#" class="form-default ajax_form" name="form-default">
                        <div class="datepicker-wrap">
                            <div class="item-date item-date-1">
                                <label for="start-1">{{ __('Check-in','yachting') }} <span><i class="far fa-chevron-down"></i></span></label>
                                <input type='text' id='start-1' class="start-1" name="date_from" data-range="true"
                                    autocomplete="off" placeholder="Select date">

                            </div>
                            <div class="item-date item-date-2" data-range="true">
                                <label for="end-1">{{ __('Check-out','yachting') }} <span><i class="far fa-chevron-down"></i></span></label>
                                <input type='text' id='end-1' class="end-1" name="date_to" autocomplete="off"
                                    placeholder="Select date">
                            </div>
                        </div>
                        <div class="line"><span></span></div>

                        <p class="cost">{{ __('Charter price','yachting') }}: <span>{{ $acf_options->currency }} {{ $price }}</span></p>
                        <div class="status"></div>
                        <div class="btn-wrap">
                            @if (!is_user_logged_in())
                                <a href="#register" class="btn-default btn-blue fancybox">{{ __('BOOK NOW','yachting') }}</a>
                            @else
                               <a href="#" class="btn-default btn-blue book">{{ __('BOOK NOW','yachting') }}</a> 
                            @endif
                            <a href="#" class="btn-default btn-border btn-border-blue">{{ __('SEND INQUIRY','yachting') }}</a>
                        </div>
                        <input type="hidden" name="action" value="ajax_booking">
                        <input type="hidden" name="user_id" value="{{ get_current_user_id() }}">
                    </form>
                </div>
                <p class="info"><img src="{{ ASSETS }}img/icon-8.svg" alt=""><b>57 {{ __('people','yachting') }}</b> {{ __('have viewed this yacht last week','yachting') }}
                </p>
            </div>
        </div>
    </section>
@endsection

<div class="btn-fix">
    <a href="#order" class="btn-default btn-blue fancybox">{{ __('Book this yacht','yachting') }}</a>
</div>


<div id="order" class="popup-site popup-order" style="display: none;">
    <div class="item">
        <h3>{{ __('Select your date and time','yachting') }}</h3>
        <form action="#" class="form-default ajax_form" name="form-default">
            <div class="datepicker-wrap">
                <div class="item-date item-date-1">
                    <label for="start-2">{{ __('Check-in','yachting') }} <span><i class="far fa-chevron-down"></i></span></label>
                    <input type='text' class="'start-1" id='start-2' name="date_from" data-range="true"
                        autocomplete="off" placeholder="Select date">

                </div>
                <div class="item-date item-date-2" data-range="true">
                    <label for="end-2">{{ __('Check-out','yachting') }} <span><i class="far fa-chevron-down"></i></span></label>
                    <input type='text' id='end-2' class="end-1" name="date_to" autocomplete="off"
                        placeholder="Select date">
                </div>
            </div>
            <div class="line"><span></span></div>

            <p class="cost">{{ __('Charter price','yachting') }}: <span>{{ $acf_options->currency }} {{ $price }}</span></p>
            <div class="btn-wrap">
                @if (!is_user_logged_in())
                    <a href="#register" class="btn-default btn-blue fancybox">{{ __('BOOK NOW','yachting') }}</a>
                @else
                    <a href="#" class="btn-default btn-blue book">{{ __('BOOK NOW','yachting') }}</a> 
                @endif
                <a href="#" class="btn-default btn-border btn-border-blue">{{ __('SEND INQUIRY','yachting') }}</a>
            </div>
            <input type="hidden" name="action" value="ajax_booking">
            <input type="hidden" name="user_id" value="{{ get_current_user_id() }}">
        </form>
    </div>
</div>


<div id="confirm-order" class="popup-site popup-order" style="display: none;">
    <div class="item">
        <h3>{{ __('Сonfirm an order','yachting') }}</h3>
        <div class="form-default">

            <p class="date">{{ __('Date','yachting') }}: <span>~</span></p>

            <p class="cost">{{ __('Charter price','yachting') }}: <span>~</span></p>
            <div class="btn-wrap">
                <a href="#" class="btn-default btn-blue">{{ __('BOOK NOW','yachting') }}</a>
            </div>

        </div>
    </div>
</div>


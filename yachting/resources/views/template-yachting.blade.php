{{-- 
  Template Name: Yachting Template 
--}}

@extends('layouts.app')

@section('content')
    @php

    $posts_per_page=9;
    $post_type='yachts';
    $tax=get_object_taxonomies($post_type);
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    $taxonomies=get_object_taxonomies($post_type)?:[];

    $query = new WP_Query ( array(
        'posts_per_page' => $posts_per_page,
        'post_type' => $post_type,
        'suppress_filters' => false,
        'paged' => $paged,
    ) );

    @endphp
    <section class="yachts-wrap">
        <div class="content-width">

            <h1>{!! App::title() !!}</h1>
            <div class="line"><span></span></div>
            <div class="btn-filter">
                <a href="#"><img src="{{ ASSETS }}img/icon-7.svg" alt="">{{ 'Filter by', 'yachting' }}</a>
            </div>
            <div class="yachts-content">
                <div class="filer-left">

                    <form action="#" class="filter-form filter_form" name="filter-form">
                        <div class="item">
                            <div class="datepicker-wrap">
                                <div class="item-date item-date-1">
                                    <label for="start-1">{{ __('From','yachting') }} <span><i class="far fa-chevron-down"></i></span></label>
                                    <input type='text' value="{{ $_GET['date_from'] }}" id='start-1' class="start-1" name="date_from" data-range="true" autocomplete="off"
                                        placeholder="Select date">

                                </div>
                                <div class="item-date item-date-2" data-range="true">
                                    <label for="end-1">{{ __('To','yachting') }} <span><i class="far fa-chevron-down"></i></span></label>
                                    <input type='text' value="{{ $_GET['date_to'] }}" id='end-1' class="end-1" name="date_to" autocomplete="off"
                                        placeholder="Select date">
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="range-wrap">
                                <label for="range-1">{{ __('Price per day','yachting') }}</label>
                                <input type="text" name="price" class="js-range-slider-1" value="" id="range-1" data-from="{{ $acf_options->price_from?:0 }}" data-min="{{ $acf_options->price_from?:0 }}" data-to="{{ $acf_options->price_to?:100 }}" data-max="{{ $acf_options->price_to?:100 }}" />
                                <div class="select-block select-block-mini">
                                    <label class="form-label" for="value-1"></label>
                                    <select id="value-1">
                                        <option value="1" data-display="Euro €">Euro €</option>
                                        <option value="2">Dollar $</option>
                                    </select>
                                </div>
                            </div>
                            <div class="range-wrap">
                                <label for="range-2">{{ __('Boat Length','yachting') }}</label>
                                <input type="text" name="boat_length" class="js-range-slider-2" value="" id="range-2" data-from="{{ $acf_options->boat_length_from?:0 }}" data-min="{{ $acf_options->boat_length_from?:0 }}" data-to="{{ $acf_options->boat_length_to?:100 }}" data-max="{{ $acf_options->boat_length_to?:100 }}" />
                                <div class="select-block select-block-mini">
                                    <label class="form-label" for="value-2"></label>
                                    <select id="value-2">
                                        <option value="1" data-display="Feet ft.">Feet ft.</option>
                                        <option value="2">Feet ft. 1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if ($taxonomies[0])
                        <div class="item">
                            @php
                            $labels = get_taxonomy_labels( get_taxonomy($taxonomies[0]) );
                            $terms=get_terms([
                                'taxonomy'=>$taxonomies[0],
                                'hide_empty'=>false,
                            ]);
                            @endphp
                            <h5>{{ $labels->name }}</h5>
                            @foreach ($terms as $term)
                            <p class="checkbox">
                                <label>
                                    <input type="checkbox" value="{{ $term->term_id }}" name="{{ $taxonomies[0] }}[]">
                                    <span></span> <i>{{ $term->name }}</i>
                                </label>
                            </p>
                            @endforeach
                        </div>
                        @endif
                        <div class="item">
                            <div class="range-wrap">
                                <label for="range-3">{{ __('Capacity','yachting') }}</label>
                                <input type="text" name="capacity" value="{{ $_GET['capacity'] }}" class="js-range-slider-3" value="" id="range-3"  data-from="{{ $acf_options->capacity_from?:0 }}" data-min="{{ $acf_options->capacity_from?:0 }}" data-to="{{ $acf_options->capacity_to?:100 }}" data-max="{{ $acf_options->capacity_to?:100 }}" />
                            </div>
                            <div class="range-wrap">
                                <label for="range-4">{{ __('Cabins','yachting') }}</label>
                                <input type="text" name="cabins" class="js-range-slider-4" value="" id="range-4"  data-from="{{ $acf_options->cabins_from?:0 }}" data-min="{{ $acf_options->cabins_from?:0 }}" data-to="{{ $acf_options->cabins_to?:100 }}" data-max="{{ $acf_options->cabins_to?:100 }}" />
                            </div>
                            {{--<div class="range-wrap">
                                <label for="range-5">{{ __('Berths','yachting') }}</label>
                                <input type="text" name="berths" class="js-range-slider-5" value="" id="range-5"  data-from="{{ $acf_options->berths_from?:0 }}" data-min="{{ $acf_options->berths_from?:0 }}" data-to="{{ $acf_options->berths_to?:100 }}" data-max="{{ $acf_options->berths_to?:100 }}" />
                            </div>--}}
                        </div>
                        @if ($taxonomies[1])
                        <div class="item">
                            @php
                            $labels = get_taxonomy_labels( get_taxonomy($taxonomies[1]) );
                            $terms=get_terms([
                                'taxonomy'=>$taxonomies[1],
                                'hide_empty'=>false,
                            ]);
                            @endphp
                            <h5>{{ $labels->name }}</h5>
                            @foreach ($terms as $term)
                            <p class="checkbox">
                                <label>
                                    <input type="checkbox" value="{{ $term->term_id }}" name="{{ $taxonomies[1] }}[]">
                                    <span></span> <i>{{ $term->name }}</i>
                                </label>
                            </p>
                            @endforeach
                        </div>
                        @endif
                        <input name="action" type="hidden" value="post_handler" />
                        <input name="post_type" type="hidden" value="{{ $post_type }}" />
                        <input name="posts_per_page" type="hidden" value="{{ $posts_per_page }}" />
                    </form>

                </div>
                <div class="full-content">
                    <form class="filter-line filter_form">
                        <div class="filter-info">
                            @if (isset($_GET['search'])&&!empty($_GET['search']))
                            <div class="item">
                                <p><a href="#" class="remove_search_item"><i class="fal fa-times"></i></a>{{ $_GET['search'] }}</p>
                                <input type="hidden" name="s[]" value="{{ $_GET['search'] }}">
                            </div>
                            @endif
                        </div>
                        <div class="sort-wrap">
                            <div class="sort-item sort-item-1">
                                <h5>View as</h5>
                                <a href="#" class="tile-item-view is-active"><i class="fas fa-th"></i></a>
                                <a href="#" class="line-item-view"><i class="fas fa-th-list"></i></a>
                            </div>
                            <div class="sort-item sort-item-2">
                                <h5>Sort by</h5>
                                <div class="select-block">
                                    <label class="form-label" for="value-10"></label>
                                    <select name="orderby" id="value-10">
                                        <option value="price_asc" data-display="Price: Low - High">Price: Low - High
                                        </option>
                                        <option value="price_desc">Price: High - Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="yachts-slider yachts-slider-content output_wrap">

                        @if ($query->have_posts())
                          @while ($query->have_posts()) @php $query->the_post(); @endphp
                            @include('partials.content-'.$post_type)
                          @endwhile
                          @php wp_reset_postdata(  ); @endphp
                        @else
                            @include('partials.content-none')
                        @endif

                        @if ($query->max_num_pages>1)
                            <div class="btn-wrap">
                                <a href="#" data-page="{{ ++$paged }}" class="btn-default  btn-border load_more">{{ __('Load more','yachting') }}</a>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>



        </div>
    </section>
@endsection

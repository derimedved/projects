@extends('layouts.app')

@section('content')

<section class="yachts-wrap">
        <div class="content-width">

            <h1>{!! App::title() !!}</h1>
            <div class="line"><span></span></div>
            <div class="btn-filter">
                
            </div>
            <div class="yachts-content">
                @while(have_posts()) 
                @php the_post(); the_content(); @endphp
                @endwhile
            </div>
        </div>
    </section>

  
@endsection

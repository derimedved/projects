@extends('layouts.app')

@section('content')
  
  <section class="yachts-wrap">
        <div class="content-width">

            <h1>404</h1>
            <div class="line"><span></span></div>
            <div class="btn-filter">
                
            </div>
            <div class="yachts-content">
                {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
            </div>
        </div>
    </section>

@endsection

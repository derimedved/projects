<header>
    <div class="top-line">
        <div class="left">
            <div class="select-block ">
                <label class="form-label" for="lang"></label>
                <select id="lang">
                    <option value="1" data-display="English">English</option>
                    <option value="2">Русский</option>
                </select>
            </div>
        </div>
        @if (has_nav_menu('top_navigation'))
        <div class="right">
            <ul>
                @if (is_user_logged_in()&&$acf_options->add_yachting_page)
                <li><a href="{{ get_permalink($acf_options->add_yachting_page) }}">{{ get_the_title($acf_options->add_yachting_page)}}</a></li>
                @endif
                {!! wp_nav_menu([
                    'theme_location' => 'top_navigation',
                    'menu_id'        => '',
                    'menu_class'      => '',
                    'container'       => '',
                    'container_class' => '',
                    'container_id'    => '',
                    'items_wrap' => '%3$s',
                ]) !!}
            </ul>
        </div>
        @endif
    </div>
    <div class="second-line">
        <div class="content-width">
            <div class="logo">
                <a href="{{ get_home_url() }}">
                    @if ($acf_options->logo)
                        <img src="{{ $acf_options->logo->sizes->{'250x150'} }}" alt="{{ $acf_options->logo->alt }}">
                    @endif
                </a>
            </div>
            <nav class="top-menu">
                <ul>
                    {!! wp_nav_menu([
                        'theme_location' => 'primary_navigation',
                        'menu_id'        => '',
                        'menu_class'      => '',
                        'container'       => '',
                        'container_class' => '',
                        'container_id'    => '',
                        'items_wrap' => '%3$s',
                    ]) !!}
                    @if (!is_user_logged_in())
                    <li><a href="#login" class="fancybox">{{ __('Login','yachting') }}</a></li>
                    <li><a href="#register" class="fancybox">{{ __('Register','yachting') }}</a></li>
                    @else
                    <li><a href="{{ wp_logout_url(get_home_url()) }}">{{ __('Log out','yachting') }}</a></li>
                    @endif
                </ul>
                <a href="#" class="menu-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
            </nav>
        </div>
    </div>
</header>

<div class="menu-responsive">
    <div class="menu-wrap">
        <a href="#" class="close-menu"><i class="fal fa-times"></i></a>
        <h2>{{ $acf_options->footer_menu_title_1?:__('Menu','yachting') }}</h2>
        <ul>
            {!! wp_nav_menu([
                  'theme_location' => 'primary_navigation',
                  'menu_id'        => '',
                  'menu_class'      => '',
                  'container'       => '',
                  'container_class' => '',
                  'container_id'    => '',
                  'items_wrap' => '%3$s',
              ]) !!}
            @if (!is_user_logged_in())
            <li><a href="#login" class="fancybox">{{ __('Login','yachting') }}</a></li>
            <li><a href="#register" class="fancybox">{{ __('Register','yachting') }}</a></li>
            @else
            <li><a href="{{ wp_logout_url(get_home_url()) }}">{{ __('Log out','yachting') }}</a></li>
            @endif
        </ul>
    </div>
</div>

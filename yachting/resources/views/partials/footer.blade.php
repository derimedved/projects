<footer>
    <div class="content-width footer">
      @if (has_nav_menu('footer_navigation_1'))
        <div class="item item-1">
            <h3>{{ $acf_options->footer_menu_title_1?:__('INFORMATION','yachting') }}</h3>
            <div class="line"><span></span></div>
            <ul class="default-list">
                {!! wp_nav_menu([
                    'theme_location' => 'footer_navigation_1',
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
        @if (has_nav_menu('footer_navigation_2'))
        <div class="item item-2">
            <h3>{{ $acf_options->footer_menu_title_2?:__('EXPLORE','yachting') }}</h3>
            <div class="line"><span></span></div>
            <ul class="default-list">
                {!! wp_nav_menu([
                    'theme_location' => 'footer_navigation_2',
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
        @if ($acf_options->social||$acf_options->logos)
        <div class="item item-3">
            @if ($acf_options->social)
            <ul class="soc">
                @foreach ($acf_options->social as $soc)
                    <li><a href="{{ $soc->link->url }}" target="_blank"><i class="{{ $soc->icon }}"></i></a></li>
                @endforeach
            </ul>
            @endif
            @if ($acf_options->social&&$acf_options->logos)
            <div class="line"><span></span></div>
            @endif
            @if ($acf_options->logos)
            @foreach ($acf_options->logos as $logo)
              <figure>
                <img src="{{ $logo->sizes->{'250x150'} }}" alt="{{ $logo->alt }}">
              </figure>
            @endforeach
            @endif
        </div>
        @endif
    </div>
</footer>



    @if ($map)
    	
    <script>
		function initMap() {

			var options = { lat: {{ $map->lat }}, lng: {{ $map->lng }} };

			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 15,
				center: { lat: {{ $map->lat }}, lng: {{ $map->lng }} },
				mapTypeControl: false,
				scrollwheel: false,
				zoomControl: false,
				disableDefaultUI: true,

			});

			var marker = new google.maps.Marker({
				position: options,
				map: map,
				icon: {
					url: '{{ ASSETS }}img/map.png',
					labelOrigin: new google.maps.Point(14, 19)
				}
			});

		}
	</script>

<script async defer
		src="https://maps.googleapis.com/maps/api/js?key={{ $acf_options->gapikey }}&callback=initMap">
		</script>

        
    @endif

@if (!is_user_logged_in()) 
<div id="login" class="popup-site popup-login" style="display: none;">
    <div class="main-wrap">
        <form action="#" class="form-default ajax_form">
            <h3>{{ __('Login','yachting') }}</h3>
            <div class="input-wrap">
                <label for="email-login">{{ __('Email address','yachting') }} *</label>
                <input type="email" id="email-login" name="email" required="required"
                    placeholder="example@mail.com">
            </div>
            <div class="input-wrap">
                <label for="password-login">{{ __('Password','yachting') }} *</label>
                <input type="password" id="password-login" name="password" required="required">
            </div>
            <div class="status"></div>
            <div class="input-wrap-submit">
                <button type="submit" class="btn-default btn-blue">{{ __('Log in','yachting') }}</button>
            </div>
            <p>{{ __('Not a member yet?','yachting') }}</p>
            <div class="input-wrap-last">
                <a href="#register" class="btn-default btn-blue fancybox1">{{ __('Register','yachting') }}</a>
            </div>
            <input type="hidden" name="action" value="ajax_login">
            <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
        </form>
    </div>
</div>

<div id="register" class="popup-site popup-sign popup-login" style="display: none;">
    <form action="#" class="form-default ajax_form">
        <h3>{{ __('Create an account','yachting') }}</h3>
        <div class="input-wrap">
            <label for="email-sign">{{ __('Email address','yachting') }} *</label>
            <input type="email" id="email-sign" name="email" required="required" placeholder="example@mail.com">
        </div>
        <div class="input-wrap">
            <label for="password-sign">{{ __('Password','yachting') }} *</label>
            <input type="password" id="password-sign" name="password" required="required">
        </div>
        <div class="input-wrap">
            <label for="role">{{ __('Register as','yachting') }}</label>
            <div class="select-block select-block-mini">
                <select name="role" id="role">
                    <option value="customer" select>{{ __('Customer','yachting') }}</option>
                    <option value="boat_owner">{{ __('Boat Owner','yachting') }}</option>
                </select>
            </div>
        </div>
        <div class="status"></div>
        <div class="input-wrap-submit">
            <button type="submit"  class="btn-default btn-blue">{{ __('Sign up','yachting') }}</button>
        </div>
        <p>{{ __('Not a member yet?','yachting') }}</p>
        <div class="input-wrap-last">
            <a href="#login" class="btn-default btn-blue fancybox2">{{ __('Login','yachting') }}</a>
        </div>
        <input type="hidden" name="action" value="ajax_registration">
        <?php wp_nonce_field( 'ajax-registration-nonce', 'security' ); ?>
    </form>
</div>

@endif
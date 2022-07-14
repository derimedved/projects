<style type="text/css">

  .acf-map {
    width: 100%;
    height: 100%;
    border: #ccc solid 1px;
  }

  .acf-map img {
     max-width: inherit !important;
  }

</style>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmCk1wJlt4VHE8zgCBGdYzXayOKKZY-M8"></script> -->
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7Q82l2QjSzJJk1uUW3OzUBGPTlbk8w1g&libraries=places&v=3.exp&callback=initMap" defer></script>-->

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7Q82l2QjSzJJk1uUW3OzUBGPTlbk8w1g&callback=initMap">
</script>
<script type="text/javascript">

  jQuery(document).ready(function($) {

    function new_map( $el ) {

      var $markers = $el.find('.marker');

      var args = {
        zoom    : 16,
        center    : new google.maps.LatLng(0, 0),
        mapTypeId : google.maps.MapTypeId.ROADMAP
      };

      var map = new google.maps.Map( $el[0], args);

      map.markers = [];

      $markers.each(function(){
        
          add_marker( $(this), map );
        
      });

      center_map( map );

      return map;
      
    }

    function add_marker( $marker, map ) {

      var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

      var marker = new google.maps.Marker({
        position  : latlng,
        map     : map
      });

      map.markers.push( marker );

      if( $marker.html() )
      {

        var infowindow = new google.maps.InfoWindow({
          content   : $marker.html()
        });

        google.maps.event.addListener(marker, 'click', function() {

          infowindow.open( map, marker );

        });
      }

    }

    function center_map( map ) {

      var bounds = new google.maps.LatLngBounds();

      $.each( map.markers, function( i, marker ){

        var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

        bounds.extend( latlng );

      });

      if( map.markers.length == 1 )
      {
          map.setCenter( bounds.getCenter() );
          map.setZoom( 16 );
      }
      else
      {

        map.fitBounds( bounds );
      }

    }

    var map = null;

    $(document).ready(function(){

      $('.acf-map').each(function(){

        map = new_map( $(this) );

      });

    });
  });

</script>
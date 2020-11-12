<?php
#
# Action Hooks
#
add_action( 'wp_enqueue_scripts', function() {
	wp_register_style( 'fontawesome', EASYCITY_URL.'/assets/css/all.min.css');
	wp_enqueue_style( 'fontawesome' );

	wp_register_style( 'childstyle', EASYCITY_URL.'/assets/css/style.css');
  wp_enqueue_style( 'childstyle' );
  
  wp_register_script('scrollspy', EASYCITY_URL.'/assets/js/scrollspy.js', array('jquery'),'1.1', true);
  wp_enqueue_script('scrollspy');
  
  wp_register_script('jquery.sticky', EASYCITY_URL.'/assets/js/jquery.sticky.js', array('jquery'),'1.1', true);
	wp_enqueue_script('jquery.sticky');

	wp_register_script('childscript', EASYCITY_URL.'/assets/js/script.js', array('jquery'),'1.1', true);
	wp_enqueue_script('childscript');

	wp_dequeue_script('google_map_api');
}, 11);

add_action( 'init', function() {
  register_post_type( 'apartment',
    array(
      'labels' => array(
        'name' => __( 'Apartments' ),
        'singular_name' => __( 'Apartment' )
      ),
      'public' => true,
      'has_archive' => true,
      'supports' => array( 'thumbnail', 'excerpt', 'title' ),
	  'taxonomies' => array('post_tag')
    )
  );
});

add_action( 'pre_get_posts', function( $query ) {
  if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
    return;
  }
  if ( ! empty( $query->query['name'] ) ) {
    $query->set( 'post_type', array( 'post', 'apartment', 'page' ) );
  }
});

add_action('acf/init', function() {
	acf_update_setting('google_api_key', 'AIzaSyAxwPVD6tCrXE9q1qQ889-9VUDkKMGMGn4');
});

add_action( 'wp_footer', function() {
	if ( is_singular( 'apartment' ) ) :
  ?>
	<div class="popgal">
		<div class="popgal-overlay"></div>
		<div class="popgal-close"><i class="far fa-times-circle"></i></div>
		<img src="<?php echo $gallery[0]['url']; ?>">
		<div class="popgal-controls">
			<div class="popgal-prev"><i class="fa fa-chevron-left"></i></div>
			<div class="popgal-next"><i class="fa fa-chevron-right"></i></div>
		</div>
	</div>
	<div class="popcontact">
		<div class="popcontact-overlay"></div>
		<div class="popcontact-close"><i class="far fa-times-circle"></i></div>
		<div class="popcontact-content">
			<?php echo do_shortcode('[contact-form-7 id="1085" title="Contact Form ( Apartment )"]') ?>
		</div>
	</div>
<?php endif;
} );

add_action('init',function(){
  function get_locations()
  {
    $locations = [];
  
    $apartments = new WP_Query([
      'post_type'       => 'apartment',
      'posts_per_page'  => -1
    ]);
  
    foreach($apartments->posts as $post){
      $gmap = get_field('google_map',$post->ID);
  
      if ( !in_array($gmap['address'],array_map(function ($loc) { return $loc[0]; },$locations)) )
      {
        $locations[] = [
          'price'       => number_format(get_field('price',$post->ID)),
          'thumb'       => get_the_post_thumbnail_url($post),
          'address'     => get_field('address',$post->ID),
          'mapAddress'  => $gmap['address'],
          'lat'         => (float) $gmap['lat'],
          'lng'         => (float) $gmap['lng'],
          'id'          => $post->ID,
          4
        ];
      }
    }

    return $locations;
  }

  function get_apartments_by_location()
  {
    $locations = [];

    $monetize = function($amount){
      return '$'.number_format($amount);
    };

    $result = new WP_Query([
        'post_type'       => 'apartment',
        'posts_per_page'  => -1
    ]);

    // Group by location
    foreach($result->posts as $key => $post)
    {
        $gmap = get_field('google_map',$post->ID);
        $locations[$gmap['address']][$key] = [
          'priceInt'   => (int)get_field('price',$post->ID),
          'price'      => $monetize(get_field('price',$post->ID)),
          'thumb'      => get_the_post_thumbnail_url($post),
          'address'    => get_field('address',$post->ID),
          'mapAddress' => $gmap['address'],
          'lat'        => (float) $gmap['lat'],
          'lng'        => (float) $gmap['lng'],
          'title'      => $post->post_title,
          'url'        => get_post_permalink($post->ID),
          'id'         => $post->ID
        ];
    }

    // Format
    $formated = [];
    foreach($locations as $key=>$item)
    {
      $loc = array_values($item);
      $minMaxPrice = count($loc)>1 ? 
        $monetize(min(array_column($loc, 'priceInt'))).'-'.$monetize(min(array_column($loc, 'priceInt'))) :
        $monetize($loc[0]['priceInt'])
      ;
      $formated[] = [
        'address'    => $key,
        'id'         => $loc[0]['id'],
        'lat'        => $loc[0]['lat'],
        'lng'        => $loc[0]['lng'],
        'thumb'      => $loc[0]['thumb'],
        'priceRange'=> $minMaxPrice,
        'apartments' => array_values($loc)
      ];
    }

    return $formated;
  }

  // if(isset($_GET['debug']))
  // dd(
  //   get_apartments_by_location()
  // );

},10);
<?php
#
# Action Hooks
#

$this->action('init', function() {
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

$this->action('init',function(){
    function get_locations()
    {
        $locations = [];
    
        $apartments = new WP_Query([
            'post_type'       => 'apartment',
            'posts_per_page'  => -1
        ]);
    
        foreach($apartments->posts as $post)
        {
            $locations[] = get_field('address',$post->ID);
        }

        return array_unique($locations);
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
                $monetize(min(array_column($loc, 'priceInt'))).'-'.$monetize(max(array_column($loc, 'priceInt'))) :
                $monetize($loc[0]['priceInt'])
            ;
            $formated[] = [
                'address'    => $key,
                'id'         => $loc[0]['id'],
                'lat'        => $loc[0]['lat'],
                'lng'        => $loc[0]['lng'],
                'thumb'      => $loc[0]['thumb'],
                'priceRange' => $minMaxPrice,
                'apartments' => array_values($loc)
            ];
        }

        return $formated;
    }

    function get_room_types()
    {
        $result = get_posts(array(
            'numberposts'	=> -1,
            'post_type'		=> 'apartment'
        ));
        $mapped = array_map(function($post){
            return get_field('type_of_room',$post->ID);
        },$result);
        $uniq = array_unique($mapped);
        sort($uniq);
        return $uniq;
    }

    function get_max_price()
    {
        $result = get_posts(array(
            'numberposts'	=> -1,
            'post_type'		=> 'apartment'
        ));
        $prices = array_map(function($post){
            return get_field('price',$post->ID);
        },$result);
        sort($prices);
        return (int)max($prices);
    }

    function get_rooms()
    {
        $result = get_posts(array(
            'numberposts'	=> -1,
            'post_type'		=> 'apartment'
        ));
        $baths = array_map(function($post){
            return get_field('baths',$post->ID);
        },$result);
        $baths = array_unique($baths);
        sort($baths);
        return $baths;
    }

});

$this->action( 'pre_get_posts', function( $query ) {
  if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
    return;
  }
  if ( ! empty( $query->query['name'] ) ) {
    $query->set( 'post_type', array( 'post', 'apartment', 'page' ) );
  }
});

$this->action('acf/init', function() {
	acf_update_setting('google_api_key', 'AIzaSyAxwPVD6tCrXE9q1qQ889-9VUDkKMGMGn4');
});

$this->action( 'wp_footer', function() {
    if ( is_singular( 'apartment' ) ) : 
        view()->section('popgal');
    endif;
});

$this->action('wp_enqueue_scripts', function(){
  global $post;
  
  // enqueue assets only for apartments
  if ( $post->post_type == 'apartment' )
  {
    wp_enqueue_style('ec_bulma');
    wp_enqueue_style('ec_all');
    wp_enqueue_style('ec_jquery-ui');
    wp_enqueue_style('ec_style');
    wp_enqueue_script('ec_scrollspy');
    wp_enqueue_script('ec_jquery-ui');
    wp_enqueue_script('ec_jquery');
    wp_enqueue_script('ec_single');
  }
},99);


$this->action(isset($_GET['debug'])?'init':'xxxx', function(){

    $posts = get_posts(array(
        'numberposts'	=> -1,
        'post_type'		=> 'apartment'
    ));
    
    foreach($posts as $post)
    {
        $id = $post->ID;
        $date = get_field('availability',$id);
        $date = DateTime::createFromFormat('d/m/Y', $date);
        $date = $date->format('Ymd');

        dump(
            update_field('availability', $date, $id)
        );  
    }

    dd();
});
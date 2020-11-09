<?php
if ( $query->have_posts() ) :
    while ( $query->have_posts() ) : 
        $query->the_post();

        $gmapAddress = get_field('google_map')['address'];

        $gallery = get_field('gallery');

        include('apartment-repeat.php');
    endwhile; wp_reset_postdata();
endif; 
?>
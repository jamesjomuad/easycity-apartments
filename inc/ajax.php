<?php
#
# Ajax
#
add_ajax('load_apartments',function(){
    $paged = $_POST['page'];
    $args = [];
    $args['post_type'] = 'apartment';
    $args['paged'] = $paged;

    // Filter
    if( isset($_POST['filter']) ){
        $meta_query = ['relation' => 'OR'];
        foreach($_POST['filter'] as $k=>$filter){
            array_push($meta_query,[
                'key'     => $k,
                'value'   => $filter,
                'compare' => 'LIKE',
            ]);
        }
        $args['meta_query'] = $meta_query;
    }

    echo view('apartment-loop',['query' => new WP_Query($args)]);
});

add_ajax('map_pop',function(){
    echo view('map-popup');
});
<?php
#
# Ajax
#


#
#   Infinite load
#
add_ajax('partment_list',function(){
    $paged              = $_POST['page'];
    $args               = [];
    $args['post_type']  = 'apartment';
    $args['paged']      = $paged;

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

    view('apartment-loop',['query' => new WP_Query($args)]);
});

add_ajax('partment_list_back',function(){
    $paged              = $_POST['page'];
    $args               = [];
    $args['post_type']  = 'apartment';
    $args['paged']      = $paged;

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

    view('apartment-loop',['query' => new WP_Query($args)]);
});


#
#   Apartment Search
#
add_ajax('search_apartments',function(){
    
    // view('apartment-loop',['query' => new WP_Query($args)]);
});
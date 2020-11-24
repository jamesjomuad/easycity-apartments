<?php
#
#   Ajax Registration
#   Add Ajax using $this->ajax('name',function)
#


#
#   Apartment Listing
#
$this->ajax('partment_list',"ListingController");

/*
$this->ajax('partment_list',function(){
    $paged              = $_POST['page'];
    $args               = [];
    $args['post_type']  = 'apartment';
    $args['paged']      = $paged;

    // Filter
    if( input('filter') )
    {
        dd(input());

        $meta_query = ['relation' => 'OR'];
        foreach(array_filter( input('filter') ) as $k=>$filter){
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
*/

$this->ajax('partment_list_copy',function(){
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

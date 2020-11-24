<?php

class ListingController 
{
    public function index()
    {
        $paged              = $_POST['page'];
        $args               = [];
        $args['post_type']  = 'apartment';
        $args['paged']      = $paged;

        // Filter
        // if( input('filter') )
        // {
        //     $meta_query = ['relation' => 'OR'];
        //     foreach(array_filter( input('filter') ) as $k=>$filter){
        //         array_push($meta_query,[
        //             'key'     => $k,
        //             'value'   => $filter,
        //             'compare' => 'LIKE',
        //         ]);
        //     }
        //     $args['meta_query'] = $meta_query;
        // }

        return view('apartment-loop',['query' => new WP_Query($args)]);
    }

}
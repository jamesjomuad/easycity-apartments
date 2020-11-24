<?php

/**
 * Apartment Listing Controller
 */
class ListingController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->index();
    }

    private function index()
    {
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
    }

}

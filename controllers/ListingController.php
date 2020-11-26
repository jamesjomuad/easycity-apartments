<?php

class ListingController 
{
    public function index()
    {
        $args               = [];
        $args['post_type']  = 'apartment';
        $args['paged']      = input('page');

        // Filter
        if( input('filter') )
        {
            $args['meta_query'] = $this->filterQuery();
        }

        return [
            'per_page' => get_option( 'posts_per_page' ),
            'html'     => view('apartment-loop',['query' => new WP_Query($args)])->get(),
            'args'     => $args
        ];
    }

    private function filterQuery()
    {
        $input = array_filter( input('filter') );
        
        $meta_query = ['relation' => 'OR'];

        foreach($input as $k=>$filter)
        {
            if($k=='in')
            {
                array_push($meta_query,[
                    'key'     => 'availability',
                    'value'   => Carbon\Carbon::parse(input('filter.in'))->format("Y-m-d"),
                    'compare' => '>=',
                    'type'    => 'DATE'
                ]);
            }
            else if($k=='out')
            {
                array_push($meta_query,[
                    'key'     => 'availability',
                    'value'   => Carbon\Carbon::parse(input('filter.in'))->format("Y-m-d"),
                    'compare' => '<=',
                    'type'    => 'DATE'
                ]);
            }
            else
            {
                array_push($meta_query,[
                    'key'     => $k,
                    'value'   => $filter,
                    'compare' => 'LIKE',
                ]);
            }
        }

        return $meta_query;
    }

}
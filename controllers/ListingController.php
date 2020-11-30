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
            'meta_query'=> $args['meta_query'],
            'params'   => input('filter')
        ];
    }

    private function filterQuery()
    {
        $input = array_filter( input('filter') );
        $meta_query = ['relation' => "AND"];

        // Date IN & OUT
        array_push($meta_query,[
            'key'     => 'availability',
            'value'   => [
                Carbon\Carbon::parse(input('filter.in'))->format("Y-m-d") . ' 00:00:00',
                Carbon\Carbon::parse(input('filter.out'))->format("Y-m-d") . ' 00:00:00'
            ],
            'compare' => 'BETWEEN',
            'type'    => 'DATE'
        ]);

        // Location
        if(input('filter.neighbourhood'))
        array_push($meta_query,[
            'key'     => 'Neighbourhood',
            'value'   => input('filter.neighbourhood'),
            'compare' => 'LIKE'
        ]);

        // Number of Rooms
        if(input('filter.room'))
        array_push($meta_query,[
            'key'     => 'room',
            'value'   => input('filter.room'),
            'compare' => '=',
        ]);

        // Room Type
        if(input('filter.type'))
        array_push($meta_query,[
            'key'     => 'type_of_room',
            'value'   => input('filter.type'),
            'compare' => '=',
        ]);

        // Number of Baths
        if(input('filter.baths'))
        array_push($meta_query,[
            'key'     => 'baths',
            'value'   => input('filter.baths'),
            'compare' => '=',
        ]);

        // Price Range
        if(input('filter.price_range'))
        {
            $priceRange = explode('-',input('filter.price_range'));
            $priceRange[0] = filter_var($priceRange[0], FILTER_SANITIZE_NUMBER_INT);
            $priceRange[1] = filter_var($priceRange[1], FILTER_SANITIZE_NUMBER_INT);

            if($priceRange[1] !=get_max_price())
            {
                array_push($meta_query,[
                    'key'     => 'price',
                    'value'   => $priceRange,
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC'
                ]);
            }
        }

        return $meta_query;
    }

}
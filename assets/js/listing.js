(function($){
    $.search = {
        name: "Search listing filter",
        version: '1.0.0',
        form: $('#ec-search-form'),
        filter: false,
        rules: {
            in: {
                required: true
            },
            out: {
                required: true
            }
        }
    }

    let self = $.search;

    self.init = function(){
        var $this = this;

        // Search Filter
        $(document).on('ready', this.onReady);

        // Search Form submit
        this.form.on('submit', this.onSearch);
    
        // Clear
        $('#ec-clear').on('click', this.onClear);

        $this.form.validate({ rules: $this.rules });
    }

    self.fetch = function(filter){
        var $loader  = $('#loader');
        var paged    = $loader.data('page');
        var nextPage = parseInt(paged) + 1;
        var request  = null;
        
        if( $loader.data('status')!="loading" ){
            if(this.filter){
                filter = {filter:this.params()}
            }

            request = $.extend({ page: paged, action: 'partment_list', }, filter || {});

            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: request,
                error: function(response){
                    $loader.find('.loading').hide();
                    $loader.find('button').show();
                    $loader.data('status', false);
                },
                success: function(response){
                    if(response==''){
                        $('#loader .loading').hide()
                        $('#loader #ajax-message').show().text('Not Found!')
                    } else {
                        var lists = $(response);
                        var anchor = lists.find('a').addClass('v-hide');

                        $('#loader #ajax-message').hide();
                        $('#loader').data( 'page', nextPage )
                        $('.apartment_list ul').append(lists);

                        anchor.on('scrollSpy:enter',function(){
                            $(this).removeClass('v-hide')
                            $(this).addClass('v-show')
                        }).scrollSpy();
                    }
                    $loader.data('status', false);
                }
            });
            $loader.data('status','loading');
        }

        return this;
    };

    self.params = function(){
        return this.form.serializeArray();
    }

    self.onSearch = function(e){
        e.preventDefault();
        
        $('#loader').data('page',1);
        $.search.filter = true;
        $.search.fetch();
    }

    self.onClear = function(){
        $.search.filter = false;
        $('#loader').data('page',1)
        $(this).closest('form').find("input[type=text], select").val("");
        $.search.fetch();
    }

    self.onReady = function(){
        // Infinite load
        $('#loader button').on('click',function(){
            $('#loader').find('.loading').show();
            $('#loader').find('button').hide();
            setTimeout(function(){
                $.search.fetch()
            }, 3000);
        });

        // Init ScrollSpy
        $('#loader').on('scrollSpy:enter', function() {
            $.search.fetch()
        }).scrollSpy();

        $("#map").sticky({ topSpacing: 0 });

        $('#ec-filter').on('click', function(){
            $('#ec-filter-panel').toggleClass('is-hidden')
        });
        
        // Price range filter
        $( "#slider-range" ).slider();
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 1000,
            values: [ 0, 1000 ],
            slide: function( event, ui ) {
                $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            }
        });
        
        $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
        
        var datepicker = bulmaCalendar.attach('[type="date"]', {
            type: 'datetime',
            showFooter: false,
            displayMode: 'default'
        });

        $('#checkIn').on('click',function(){
            datepicker[1].hide()
        });
        $('#checkOut').on('click',function(){
            datepicker[0].hide()
        });
        $('body').on('click',function(){
            datepicker[0].hide()
            datepicker[1].hide()
        });
    }

    $.search.init();
}(jQuery));
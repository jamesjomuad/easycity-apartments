(function($){
    $.fn.serializeObject = function() {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };


    $.search = {
        name: "Search listing filter",
        version: '1.0.0',
        form: $('#ec-search-form'),
        ul: $('.apartment_list>ul'),
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

    self.get = function(filter){
        var $this    = this;
        var $loader  = $('#loader');
        var paged    = $loader.data('page');
        var nextPage = parseInt(paged) + 1;
        var request  = null;
        
        if( $loader.data('status')!="loading" ){
            if(this.filter){
                filter = {filter:this.form.serializeObject()}
            }

            request = $.extend({ page: paged, action: 'apartment_list', }, filter || {});

            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                dataType: 'json',
                data: request,
                error: function(response){
                    $loader.find('.loading').hide();
                    $loader.find('button').show();
                    $loader.data('status', false);
                },
                success: function(response){
                    if($this.filter){
                        var lists = $(response.html);
                        var anchor = lists.find('a').addClass('v-hide');

                        $('#loader #ajax-message').hide();
                        $('#loader').data( 'page', nextPage )
                        $('.apartment_list ul').append(lists);

                        // Domino show effect
                        anchor.on('scrollSpy:enter',function(){
                            $(this).removeClass('v-hide')
                            $(this).addClass('v-show')
                        }).scrollSpy();

                        $loader.data('status', false);
                        if(lists.length<=response.per_page){
                            $this.loader.hide()
                        }
                    }else{

                        if(response==''){
                            $('#loader .loading').hide()
                            $('#loader #ajax-message').show().text('Not Found!')
                        } else {
                            var lists = $(response.html);
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
                }
            });
            
            $loader.data('status','loading');
        }

        return this;
    };

    self.onSearch = function(e){
        e.preventDefault();
        var Search = $.search;
        if(Search.form.valid()){
            $('#loader').data('page',1);
            Search.filter = true;
            Search.list = Search.ul.find('li').remove();
            Search.loader.show();
            Search.get();
        }
    }

    self.onClear = function(){
        var Search = $.search;
        if(Search.filter==false)
        return;

        $('#loader').data('page',1)
        $(this).closest('form').find("input[type=text], select").not('#amount').val("");
        Search.filter = false;
        Search.ul.html(Search.list)
        Search.loader.show();
        Search.get();
    }

    self.onReady = function(){
        // Infinite load
        $('#loader button').on('click',function(){
            $('#loader').find('.loading').show();
            $('#loader').find('button').hide();
            setTimeout(function(){
                $.search.get()
            }, 3000);
        });

        // Init ScrollSpy
        $('#loader .loading').on('scrollSpy:enter', function() {
            $.search.get()
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

    self.loader = {
        loader: $('#loader .loading'),
        show: function(){
            $('#loader #ajax-message').hide();
            this.loader.show();
        },
        hide: function(){
            this.loader.hide()
        }
    }

    $.search.init();
}(jQuery));
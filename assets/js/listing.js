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
        },
        dateIn: null,
        dateOut: null,
        loader: $('#loader .loading'),
        loading: false
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

        // $this.form.validate({ rules: $this.rules });
    }

    self.initInfinite = function(){
        var $this = this;
        $('#loader .loading').on('scrollSpy:enter', function() {
            $this.get()
        }).scrollSpy();
        return this;
    }

    self.get = function(filter){
        var $this    = this;
        var $loader  = $('#loader');
        var paged    = $loader.data('page');
        var nextPage = parseInt(paged) + 1;
        var request  = null;

        if( !$this.isLoading() ){
            $this.loading = true;
            $this.loader.show()

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
                    $loader.find('button').show();
                    $loader.data('status', false);
                },
                success: function(response){
                    var lists = $(response.html);
                    var anchor = lists.find('a').addClass('v-hide');

                    if($this.filter){
                        if(response.html==''){
                            var message = 'Not Found!';
                            if($('#checkIn').val()!=''){message='No Room Available During Your Booking Duration';}
                            $('#loader #ajax-message').show().text(message);
                            $this.loader.hide()
                        }else{
                            $('#loader #ajax-message').hide();
                            $('#loader').data( 'page', nextPage )
                            $('.apartment_list ul').append(lists);
                        }

                        if(lists.length<=response.per_page){
                            $this.loader.hide()
                        }
                    }else{
                        if(response.html==''){
                            $('#loader #ajax-message').show().text('Not Found!');
                            $this.loader.hide()
                        }else{
                            $('#loader #ajax-message').hide();
                            $('#loader').data( 'page', nextPage )
                            $('.apartment_list ul').append(lists);
                            $this.loader.show();
                        }
                    }

                    // Domino show effect
                    anchor.on('scrollSpy:enter',function(){
                        $(this).removeClass('v-hide')
                        $(this).addClass('v-show')
                    }).scrollSpy();

                    $this.loading = false;
                }
            });
        }

        return this;
    };

    self.isLoading = function(){
        return this.loading===true;
    }

    self.onSearch = function(e){
        e.preventDefault();
        var Search = $.search;
        if(Search.filter==false){
            Search.list = Search.ul.find('li').remove();
        }
        else{
            Search.ul.find('li').remove();
        }
        $('#loader').data('page',1);
        Search.filter = true;
        Search.get();
    }

    self.onClear = function(){
        var Search = $.search;
        $('#loader').data('page',1)
        $(this).closest('form').find("input[type=text], select").not('#amount').val("");
        Search.filter = false;
        Search.ul.html(Search.list);
        Search.loader.show();
        Search.list.find('a.v-hide').on('scrollSpy:enter',function(){
            $(this).removeClass('v-hide')
            $(this).addClass('v-show')
        }).scrollSpy();
        Search.initInfinite();
        $( "#slider-range" ).slider("values", 0, 0);
        $( "#slider-range" ).slider("values", 1, $('#amount').data('max'));
    }

    self.onReady = function(){
        var Search = $.search;

        // Infinite load
        $('#loader button').on('click',function(){
            Search.loader.show();
            $('#loader').find('button').hide();
            setTimeout(function(){
                $.search.get()
            }, 3000);
        });

        // Init Infinite listener
        Search.initInfinite()

        $("#map").sticky({ topSpacing: 0 });

        $('#ec-filter').on('click', function(){
            $('#ec-filter-panel').toggleClass('is-hidden')
        });
        
        // Price range filter
        $( "#slider-range" ).slider();
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: $('#amount').data('max'),
            values: [ 0, $('#amount').data('max') ],
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

        Search.dateIn = datepicker[0];
        // Search.dateOut = datepicker[1];
        
        Search.dateIn.minDate = new Date;
        // Search.dateOut.minDate = new Date;

        /* Fixed form issue */
        Search.form.find('.datepicker button').not('[type="button"]').attr('type','button');

        // BulmaCalendar extra actions
        // $('#checkIn').on('click',function(){
        //     datepicker[1].hide()
        // });
        // $('#checkOut').on('click',function(){
        //     datepicker[0].hide()
        // });
        $('body').on('click',function(){
            datepicker[0].hide()
            // datepicker[1].hide()
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
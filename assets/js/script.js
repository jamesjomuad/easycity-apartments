(function($){
	function getApartments(request){
		var $loader  = $('#loader')
		var paged 	 = $loader.data('page')
		var nextPage = parseInt(paged)+1

		if( $loader.data('status')!="loading" ){
			$.ajax({
				url: '/wp-admin/admin-ajax.php',
				type: 'POST',
				data: $.extend({ page: paged, action: 'load_apartments', }, request || {}),
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

						$('#loader').hide();
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
	};

	$(document).ready(function(){
		var awrap 	= $('.apartment-wrap').first(),
			apar 	= awrap.closest('.vc_row'),
			body	= $('body'),
			jspopgal= $('.js-popgal');
		
		awrap.appendTo(apar);

		/* For Gallery Popup Slider */
		if ( jspopgal.length ) {
			var popgal 		= $('.popgal'),
				popgalNav 	= $('.popgal-next, .popgal-prev', popgal),
				gal 		= $('.gallery'),
				galNav 		= $('.gallery-prev, .gallery-next', gal),
				popgalClose = $('.popgal-close', popgal),
				popgalImg 	= $('img', popgal),
				popContact 	= $('.popcontact'),
				popContactX	= $('.popcontact-close', popContact),
				jsContact 	= $('.jscontact'),
				jsGall 		= $('.jsgall'),
				spric 		= $('.sticky_price_tag').first();

			/* Change position to outside the theme wrappers */
			popgal.appendTo(body);
			spric.appendTo(body);

			/* Show Gallery Popup Slider on thumbnail Click */
			jspopgal.click(function(){
				var image 	= $(this),
					imgurl  = image.data('image');
				jspopgal.removeClass('active');
				image.addClass('active');
				popgalImg.fadeOut('fast', function(){
					popgalImg.on("load", function() {
				        $(this).fadeIn('fast');
				    }).attr("src", imgurl);
				})
				popgal.addClass('shown').fadeIn('slow');
			});

			/* Previous and Next buttons */
			$('.image_wrap div', gal).first().addClass('show');
			galNav.click(function(){
				var isPrev = $(this).hasClass('gallery-prev'),
					active = $('.image_wrap .show', gal),
					nextImage = isPrev ? active.prev() : active.next();
				if ( !nextImage.length ) {
					nextImage = isPrev ? jspopgal.last() : jspopgal.first();
				}
				active.removeClass('show');
				nextImage.addClass('show');
			});

			/* Previous and Next buttons */
			popgalNav.click(function(){
				var isPrev = $(this).hasClass('popgal-prev'),
					active = $('.js-popgal.active'),
					nextImage = isPrev ? active.prev() : active.next();
				if ( !nextImage.length ) {
					nextImage = isPrev ? jspopgal.last() : jspopgal.first();
				}
				nextImage.click();
			});

			/* Close buttons */
			popgalClose.click(function(){
				popgal.fadeOut('fast', function(){
					popgal.removeClass('shown');
				});
			});

			jsGall.click(function(){
				jspopgal.first().click();
			});


			/* set apartment */
			$('#apartmentid').val($('#hidden_apartmentid').text());
			$('#apartmentname').val($('#hidden_apartmentname').text());
			$('#apartmenturl').val($('#hidden_apartmenturl').text());

			/* jscontact */
			jsContact.click(function(){
				popContact.addClass('shown').show();
			});

			/* Close buttons */
			popContactX.click(function(){
				$('.wpcf7-response-output').hide();
				popContact.fadeOut('fast', function(){
					popContact.removeClass('shown');
				});
			});

			$(document).keydown(function(e){
				var code = e.keyCode || e.which;
				
				switch(code) {
					// esc
					case 27:
						popgalClose.click()
					break;
					// previous
					case 37:
						$('.popgal-prev').click()
					break;
					// next
					case 39:
						$('.popgal-next').click()
					break;
				}
			});
		}

		$("#map").sticky({ topSpacing: 0 });
	});

	// Infinite Load
	$(document).on('ready',function(){
		$('#loader button').on('click',function(){
			$('#loader').find('.loading').show();
			$('#loader').find('button').hide();
			setTimeout(function(){
				getApartments()
			}, 3000);
		});

		$('#loader').on('scrollSpy:enter', function() {
			getApartments()
		}).scrollSpy();
	});

	// Search Filter
	$(document).on('ready', function(){
		$('#ec-filter').on('click', function(){
			$('#ec-filter-panel').toggleClass('is-hidden')
		});
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
	});

}(jQuery))
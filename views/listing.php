<div class="ec_apartments">
	<div class="apartment_list_wrap">
		<div class="apartment_list">
			<ul style="min-width: 320px;width: 100%;">
				<?php
					// Put initial query here
					$query = new WP_Query( ['post_type' => 'apartment'] );
					include('apartment-loop.php') 
				?>
			</ul>
			<div id="loader" data-page="2" style="text-align:center;margin:30px 0;">
				<h2 id="ajax-message" style="font-size: 20px;text-align: center;display: block;width: 650px;font-weight: 600;"></h2>
				<div class="loading" style="display:flex;flex-direction:row;flex-wrap: wrap;align-items: center;justify-content: space-around;">
					<svg role="img" width="320" height="315" aria-labelledby="loading-aria" viewBox="0 0 320 315" preserveAspectRatio="none" > <title id="loading-aria">Loading...</title> <rect x="0" y="0" width="100%" height="100%" clip-path="url(#clip-path)" style='fill: url("#fill");' ></rect> <defs> <clipPath id="clip-path"> <rect x="12" y="321" rx="2" ry="2" width="140" height="10" /> <rect x="10" y="253" rx="2" ry="2" width="315" height="10" /> <rect x="10" y="11" rx="2" ry="2" width="315" height="223" /> <rect x="10" y="274" rx="2" ry="2" width="315" height="10" /> <rect x="10" y="295" rx="2" ry="2" width="250" height="10" /> </clipPath> <linearGradient id="fill"> <stop offset="0.599964" stop-color="#f3f3f3" stop-opacity="1" > <animate attributeName="offset" values="-2; -2; 1" keyTimes="0; 0.25; 1" dur="2s" repeatCount="indefinite" ></animate> </stop> <stop offset="1.59996" stop-color="#ecebeb" stop-opacity="1" > <animate attributeName="offset" values="-1; -1; 2" keyTimes="0; 0.25; 1" dur="2s" repeatCount="indefinite" ></animate> </stop> <stop offset="2.59996" stop-color="#f3f3f3" stop-opacity="1" > <animate attributeName="offset" values="0; 0; 3" keyTimes="0; 0.25; 1" dur="2s" repeatCount="indefinite" ></animate> </stop> </linearGradient> </defs> </svg>
					<svg role="img" width="320" height="315" aria-labelledby="loading-aria" viewBox="0 0 320 315" preserveAspectRatio="none" > <title id="loading-aria">Loading...</title> <rect x="0" y="0" width="100%" height="100%" clip-path="url(#clip-path)" style='fill: url("#fill");' ></rect> <defs> <clipPath id="clip-path"> <rect x="12" y="321" rx="2" ry="2" width="140" height="10" /> <rect x="10" y="253" rx="2" ry="2" width="315" height="10" /> <rect x="10" y="11" rx="2" ry="2" width="315" height="223" /> <rect x="10" y="274" rx="2" ry="2" width="315" height="10" /> <rect x="10" y="295" rx="2" ry="2" width="250" height="10" /> </clipPath> <linearGradient id="fill"> <stop offset="0.599964" stop-color="#f3f3f3" stop-opacity="1" > <animate attributeName="offset" values="-2; -2; 1" keyTimes="0; 0.25; 1" dur="2s" repeatCount="indefinite" ></animate> </stop> <stop offset="1.59996" stop-color="#ecebeb" stop-opacity="1" > <animate attributeName="offset" values="-1; -1; 2" keyTimes="0; 0.25; 1" dur="2s" repeatCount="indefinite" ></animate> </stop> <stop offset="2.59996" stop-color="#f3f3f3" stop-opacity="1" > <animate attributeName="offset" values="0; 0; 3" keyTimes="0; 0.25; 1" dur="2s" repeatCount="indefinite" ></animate> </stop> </linearGradient> </defs> </svg>
				</div>
				<button type="button" style="padding:15px;border:1px solid #cccccc;border-radius:3px;display:none;"><i class="fa fa-refresh fa-2x"></i></button>
			</div>
		</div>
	</div>
	<div class="apartment_map">
		<div id="map-wrap" style="height: 50vw;width: 100%;position: relative;float: right;margin-right: -30px;">
			<div id="map" style="background:#DB8D60;position:absolute;overflow:hidden;min-height:500px;width:100%;height:100%;"></div>
		</div>
	</div>
</div>

<div class="spacer"></div>

<!-- Map Popup Template -->
<div id="mapop" class="col-xs-12 col-sm-6 infowindow_map" style="display: none;">
	<div class="mapop-content">
		<a href="#">
			<img src="" alt="">
		</a>
		<div class="result-item__price nosale center col-xs-12">
			<span class="currency">from $<span class="price"></span>/night</span>
		</div>
		<div class="col-xs-12 text-center" style="margin-bottom: 20px;">
			<div class="col-xs-12 no-padding">
				<span class="prop_title">
					<a href="#"><b class="prop-title"></b></a>
				</span>
			</div>
		</div>
	</div>
</div>

<script>
	function initMap(){
		var locations = <?php echo json_encode(get_locations()) ?>;
		var $ = jQuery;
		window.map = new google.maps.Map(document.getElementById('map'), {
			zoom: 12,
			center: {lat: 1.359290759715824, lng: 103.8654550109253},
			zoomControl: false,
			zoomControlOptions: { position: google.maps.ControlPosition.LEFT_CENTER },
			streetViewControlOptions: { position: google.maps.ControlPosition.LEFT_TOP },
		});
		var infowindow = new google.maps.InfoWindow();
		var markerIcon = '<?php echo EASYCITY_URL.'/assets/images/marker.png' ?>'

		window.htmlContent = function (data) {
			var content = document.getElementById('mapop').innerHTML;
			var $html = $(content);
			var $url = $html.find('a');
			var $img = $html.find('img');
			var $title = $html.find('.prop-title');
			var $price = $html.find('.price');

			$title.text(data.address).attr('href','#'+data.mapAddress);
			$price.text(data.price);
			$img.attr('src',data.thumb);
			$url.attr('data-location',data.mapAddress).attr('href','#'+data.mapAddress);

			return $html[0];
		}
		window.propertyMouseover = function (e) {
			var prop_id = e.id;
			google.maps.event.trigger(markers[prop_id], "dblclick");
		}
		window.propertyMouseout = function (e) {
			var prop_id = e.id;
			google.maps.event.trigger(markers[prop_id], "mouseout");
		}
		window.propertyDirection = function (e) {
			var prop_id = $(e).data("id");
			google.maps.event.trigger(markers[prop_id], "onblur");
		}
		window.clearOverlays = function () {
			for (var key in markers) {
				markers[key].setMap(null);
			}
			markers = {};
		}
		window.addHtmlMarker = function(location) {
			var g_lat = location.lat
			var g_long = location.lng
			var prop_id = location.id
			var address = location.mapAddress
			var marker;

			marker = new google.maps.Marker({
				position: new google.maps.LatLng(g_lat, g_long),
				map: map,
				icon: markerIcon,
				label: {
					text: address,
					color: "#fff",
					fontSize: "0px",
					fontWeight: "bold"
				}
			});
			marker[address] = marker;
			bounds.extend(marker.position);
			google.maps.event.addListener(marker, 'mouseover', (function (marker) {
				return function () {
					marker.setIcon(markerIcon);
					infowindow.setContent(htmlContent(location));
					infowindow.open(map, marker);
					$('.markers_infowindow').closest('.gm-style-iw').parent().addClass('custom-iw');
				}
			})(marker));
			google.maps.event.addListener(marker, 'mouseout', (function (marker) {
				return function () {
					marker.setIcon(markerIcon);
				}
			})(marker));
			google.maps.event.addListener(marker, 'dblclick', (function (marker) {
				return function () {
					marker.setIcon(markerIcon);
					infowindow.close();
				}
			})(marker));
			google.maps.event.addListener(marker, 'onblur', (function (marker) {
				return function () {
					time_distance(marker);
					infowindow.close();
				}
			})(marker));
			google.maps.event.addListener(map, 'click', (function (marker) {
				return function () {
					marker.setIcon(markerIcon);
					infowindow.close();
				}
			})(marker));
			marker.addListener('mouseover', function () {
				infowindow.open(map, marker);
			});
		}

		var bounds = new google.maps.LatLngBounds();
		$.each(locations, function (i, item) {
			addHtmlMarker(locations[i])
		});
		map.fitBounds(bounds);
	}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxwPVD6tCrXE9q1qQ889-9VUDkKMGMGn4&callback=initMap"></script>

<?php wp_reset_query(); ?>

<style>
	.gm-style .gm-style-iw-d{overflow: hidden!important;}
	.gm-style-iw.gm-style-iw-c{padding: 0;}
	.mapop-content{text-align: center;}
	.mapop-content a img { width: 280px; height: 160px; object-fit: cover; }
	.mapop-content a{display: block;}
	.mapop-content .currency {display: block;margin: 5px;}
	.mapop-content .prop_title { font-weight: 600; margin: 5px 0; display: block; max-width: 280px; }
	.gm-style .gm-style-iw-t::after{top:-1px;}
</style>
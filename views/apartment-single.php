<?php
	get_header();

	$gallery 		= get_field('gallery');
	$type_of_room 	= get_field('type_of_room');
	$inclusives		= get_field_object('inclusives');
	$availability 	= get_field('availability');
	$features 		= get_field('features');
	$amenities 		= get_field('amenities');
	$neighbourhood 	= get_field('Neighbourhood');
	$nearby 		= get_field('nearby');
	$google_map 	= get_field('google_map');
	$avatar 		= get_field('avatar');
	$agent 			= get_field('agent');
	$email 			= get_field('email');
	$phone 			= get_field('phone');
	$website 		= get_field('website');
?>

<span id="hidden_apartmentid" class="hidden"><?php the_ID(); ?></span>
<span id="hidden_apartmentname" class="hidden"><?php the_title(); ?></span>
<span id="hidden_apartmenturl" class="hidden"><?php the_permalink(); ?></span>

<section class="apartment_banner hide_on_mobile" style="background-image: url(<?php echo $gallery[0]['sizes']['large']; ?>);">
	<a class="jsgall"></a>
	<div class="apartment_wrap">
		<a class="jsgall"></a>
		<div class="banner_content">
			<span class="apartment_type"><?php echo $type_of_room; ?></span>
			<span class="apartment_location"><?php the_field('address') ?></span>
			<h1><?php the_title(); ?></h1>
			<ul class="featured_items">
				<?php if ( $room = get_field('room') ) : ?>
					<li>
						<i class="fa fa-bed"></i>
						<div><?php echo $room; ?></div>
						<div class="label">Room</div>
					</li>
				<?php endif; ?>
				<?php if ( $baths = get_field('baths') ) : ?>
					<li>
						<i class="fa fa-bath"></i>
						<div><?php echo $baths; ?></div>
						<div class="label">Bath</div>
					</li>
				<?php endif; ?>
				<?php if ( $area = get_field('area') ) : ?>
					<li>
						<i class="fa fa-ruler-combined"></i>
						<div><?php echo $area; ?></div>
						<div class="label">sqft</div>
					</li>
				<?php endif; ?>
				<?php if ( $deposit = get_field('deposit') ) : ?>
					<li>
						<i class="fa fa-dollar"></i>
						<div>$<?php echo number_format($deposit); ?></div>
						<div class="label">Deposit</div>
					</li>
				<?php endif; ?>
			</ul>
			<div class="price_tag">
				<small>Monthly Price</small>
				<div class="main_price">$<?php echo number_format(get_field('price')); ?></div>
				<div class="deposit">Available: <strong><?php the_field('availability'); ?></strong></div>
				<div class="whatsapp">
					<a class="whatsapp-button" href="https://wa.me/6597894980?text=Hello, I'm interested in a <?php the_title(); ?>." target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp call-icon"></i> <span> WHATSAPP CHAT</span></a>
				</div>
				<button class="jscontact">Email</button>
			</div>
			<button class="jsgall btn"><i class="far fa-images"></i> View Gallery</button>
		</div>
	</div>
</section>

<section class="apartment_wrap">
	<div class="apartment_container">
		<div class="apartment_content">
			<?php if ( $gallery ) : ?>
				<div class="gallery">
					<div class="image_wrap">
						<?php foreach ($gallery as $image ) : ?>
							<div data-image="<?php echo $image['sizes']['large']; ?>" style="background-image: url(<?php echo $image['sizes']['large']; ?>);" class="js-popgal"></div>
						<?php endforeach; ?>
					</div>
					<div class="gallery-controls show_on_mobile">
						<div class="gallery-prev"><i class="fa fa-chevron-left"></i></div>
						<div class="gallery-next"><i class="fa fa-chevron-right"></i></div>
					</div>
				</div>
			<?php endif; ?>

			<div class="apartment_details">
				<div class="show_on_mobile">
					<h2><?php the_title(); ?></h2>
					<div class="apartment_type"><?php echo $type_of_room; ?></div>
					<div class="apartment_location"><?php the_field('address') ?></div>
					<ul class="featured_items">
						<?php if ( $beds = get_field('beds') ) : ?>
							<li>
								<i class="fa fa-bed"></i>
								<div><?php echo $beds; ?></div>
								<div class="label">Room</div>
							</li>
						<?php endif; ?>
						<?php if ( $baths = get_field('baths') ) : ?>
							<li>
								<i class="fa fa-bath"></i>
								<div><?php echo $baths; ?></div>
								<div class="label">Bath</div>
							</li>
						<?php endif; ?>
						<?php if ( $area = get_field('area') ) : ?>
							<li>
								<i class="fa fa-ruler-combined"></i>
								<div><?php echo $area; ?></div>
								<div class="label">sqft</div>
							</li>
						<?php endif; ?>
						<?php if ( $deposit = get_field('deposit') ) : ?>
							<li>
								<i class="fa fa-dollar"></i>
								<div>$<?php echo number_format($deposit); ?></div>
								<div class="label">Deposit</div>
							</li>
						<?php endif; ?>
					</ul>
				</div>

				<h4>Description</h4>
				<?php the_field('description') ?>
				<br><br>

				<?php if ( $inclusives ) : ?>
					<h4>Inclusives</h4>
					<ul class="check_list inclusives">
						<?php foreach($inclusives['choices'] as $inclusive) : ?>
						<li>
							<?php if(in_array($inclusive, $inclusives['value'])): ?>
								<i class="fa fa-check"></i> <span><?php print $inclusive; ?></span>
							<?php else : ?>
								<i class="fa fa-times" style="color:grey;"></i> <span style="color:grey;text-decoration:line-through;"><?php print $inclusive; ?></span>
							<?php endif; ?>
						</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<br><br>

				<?php if ( $features ) : ?>
					<h4>Features</h4>
					<ul class="check_list features">
						<li><i class="fa fa-check"></i> <?php echo implode('</li><li><i class="fa fa-check"></i> ', $features); ?></li>
					</ul>
				<?php endif; ?>
				<br><br>

				<?php if ( $amenities ) : ?>
					<h4>Amenities</h4>
					<ul class="check_list amenities">
						<li><i class="fa fa-check"></i> <?php echo implode('</li><li><i class="fa fa-check"></i> ', $amenities); ?></li>
					</ul>
				<?php endif; ?>
				<br><br>

				<?php if ( $neighbourhood ) : ?>
					<h4>Neighbourhood</h4>
					<ul class="check_list neighbourhood">
						<li><i class="fa fa-check"></i> <?php echo implode('</li><li><i class="fa fa-check"></i> ', $neighbourhood); ?></li>
					</ul>
				<?php endif; ?>
				<br><br>

				<?php if ( $nearby ) : ?>
					<h4>Nearby</h4>
					<ul class="check_list nearby">
						<li><i class="fa fa-check"></i> <?php echo implode('</li><li><i class="fa fa-check"></i> ', $nearby); ?></li>
					</ul>
				<?php endif; ?>
				<br><br>

				<div id="apartmentmap" class="apartmentmap"></div>
			    <script>

			      function initMap() {
			        var myLatLng = {lat: <?php echo $google_map['lat']?>, lng: <?php echo $google_map['lng']?>};

			        var map = new google.maps.Map(document.getElementById('apartmentmap'), {
			          zoom: 14,
			          center: myLatLng
			        });

			        var image = {
			          url: '<?php echo site_url(); ?>/images/ec-bedicon-v2.png',
			          // This marker is 20 pixels wide by 32 pixels high.
			          size: new google.maps.Size(31, 42),
			          // The origin for this image is (0, 0).
			          origin: new google.maps.Point(0, 0),
			          // The anchor for this image is the base of the flagpole at (0, 32).
			          anchor: new google.maps.Point(0, 32)
			        };

			        var marker = new google.maps.Marker({
			          position: myLatLng,
			          map: map,
	            	  icon: image,
			          title: '<?php echo addslashes($google_map['address'])?>'
			        });
			      }
			    </script>
			    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxwPVD6tCrXE9q1qQ889-9VUDkKMGMGn4&callback=initMap">
			    </script>
			</div>
		</div>
		<div class="apartment_sidebar">
			<div class="sticky_side">
				<div class="apartment_actions">
					<div class="action_content">
						<h5>Contact Info</h5>
						<?php if ( $avatar ) : ?>
							<div class="details">
								<div class="avatar" style="background-image:url(<?php echo $avatar['sizes']['medium']; ?>)"></div>
							</div>
						<?php endif; ?>
						<?php if ( $agent ) : ?>
							<div class="details">
								<i class="far fa-user"></i>
								<span><?php echo $agent; ?></span>
							</div>
						<?php endif; ?>
						<?php if ( $email ) : ?>
							<div class="details">
								<i class="far fa-envelope"></i>
								<span><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></span>
							</div>
						<?php endif; ?>
						<?php if ( $phone ) : ?>
							<div class="details">
								<i class="fa fa-mobile-alt"></i>
								<span><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></span>
							</div>
						<?php endif; ?>
						<?php if ( $website ) : ?>
							<div class="details">
								<i class="fa fa-link"></i>
								<span><a href="<?php echo $website; ?>" target="_blank"><?php echo $website; ?></a></span>
							</div>
						<?php endif; ?>
					</div>
					<div class="whatsapp">
						<a class="whatsapp-button" href="https://wa.me/6597894980?text=Hello, I'm interested in a <?php the_title(); ?>." target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp call-icon"></i> <span> WHATSAPP CHAT</span></a>
					</div>
					<button class="jscontact"> Contact </button>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="show_on_mobile sticky_price_tag">
	<div class="deposit">Available: <strong><?php the_field('availability'); ?></strong></div>
	<button class="jscontact">Apply for $<?php echo number_format(get_field('price')); ?> / month</button>
</div>


<?php wp_reset_query(); ?>

<div id="similar_apartment">
<?php echo do_shortcode('[elementor-template id="2585"]'); ?>
</div>

<?php get_footer(); ?>
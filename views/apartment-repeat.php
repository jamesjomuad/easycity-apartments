<li data-address="<?php echo $gmapAddress; ?>">
    <a href="<?php the_permalink() ?>" class="apartment">
        <span class="price">$<?php echo number_format(get_field('price')); ?></span>
        <span class="type"><?php the_field('type_of_room'); ?></span>
        <div class="gallery">
            <div class="image_wrap" style="background-image:url(<?php echo $gallery[0]['sizes']['medium']; ?>);">
                <img src="<?php echo $gallery[0]['sizes']['medium']; ?>">
            </div>
        </div>
        <div class="apartment_details">
            <h3><?php the_title(); ?></h3>
            <p><?php the_field('address'); ?></p>
            <div class="divider"></div>
            <div class="features">
                <span class="bed"><i class="fa fa-bed"></i> <?php the_field('room'); ?> Room</span>
                <span class="bath"><i class="fa fa-bath"></i> <?php the_field('baths'); ?> Bath</span>
                <span class="size"><i class="fa fa-ruler-combined"></i> <?php the_field('area'); ?> sqft</span>
            </div>
        </div>
    </a>
</li>
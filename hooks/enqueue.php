<?php

$this
    # CSS
    ->registerCss( 'ec_bulma', 'bulma.min.css')
    ->registerCss( 'ec_bulma-calendar', 'bulma-calendar.min.css')
    ->registerCss( 'ec_all', 'all.min.css')
    ->registerCss( 'ec_jquery-ui', 'jquery-ui.css')
    ->registerCss( 'ec_style', 'style.css')

    # Javascript
    ->registerJs( 'ec_scrollspy', 'scrollspy.js')
    ->registerJs( 'ec_jquery', 'jquery.sticky.js')
    ->registerJs( 'ec_jquery-ui', 'jquery-ui.js')
    ->registerJs( 'ec_bulma-calendar', 'bulma-calendar.min.js')
    ->registerJs( 'ec_validate', 'jquery.validate.js')
    ->registerJs( 'ec_single', 'single.js')
    ->registerJs( 'ec_listing', 'listing.js')
;
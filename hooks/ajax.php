<?php
#
#   Ajax Registration
#   Add Ajax using $this->ajax('name',function)
#


#
#   Apartment Listing
#
$this->ajax('apartment_list',"ListingController@index");

$this->ajax('test',"TestController");
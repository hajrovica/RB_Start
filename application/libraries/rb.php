<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rb {

    function __construct() {
        // Include database configuration
        include(APPPATH.'/config/database.php');

        // Get Redbean
        include(APPPATH.'/third_party/rb/rb.php');

        // Database data
        $host = $db[$active_group]['hostname'];
        $user = $db[$active_group]['username'];
        $pass = $db[$active_group]['password'];
        $db = $db[$active_group]['database'];

        // Setup DB connection
        R::setup("mysql:host=$host;dbname=$db", $user, $pass);
    } //end __contruct()
} //end Rb

// Load the library like any other
// $this->load->library('rb');


// Do fun stuff with the beans in your controller:

// $album = R::dispense('album');
// $album->title = '13 Songs';
// $album->artist = 'Fugazi';
// $album->year = 1990;
// $album->rating = 5;
// $id = R::store($album);



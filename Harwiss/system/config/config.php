<?php
// show error reporting
error_reporting(E_ALL);
// home page url
$home_url="http://harwiss";

$familiy_name = "Harwiss";
// start php session
session_start();
 
// set your default time-zone
date_default_timezone_set('Europe/Oslo');

//Permission Levels
$OwnerLevel=99;
$AdminLevel=90;
$ModeratorLevel=50;
$UserLevel=20;
 ?>
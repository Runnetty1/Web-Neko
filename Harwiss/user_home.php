<?php
// core configuration
include_once "system/config/config.php";
// set page title
$page_title = "User Home";
 
// include login checker
$require_login=false;
include_once "login_checker.php";

include_once "system/layouts/layout_head.php";
include_once "system/layouts/layout_user_home.php";
include_once "system/layouts/layout_foot.php";
 
?>
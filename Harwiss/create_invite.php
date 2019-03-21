<?php
// core configuration
include_once "system/config/config.php";
// set page title
$page_title = "Home";
 
// include login checker
$require_login=true;
include_once "login_checker.php";

include_once "system/layouts/layout_head.php";
include_once "system/layouts/layout_create_invite.php";
include_once "system/layouts/layout_foot.php";
 
?>
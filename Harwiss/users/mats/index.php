<?php
// core configuration
include_once "../../system/config/config.php";
// set page title
$page_title = "redir";
if( $_GET["user"] ) {
	header("Location: $home_url/user_home?user=".$_GET["user"]."&view=about");
}else{
	header("Location: $home_url/user_home?user=mats&view=about");
}
?>
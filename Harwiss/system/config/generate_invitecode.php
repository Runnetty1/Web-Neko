<?php

include_once "config.php";
include_once "database.php";
// Define mail
$email = $_POST['email'];
$serial = $_POST['serial'];

$to = "mats1992@gmail.com";
$subject = "Invite to Web-Neko";
$txt = "Hello
	You have officialy been invited to Web-Neko!
	Bellow is your Invite Code and link to register page";
$headers = "From: mats1992@gmail.com";

echo "sending email to: ".$email . "<br>";
echo "their invite code: ".$serial . "<br>";

register_invitedata($email,$serial);


function register_invitedata($uemail,$userial){
 global $dbh, $msg;
 $dbh = new Database();
  $s = "mysql:host=$dbh->host;port=$dbh->port;dbname=$dbh->db_name;charset=utf8";
 $dbh = new PDO($s, 'root', '');

 $sql_insert = "INSERT INTO `accountdata` ( `email`, `permission_strength`) VALUES ( '".$uemail."','20')";
 $sql_insert2 = "INSERT INTO `invitecodes` ( `invitecode`) VALUES ( '".$userial."')";
 
/* Delete all rows from the FRUIT table */
$count = $dbh->exec($sql_insert);
$count = $dbh->exec($sql_insert2);

$query = $dbh->prepare('SELECT id FROM accountdata WHERE email = :email LIMIT 1;');
	$query->execute([':email' => $uemail]); 
	$query = $query->fetch();
	$id = $query["id"];
	echo "userid:".$query["id"];
	
$sql_insert3 = "UPDATE `invitecodes` SET `ownerid` = '$id' WHERE `invitecode` = '$userial'";
 $count = $dbh->exec($sql_insert3);
}

//mail($to,$subject,$txt,$headers);
 
 //header("Location: $home_url");
?>
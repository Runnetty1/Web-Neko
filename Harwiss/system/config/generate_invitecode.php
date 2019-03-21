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

$vemail = false;
$vserial = false;

if($_POST && isset($_POST['email'])&& isset($_POST['serial']))
{ 

	//sanitize email, and serial
	//check that serial does not exist
	//check that email does not exist.
	//Make sure Serial consists of 3*5letters bound by a '-' and 
	//does not contain any letters that has been banned by each part
	check_email($email);
	check_serial($serial);
	if($vemail && $vserial){
		register_invitedata($email,$serial);
	}else{
		header("Location: $home_url/create_invite?action=invalid_data");
	}

}else{
	//no data! STOP EVERYTHING AND HIT THE FLOOR
	//set error cookies
	header("Location: $home_url/create_invite?action=invalid_data");
}



//Send mail 
//Head back


function check_email($uemail){
	$dbh = new Database();
	$dbh = new PDO($dbh->getdb(), $dbh->username, $dbh->password);
	
	$query = $dbh->prepare('SELECT id FROM accountdata WHERE email = :email;');
	$query->bindParam(":email",$uemail);
	$query->execute(); 
	$count = $query->rowCount();
	if($count === 0){
		//No Email
		//Make sure email is valid:
		echo "no email, checking validity<br>";
		$vemail=true;
	}else{
		//Head back with error cookie, email exist
		echo "email exist, heading back";
		
	}
}

function check_serial($userial){
	$dbh = new Database();
	$dbh = new PDO($dbh->getdb(), $dbh->username, $dbh->password);
	
	$query = $dbh->prepare('SELECT id FROM `invitecodes` WHERE `invitecode` = :serial;');
	$query->bindParam(":serial",$userial);
	$query->execute(); 
	$count = $query->rowCount();
	if($count === 0){
		//no serial
		echo "no serial, checking validity<br>";
		//Make sure serial is valid
		$vserial=false;
	}else{
		//Head back with error cookie, serial exist
		echo "email exist, heading back";
		//header("Location: $home_url/create_invite");
	}
}

//Do Register (make sure input is sanitized)
function register_invitedata($uemail,$userial){
 global $dbh, $msg;
 $dbh = new Database();
  
 $dbh = new PDO($dbh->getdb(), $dbh->username, $dbh->password);

 $sql_insert = "INSERT INTO `accountdata` ( `email`, `permission_strength`) VALUES ( :email,'20')";
 $sql_insert2 = "INSERT INTO `invitecodes` ( `invitecode`) VALUES ( :serial )";

$count = $dbh->prepare($sql_insert);
	$count->bindParam(":email",$uemail);
	$count->execute(); 
$count2 = $dbh->prepare($sql_insert2);
	$count2->bindParam(":serial",$userial);
	$count2->execute(); 

$query = $dbh->prepare('SELECT id FROM accountdata WHERE email = :email LIMIT 1;');
	$query->execute([':email' => $uemail]); 
	$query = $query->fetch();
	$id = $query["id"];
	echo "userid:".$query["id"];
	
$sql_insert3 = "UPDATE `invitecodes` SET `ownerid` = :id WHERE `invitecode` = :serial";
	$count = $dbh->prepare($sql_insert3);
	$count->bindParam(":id",$query["id"]);
	$count->bindParam(":serial",$userial);
	$count->execute(); 
	echo "Sucess!";
}

//mail($to,$subject,$txt,$headers);
 
 //header("Location: $home_url");
?>
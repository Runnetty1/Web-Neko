<?php

include_once "config.php";
include_once "database.php";

$email = $_POST['email'];
$serial = $_POST['serial'];

// Define mail
$to = "mats1992@gmail.com";
$subject = "Invite to Web-Neko";
$txt = "Hello
	You have officialy been invited to Web-Neko!
	Bellow is your Invite Code and link to register page";
$headers = "From: mats1992@gmail.com";

$vemail = ".";
$vserial = ".";

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
		echo "Error:<br>Serial Validation: $vserial, Email Validation: $vemail ";
	//header("Location: $home_url/create_invite?action=invalid_data");
	}

}else{
	//no data! STOP EVERYTHING AND HIT THE FLOOR
	//set error cookies
	echo "Error:<br>Serial POST: ".isset($_POST['serial']).", Email Post not set:". isset($_POST['email'])."<br> ";
	//header("Location: $home_url/create_invite?action=invalid_data");
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
		
		$subChars1 = array('ACDFGHIJLMPQRSTUVXYZ','124569BCDEFGHIJKLNOPQRUVWXYZbcdefghijklmnopqruvwxyz','1234567890BCDEFGJKLMNOPQTUVXYZbcdefgjklmnopqtuv');
		
		$str_arr = explode ("-", $userial);
		echo $str_arr[0]."<br>";
		echo $str_arr[1]."<br>";
		echo $str_arr[2]."<br>";
		
		for($i = 0; i<3 $i++){
			if(checkSubString($str_arr[$i],$subChars1[$i])){
				$vserial=true;
			}else{
				$vserial=false;
				break;
			}
		}
		
	}else{
		//Head back with error cookie, serial exist
		echo "email exist, heading back";
		//header("Location: $home_url/create_invite");
	}
}

function checkSubString($string,$acceptedChars){
	foreach (str_split($string) as $char) {
        if (in_array($char, $acceptedChars)) {
            echo "Char: ".$char." -> OK";
        } else {
            echo "Char: ".$char." -> KO";
        }   
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
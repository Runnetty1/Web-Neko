<?php
// core configuration
include_once "system/config/config.php";
include_once "system/config/database.php";

ob_start();

// Define $myusername and $mypassword
$registerUsername = $_POST['username'];
$registerPW = $_POST['password'];
$registerPWC = $_POST['re-password'];
$registerInvCode = $_POST['invite-code'];

class RegisterUserData{
	
	public $salt;
    public $password_hash;
	public $invCode;
	
}



class LoginData {
    public $id;
    public $salt;
    public $password_hash;
	public $permission_strength;
     
    
	public function doLoginCheck($clearTextPW,$name){
		//hash cleartext pass
		if($this->password_hash===createHashFromTextAndSalt($clearTextPW,$this->salt))
		{
			echo"SUCESESS BOTH HASHES MACH PROCEED TO LOGIN";
			//Save User ID in session
			$_SESSION['user_id'] = $this->id;
			$_SESSION['access_level'] = $this->permission_strength;
			$_SESSION['logged_in'] = true;
			$_SESSION['nickname'] = $name;
			/*
			if ($_POST['_remember_me'] == true) 
			{
				setcookie("username", $name, time() + 60 * 60); // change nr to how long to remember details
				setcookie("password", $clearTextPW, time() + 60 * 60); // change nr to how long to remember details
				setcookie("remember", true, time() + 60 * 60); // change nr to how long to remember details
			} 
			else 
			{
				setcookie("username", $name, time() + 0); // change nr to how long to remember details
				setcookie("password", $clearTextPW, time() + 0); // change nr to how long to remember details
				setcookie("remember", false, time() + 60 * 60); // change nr to how long to remember details
			}*/
		}
		else
		{
			echo"<br> Error hash mismatch";
		}
	}
}


try {
     // first connect to database
	 $dbh = new Database();
     $db = new \PDO($dbh->getdb(), $dbh->username, $dbh->password [
       PDO::ATTR_EMULATE_PREPARES => false, 
       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
     ]); 
 } 
 catch(\PDOException $e)
 {
     // if connection fails, show PDO error. 
   echo "Error connecting to mysql: " . $e->getMessage();
 }
// check the invite code matches Email. 
if($_POST && isset($_POST['username'])&& isset($_POST['password']))
{ 
	$query = $db->prepare('SELECT id, salt, password_hash,permission_strength FROM accountdata WHERE username = :name LIMIT 1;');
	$query->execute([':name' => $loginUsername]); 
	$query->setFetchMode(PDO::FETCH_CLASS, 'LoginData');
	$query = $query->fetch();
	$query->doLoginCheck($loginPW,$loginUsername);

	header("Location: $home_url");
}
// check the passwords that they match.
// check that username is not taken.
// create the new account in db using data

/*
This hash function is just to easily create a hash for testing.But it is not secure.
A more complex system should be created and used instead.

Make sure to never upload your acctual hash algorithm publicly.
*/
function createHashFromTextAndSalt($t,$s)
{
	return hash('sha512', $t . $s);
}

ob_end_flush();


?>

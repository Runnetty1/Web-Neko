<?php
// core configuration
include_once "system/config/config.php";
include_once "system/config/database.php";

ob_start();

// Define $myusername and $mypassword
$loginUsername = $_POST['username'];
$loginPW = $_POST['password'];

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
			}
		}
		else
		{
			echo"<br> Error hash mismatch";
		}
	}
}
try {
	 $dbh = new Database();
  
     // first connect to database with the PDO object. 
     $db = new \PDO($dbh->getdb(), $dbh->username, $dbh->password, [
       PDO::ATTR_EMULATE_PREPARES => false, 
       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
     ]); 
 } 
 catch(\PDOException $e)
 {
     // if connection fails, show PDO error. 
   echo "Error connecting to mysql: " . $e->getMessage();
 }

if($_POST && isset($_POST['username'])&& isset($_POST['password']))
{ 
	$query = $db->prepare('SELECT id, salt, password_hash,permission_strength FROM accountdata WHERE username = :name LIMIT 1;');
	$query->execute([':name' => $loginUsername]); 
	$query->setFetchMode(PDO::FETCH_CLASS, 'LoginData');
	$query = $query->fetch();
	$query->doLoginCheck($loginPW,$loginUsername);

	header("Location: $home_url");
}

function createHashFromTextAndSalt($t,$s)
{
	return hash('sha512', $t . $s);
}

ob_end_flush();


?>
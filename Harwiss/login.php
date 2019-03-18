<?php
// core configuration
include_once "system/config/config.php";

ob_start();

$host = "localhost"; // Host name
$username = "root"; // Mysql username
$password = ""; // Mysql password
$db_name = "harwissdata"; // Database name
$tbl_name = "accountdata"; // Table name
// Connect to server and select databse.
// Define $myusername and $mypassword
$loginUsername = $_POST['username'];
$loginPW = $_POST['password'];

// To protect MySQL injection
//$loginUsername = stripslashes($loginUsername);
//$loginPass = stripslashes($loginPass);
//$loginUsername = mysqli_real_escape_string($link,$loginUsername);
//$loginPass = mysqli_real_escape_string($link,$loginPass);


class LoginData {
    public $id;
    public $salt;
    public $password_hash;
	public $permission_strength;
     
    
	public function doLoginCheck($clearTextPW,$name){
		//hash cleartext pass
		if($this->password_hash===createHashFromTextAndSalt($clearTextPW,$this->salt)){
			echo"SUCESESS BOTH HASHES MACH PROCEED TO LOGIN";
			//Save User ID in session
			$_SESSION['user_id'] = $this->id;
			$_SESSION['access_level'] = $this->permission_strength;
			$_SESSION['logged_in'] = true;
			$_SESSION['nickname'] = $name;
			if ($_POST['_remember_me'] == true) {
				setcookie("username", $name, time() + 60 * 60); // change nr to how long to remember details
				setcookie("password", $clearTextPW, time() + 60 * 60); // change nr to how long to remember details
				setcookie("remember", true, time() + 60 * 60); // change nr to how long to remember details
			} else {
				setcookie("username", $name, time() + 0); // change nr to how long to remember details
				setcookie("password", $clearTextPW, time() + 0); // change nr to how long to remember details
				setcookie("remember", false, time() + 60 * 60); // change nr to how long to remember details
				
			}
			
		}else{
			echo"<br> Error hash mismatch";
		}
	}
	
	
}
try {
     // first connect to database with the PDO object. 
     $db = new \PDO("mysql:host=localhost;port=3307;dbname=harwissdata;charset=utf8", "root", "", [
       PDO::ATTR_EMULATE_PREPARES => false, 
       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
     ]); 
 } catch(\PDOException $e){
     // if connection fails, show PDO error. 
   echo "Error connecting to mysql: " . $e->getMessage();
 }
//$pdo = new PDO("mysql:host=localhost;port=3307;dbname=harwissdata", 'root', '');

//$query = "SELECT id, salt, password_hash FROM accountdata where username = '$loginUsername'";
     
// PDO
//$result = $pdo->query($query);
//$result->setFetchMode(PDO::FETCH_CLASS, 'LoginData');
if($_POST && isset($_POST['username'])&& isset($_POST['password'])){ 
	$query = $db->prepare('SELECT id, salt, password_hash,permission_strength FROM accountdata WHERE username = :name LIMIT 1;');
	$query->execute([':name' => $loginUsername]); # No need to escape it!
	$query->setFetchMode(PDO::FETCH_CLASS, 'LoginData');
	$query = $query->fetch();
	$query->doLoginCheck($loginPW,$loginUsername);
	//$user = $result->fetch();
	 //$user->info();
	//$user->doLoginCheck($loginPW);
	header("Location: $home_url");

}



function createHashFromTextAndSalt($t,$s)
{
	return hash('sha512', $t . $s);
}


/*
if ($count == 1) {
// Register $username, $password and redirect to file "index.php"
    if ($_POST['_remember_me'] == true) {
        setcookie("username", $loginUsername, time() + 60 * 60); // change nr to how long to remember details
        setcookie("password", $loginPass, time() + 60 * 60); // change nr to how long to remember details
    } else {
        setcookie("username", $loginUsername, time() + 0); // change nr to how long to remember details
        setcookie("password", $loginPass, time() + 0); // change nr to how long to remember details
    }

    setcookie("error", false, time() + 0);
    setcookie("user", $loginUsername, time() + 60 * 60);
    setcookie("logged", true, time() + 60 * 60);

    //header("location:index.php");
} else {
    echo "Wrong Username or Password";
    //header("location:index.php");
    setcookie("error", true, time() + 10);
}*/

ob_end_flush();


?>
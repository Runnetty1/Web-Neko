<?php

class LoginData {
    public $id;
    public $salt;
    public $pw;
     
    public function info()
    {
        return '#'.$this->id.': '.$this->salt.' '.$this->pw;
    }
	public function doLoginCheck($idi){
		if($idi == $this->id){
			echo "Success";
		}else{
			echo "fail";
		}
	}
}

$pdo = new PDO("mysql:host=localhost;port=3307;dbname=harwissdata", 'root', '');

$query = "SELECT id, salt, pw FROM accountdata where accountname = 'Runnetty'";
     
// PDO
$result = $pdo->query($query);
$result->setFetchMode(PDO::FETCH_CLASS, 'LoginData');

$user = $result->fetch();
 //$user->info();
$user->doLoginCheck(2);

//for more than one data fetch:
 /*while ($user = $result->fetch()) {
    echo $user->info()."\n";
}
*/


?>
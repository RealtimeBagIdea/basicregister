<?php

$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = 'your_password';
$database = new mysqli($mysql_host, $mysql_user, $mysql_pass, 'registerdb');
if ($database->connect_errno)
{
    echo "Failed to connect to MySQL: " . $database->connect_error;
    exit();
}

if(checkData($_POST['username'], $_POST['password'], $_POST['email']))
{
	$user = $_POST['username'];
	$pass = md5($_POST['password']);
	$mail = $_POST['email'];
	$database->query("INSERT INTO user_info(Username,Password,Email) VALUES ('$user', '$pass', '$mail')");
	echo "Register Success";
}



function checkData($username, $password, $email)
{
	if(isset($username) && !empty($username) && isset($password) && !empty($password) && isset($email) && !empty($email))
	{
		return true;
	}
	else
	{
		return false;
	}
}

mysqli_close($database);

?>
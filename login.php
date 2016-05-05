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

if(checkData($_POST['username'], $_POST['password']))
{
	$user = $_POST['username'];
	$pass = md5($_POST['password']);

	$sql = "SELECT * FROM user_info WHERE Username='$user' AND Password='$pass'";
	if($result = $database->query($sql))
	{
		if($result->num_rows > 0)
		{
			echo "Login Success" . "<br>";
			while($obj = $result->fetch_assoc())
		    {
		        echo "Your Email is " . $obj['Email'] . "<br>";
		    }
		}
	    else
		{
			echo "Username or password is not correct";
		}
	    $result->close();
	}
	
}



function checkData($username, $password)
{
	if(isset($username) && !empty($username) && isset($password) && !empty($password))
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
<?php
require_once('db_connection.php');
//$conn = mysqli_connect("localhost","root","","Event Portal");
$conn = mysqli_connect("remotemysql.com","F6wy4ESYJR","ZUI1AztbHy","F6wy4ESYJR");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
$username = $password = $pwd = '';
$username = trim($_POST['email']);
$pwd = trim($_POST['password']);
$password = MD5($pwd);
$sql = "SELECT * FROM users WHERE Username='$username' AND Password='$password'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0)
{
	$row = mysqli_fetch_assoc($result);
		$id = $row["UserID"];
		$email = $row["Username"];
        $name = $row["Name"];
        $usertype = $row["UserType"];
        $acctime = $row["Created_at"];
		session_start();
        $_SESSION['loggedin'] = true;
		$_SESSION['id'] = $id;
		$_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['usertype'] = $usertype;
        $_SESSION['acctime'] = $acctime;
        if($usertype == "participant")
      {
        header("Location: ParticipantDashboard.php");
        exit;
      }
      else
      {
        header("Location: OrganiserDashboard.php");
        exit;
      }
	    
}
else
{
    echo $password;
	echo "Invalid email or password";
}
?>

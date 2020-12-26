<?php

  $user = check_param("user");
  $pass = check_param("pass");
    

  session_start();
        
  if ( checkPass($user, $pass)) {
       $_SESSION["login"] = $user_name;
       $_SESSION["begin"] = date("F j, Y, g:i:s a");
       header("Location: page-1.php");
  } else {
           // header("Location: index.php");
  }
    
function check_param($var) {
    if (!isset($_POST[$var]) || $_POST[$var] == "") {
        die("Error : missing required parameter '$var'");
    }
    return trim($_POST[$var]);
}

function checkPass($user_name, $user_pass) {
	include_once('./dbconnect.php');

	echo "<h1>Checking Login </h1>";
	$sql = "SELECT * FROM user WHERE name = '{$user_name}' ";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	$db_password = $row['password'];

	if( $user_pass == $db_password )
		$granted=true;
	else 
		$granted=false;

	return $granted;
}    

echo "<h1>multi row</h1>";
$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)) {
echo '<h2>'.$row['name'].'</h2>';
echo $row['email'];
echo $row['password'];
}


?>
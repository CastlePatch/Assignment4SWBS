<?php
$host='earth.cs.utep.edu';
$user='cs5339team7fa16';
$password='cs5339!cs5339team7fa16';
$database='cs5339team7fa16';

session_start();

if(isset($_POST['signout']))
  {
    session_destroy();    // destroy the session
    echo "<script>setTimeout(\"location.href = 'index.php';\",100);</script>";
  }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../lib/main.css">
</head>
<body>

<center>
<div class="header">
	<ul>
		<a href="#"><li>Alumni</li></a>
		<a href="#"><li>Profile</li></a>
		<a href="#"><li>Log In</li></a>
		<a href="/Assignment4SWBS/registration"><li>Register</li></a>
	</ul>
</div>
</center>

<center><h1>Login</h1></center>

<center>
  <p>Enter log in information.</p>
	<form name="form" method="post" action="">
		Enter username:<br>
		<input type="text" name="username">
		<br>
		Enter Password:<br>
		<input type="password" name="password">
		<br><br>
		<input type="submit" value="Login">
	</form>
</center>


</body>
</html>


<?php
// CONNECT TO DATABASE TO SEE IF YOU HAVE PERMISSION TO LOGIN
if(isset($_POST['username']) && $_POST['password'])
{
  /*CREATES CONNECTION */
  $connection = mysqli_connect($host, $user, $password);
  if(!$connection)
  {
    die('Could not connect: ' . mysql_error());
  }
  $connection->select_db("cs5339team7fa16");

  $username = $_POST['username'];
  $user_password = $_POST['password'];

  /* hash and salting to store in users table the hash function */
  $salt_string = "$%_!1-";
  $salt_username = $username;
  $salt_password = hash('ripemd128', "$salt_string.$salt_username.$user_password");

  $query = "SELECT * FROM users WHERE username='$username' and password='$salt_password'";
  $result = $connection->query($query);

  if ($result->num_rows)
  {
		//if user is found, create session
		  $_SESSION["login"] = 'on';
      $_SESSION["username"] = $username;
  }
  else // if user is not found
  {
    echo '<script type="text/javascript">alert("Username not found, type a diffent username");</script>';
  }
}

// SIGN OUT
if(isset($_SESSION['login']))
{
  echo "<br /><center>";
  echo "<form method='post' action='index.php'>";
  echo "<input type='submit' name='signout' value='SIGN OUT'>";
  echo "</form>";
  if($_SESSION['login']=='on')
  {
    echo "You are logged in";
  }
  echo "</center>";
}
?>

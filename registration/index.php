<?php
$host='earth.cs.utep.edu';
$user='cs5339team7fa16';
$password='cs5339!cs5339team7fa16';
$database='cs5339team7fa16';

session_start();
if(isset($_POST['signout'])) // if the user signs out, it destroys the session
  {
    session_destroy();    // destroy the session
    echo "<script>setTimeout(\"location.href = 'index.php';\",100);</script>";
  }
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Registration</title>
		<link rel="stylesheet" type="text/css" href="../lib/main.css">
	</head>
	<body>

		<center>
		<div class="header">
			<ul>
				<a href="#"><li>Alumni</li></a>
				<a href="#"><li>Profile</li></a>
				<a href="/Assignment4SWBS/login"><li>Log In</li></a>
				<a href="#"><li>Register</li></a>
			</ul>
		</div>
		</center>

	<center>
		<h1>
	Registration
	</h1>
	</center>

	<center>
		<p>Enter information to register.</p>
		<form name="form" method="post" action="index.php" onsubmit="return validate()">
			Create new Username to register:<br>
			<input type="text" name="username">
			<br><br>
			Enter First Name:<br>
			<input type="text" name="firstname">
			<br><br>
			Enter Last Name:<br>
			<input type="text" name="lastname">
			<br><br>
			Create New Password:<br>
			<input type="password" name="password">
			<br><br>
			Enter e-mail<br>
			<input type="text" name="email">
			<br><br>
			Enter Major:<br>
			<input type="text" name="major">
			<br><br>
			Enter Graduated Year:<br>
			<input type="text" name="year">
			<br><br>
			Enter Graduate Level:<br>
			<select name="level">
	  		<option value="und">Undergraduate</option>
	  		<option value="grad">Graduate</option>
		 </select>
	<br><br>
	<input type="submit" value="Register">
	</form>
	</center>


	</body>
	</html>

<?php
if(isset($_POST['username']) && $_POST['password'])
{
	$connection = mysqli_connect($host, $user, $password);

	if(!$connection)
	{
		die('Could not connect: ' . mysql_error());
	}
	//echo "connection successful";

	$connection->select_db("cs5339team7fa16");
	//echo "test";

	$username = $_POST['username'];
	$passw = $_POST['password'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$major = $_POST['major'];
	$year = $_POST['year'];
	$level = $_POST['level'];

	$salt_string = "$%_!1-"; // random salt string
	$salt_username = $username;
	$salt_password = hash('ripemd128', "$salt_string.$salt_username.$passw");

	//Query that checks if an username already exists in the record
	$result = $connection->query("SELECT username FROM users WHERE username = '$username'");
	if($result->num_rows == 0) {
	     // username not found
			 $sql = "INSERT INTO users (username, password, firstname, lastname, email, major, year, level)
			VALUES ('$username', '$salt_password', '$firstname', '$lastname', '$email', '$major', '$year', '$level')";

			if ($connection->query($sql) === TRUE)
			 {
				 echo "<center>";
				 echo "New User created successfully";
				 echo "</center>";
			 }
			else
			 {
				 echo "Error: " . $sql . "<br>" . $connection->error;
			 }
	}
	else
	{
	    // user already exists in the record
			echo '<script type="text/javascript">alert("Username already exists, type a different username");</script>';
	}
}

// SIGN OUT FORM
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

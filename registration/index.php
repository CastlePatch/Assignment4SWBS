<?php
$host='earth.cs.utep.edu';
$user='cs5339team7fa16';
$password='cs5339!cs5339team7fa16';
$database='cs5339team7fa16';

$db_longpre = "wb_longpre";

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
      Enter Username:<br>
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
	  		<option value="UG">Undergraduate</option>
	  		<option value="GR">Graduate</option>
        <option value="DR">Doctorate</option>
		 </select>
	<br><br>
	<input type="submit" value="Register">
	</form>
	</center>


	</body>
	</html>

<?php
if(isset($_POST['firstname']) && $_POST['password'] && $_POST['lastname'] && $_POST['level'])
{
	$connection = mysqli_connect($host, $user, $password);
  $connection_longpre = mysqli_connect($host, $user, $password);
	if(!$connection && !$connection_longpre)
	{
		die('Could not connect: ' . mysql_error());
	}

	$connection->select_db("cs5339team7fa16");
  $connection_longpre->select_db("wb_longpre");

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

  /* Query to check if the account exists*/
  $sql = "SELECT * FROM csdegrees WHERE FirstName='$firstname' AND LastName='$lastname' AND LevelCode='$level'";
  $result2 = $connection_longpre->query($sql);

  if ($result2->num_rows > 0) {
      while($row = $result2->fetch_assoc()) {
        $id = $row["id"];
        $sql = "INSERT INTO registered_users (id, username, password, firstname, lastname, email, major, year, level)
     VALUES ('$id', '$username', '$salt_password', '$firstname', '$lastname', '$email', '$major', '$year', '$level')";
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
  } else {
      echo '<script type="text/javascript">alert("No account linked to the record already exists");</script>';
  }
  $connection_longpre->close();



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

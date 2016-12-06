<?php 
	$host='earth.cs.utep.edu';
	$user='cs5339team7fa16';
	$password='cs5339!cs5339team7fa16';
	$database='cs5339team7fa16';

	$conn = mysqli_connect($host, $user, $password, $database);
  	if(!$conn){
		die('Could not connect: ' . mysql_error());
	}


	session_start();
	if(!isset($_SESSION['login']) || $_SESSION['login'] == ""){
		echo "<script>window.location = '../login/index.php'</script>";
	}
	if(isset($_POST['Title']) && isset($_POST['Content'])){
		$error = "";
		$title = sanitize($_POST['Title']);
		$content = sanitize($_POST['Content']);
		if(!isset($_POST['verificationToken']))
			echo "<script>window.location = '../login/index.php'</script>";
		$requestToken = $_POST['verificationToken'];

		if($requestToken != $_SESSION['verificationToken']){
			echo "<script>window.location = '../login/index.php'</script>";
		}

	//get the username
	$username = $_SESSION['username']

	//insert bulletin in table
		$date = new DateTime(DATE_ATOM);
		$status = 1;
		$query=$conn->prepare("INSERT INTO bulletins (User, Title, Content, Date, Status) VALUES (?, ?, ?, ?, ?)");
		$query->bind_param("ssssi",$username, $title, $content, $date, $status);
		$query->execute();
		$query->fetch();
		mysqli_stmt_close($query);
	}

	function verifyTitle($t){
		global $error;
		if($t.length() == 0)
			$error += "Title cannot be empty.<br>";
		else if($t.lenght() > 50)
			$error += "Title should be less than 50 characters.<br>";
		return $error;
	}

	function verifyContent($t){
		global $error;
		if($t.length() == 0)
			$error += "Title cannot be empty.<br>";
		else if($t.lenght() > 1000)
			$error += "Title should be less than 1000 characters.<br>";
		return $error;
	}

	function sanitize($string){
		global $conn;
		$string = mysqli_real_escape_string($conn,$string);
		$string = htmlentities($string);
		$string = htmlspecialchars($string);
		$string = stripcslashes($string);
		return $string;
	}
	mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bulletins</title>
	<link rel="stylesheet" type="text/css" href="../lib/main.css">
</head>
<body>

	<div class="header">
		<ul>
			<a href="../"><li>Alumni</li></a>
			<a href="../profile.php"><li>Profile</li></a>
			<a href="../login"><li>Log In</li></a>
			<a href="../register"><li>Register</li></a>
			<a href="index.php"><li>Bulletins</li></a>
		</ul>
	</div>

	<div class="main-content">
		<div class="bulletin-buttons">
			<button onclick="window.location = 'mybulletins.php'">My Bulletins</button>
			<button onclick="window.location = 'new.php'">New Bulletin</button>
		</div>
		<div class="bulletin-input">
			<h3>Bulletins</h3>
			<form action="new.php" method="POST" onsubmit="return validate()">
				<div>
					<div>Title:</div>
					<input type="text" name="Title" id="title">
				</div>
				<div>
					<div>Content:</div>
					<textarea type="text" name="Content" id="content"></textarea>
				</div>
					<?php 
						$date = date("Y-m-d H:i:s");
						$verificationToken = hash("sha256", $date);
						$_SESSION['verificationToken'] = $date;

						echo '<input type="hidden" name="verificationToken" value="' . $verificationToken . '">';
					 ?>
				<button type="submit">Submit</button>
			</form>
			<div id="error"></div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript" src="validation.js">
</script>
<?php 
	session_start();
	$error = "";


	function isLoggedIn(){
		if(isset($SESSION['id']))
			return true;
		return false;
	}

	function hasAccess(){
		if($_POST['id'])
	}	

	function validate(){
		global $error;
		$title = $_POST['title'];
		$content = $_POST['content'];

		$error = validateTitle($title);
		$error += validateContent($content);

		if(!$error){
			saveBulletin($title, $content);
		}
	}

	function validateTitle($title){
		$error = "";

		if($title.length > 50)
			$error = "Title should be less than 50 characters.<br>";
		else if($title.length == 0)
			$error = "Title cannot be empty.<br>";
		
		return $error;
	}

	function validateContent($content){
		$error = "";
		if($content.length > 1000)
			$error = "Content should be less than 1000 characters.<br>";
		else if($content.length == 0)
			$error =  "Content cannot be empty.<br>";
		return $error;
	}

	function saveBulletin($title, $content){

	}
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
			<button onclick="window.location = 'mybulletins.php'">New Bulletin</button>
			<button onclick="window.location = 'new.php'">New Bulletin</button>
		</div>
		<div class="bulletin-input">
			<h3>Bulletins</h3>
			<form action="edit.php" method="POST" onsubmit="return validate()">
				<div>
					<div>Title:</div>
					<input type="text" name="Title" id="title">
				</div>
				<div>
					<div>Content:</div>
					<textarea type="text" name="Content" id="content"></textarea>
				</div>
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<button type="submit">Submit</button>
			</form>
			<div id="error"><?=$error ?></div>
		</div>
	</div>

</body>
</html>
<script type="text/javascript" src="validation.js"></script>
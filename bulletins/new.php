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
				<button type="submit">Submit</button>
			</form>
			<div id="error"></div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript" src="validation.js">
</script>
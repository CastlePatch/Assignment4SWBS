<!DOCTYPE html>
<html>
<head>
	<title>Bulletins</title>
	<link rel="stylesheet" type="text/css" href="../lib/main.css">
</head>
<body>

	<div class="header">
		<ul>
			<a href="#"><li>Alumni</li></a>
			<a href="#"><li>Profile</li></a>
			<a href="#"><li>Log In</li></a>
			<a href="#"><li>Register</li></a>
		</ul>
	</div>

	<div class="main-content">
		<div class="bulletin-buttons">
			<button>My Bulletins</button>
			<button>New Bulletin</button>
		</div>
		<div class="bulletin-input">
			<h3>Bulletins</h3>
			<form action="new.php" method="POST">
				<div>
					<div>Title:</div>
					<input type="text" name="Title">
				</div>
				<div>
					<div>Content:</div>
					<textarea type="text" name="Content"></textarea>
				</div>
				<button type="submit">Submit</button>
			</form>
		</div>
	</div>

</body>
</html>
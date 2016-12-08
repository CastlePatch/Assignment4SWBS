<?php 

	session_start();

	if(!isset($_SESSION['login']) || $_SESSION['login'] == ""){
		header("Location: ../login/");
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
			<a href=""><li>Bulletins</li></a>
		</ul>
		<form action="../login/index.php" method="POST" class="logoff">
			<input type="hidden" name="signout" value="true">
			<button type="submit">Log off</button>
		</form>
	</div>

	<div class="main-content">
		<div class="bulletin-buttons">
			<button onclick="window.location = 'new.php'">New Bulletin</button>
		</div>
		<div class="bulletin-wrapper">
			<h3>Bulletins</h3>
			<div class="bulletins">
				
			<?php 
				$host='earth.cs.utep.edu';
				$user='cs5339team7fa16';
				$password='cs5339!cs5339team7fa16';
				$database='cs5339team7fa16';

				$conn = mysqli_connect($host, $user, $password, $database);
			  	if(!$conn){
					die('Could not connect: ' . mysql_error());
				}

				$query=$conn->prepare("SELECT * FROM bulletins WHERE Status = 1 ORDER BY ID DESC;");
				$query->execute();
				$bulletins = $query->get_result();
			    while ($myrow = $bulletins->fetch_assoc()) {
			    	echo '<div class="bulletin"><h4>' . $myrow['Title'] . '</h4>
							<div class="bulletin-content">
								' . $myrow['Content'] . '
							</div>
							<div class="creator">Creator of the bulletin: ' . $myrow['User'] . '</div>
							<div class="date">Date bulletin was created: ' . $myrow['Date'] . '</div></div>';
		    	}

				mysqli_stmt_close($query);
				mysqli_close($conn);
			?>
				
			</div>
		</div>
	</div>

</body>
</html>
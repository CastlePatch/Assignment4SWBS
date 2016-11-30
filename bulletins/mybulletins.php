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
		<div class="bulletin-wrapper">
			<h3>Bulletins</h3>
			<table class="bulletinTable">
				<thead>
						<th style="width:300px;">Title</th>
						<th colspan="2" style="width:100px;">Actions</th>
				</thead>
				<tbody>
					<tr>
						<td>Title of a bulletin</td>
						<td><button onclick="window.location = 'edit.php?id=1&mode=edit'">Edit</button></td>
						<td><button onclick="window.location = 'edit.php?id=1&mode=delete'">Delete</button></td>
					</tr>
				</tbody>
			</table>
			</div>
		</div>
	</div>

</body>
</html>
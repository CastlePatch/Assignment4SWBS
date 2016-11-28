<?php

$host='earth.cs.utep.edu';
$user='cs5339team7fa16';
$password='cs5339!cs5339team7fa16';
$database='cs5339team7fa16';

//colum id, AcademicYear, Term, LastName, FirstName, Major, LevelCode, Degree
//row int, rest VARCHAR


$conn = new mysqli($hos, $user, $password, $database);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>
<html>

<header>
<h1> Profile Page</h1>
</header>
<nav>
<ul>
<!--not loged in  -->
<li><a href="#">Alumni List</a></li>
<li><a href="#">Bulletin Board</a></li>
<li><a href="#"> Login</a></li>
<li><a href="#">register</a></li>

<!--loged in  -->

<li><a href="#">Alumni List</a></li>
<li><a href="#">Bulletin Board</a></li>
<li><a href="#"> Profile</a></li>
<li><a href="#">Logout</a></li>

<!-- photo -->


<!-- body main data 
grab from database the specific user that the user clik on-->

<p>         </p>
</ul>
</nav>
</html>


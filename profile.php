<?php

$host='earth.cs.utep.edu';
$user='cs5339team8fa16';
$password='cs5339!cs5339team8fa16';
$database='cs5339team8fa16';

//colum id, AcademicYear, Term, LastName, FirstName, Major, LevelCode, Degree
//row int, rest VARCHAR


$conn = new mysqli($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


//$id=$_GET['id'];
$id=1;
$query=$conn->prepare("SELECT FirstName, LastName, Term, AcademicYear, Major, LevelCode, Degree FROM wb_longpre.csdegrees WHERE id = ?;");
$query->bind_param("i",$id);
$query->execute();
$query->bind_result( $result['FirstName'], $result ['LastName'], $result['Term'], $result['AcademicYear'], $result['Major'], $result['LevelCode'], $result['Degree'] );
$query->fetch();
mysqli_stmt_close($query);
//echo $result['FirstName'], $result ['LastName'], $result['Term'], $result['AcademicYear'], $result['Major'], $result['LevelCode'], $result['Degree'];
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
<body>
<p> <?php echo  "the First Name is:".$result['FirstName'] ?>        </p>
<p> <?php echo "the Last Name is:". $result['LastName'] ?>        </p>
<p> <?php echo "the term is:".$result['Term'] ?>        </p>
<p> <?php echo "the Academic Year is:".$result['AcademicYear'] ?>        </p>
<p> <?php echo "the Major is:".$result['Major'] ?>        </p>
<p> <?php echo "the Level Code is:".$result['LevelCode'] ?>        </p>
<p> <?php echo "the Degree is:".$result['Degree'] ?>        </p>
</body>
</ul>
</nav>
</html>


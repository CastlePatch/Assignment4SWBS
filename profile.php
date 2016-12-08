<?php

$host='earth.cs.utep.edu';
$user='cs5339team7fa16';
$password='cs5339!cs5339team7fa16';
$database='cs5339team7fa16';

session_start();
//colum id, AcademicYear, Term, LastName, FirstName, Major, LevelCode, Degree
//row int, rest VARCHAR


$conn = new mysqli($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(!isset($_GET['id'])&& !isset($_SESSION['login'])){
	echo '<script>window.location="index.php"</script>';
	
}		

?>
<html>

<header>
<h1> Profile Page</h1>
</header>
<!--not loged in  -->
<?php 
if ( !isset($_SESSION ['login'])){

	$id=$_SESSION['login'];
	
	$query=$conn->prepare("SELECT COUNT(*) FROM wb_longpre.csdegrees WHERE id = ?;");
	$query->bind_param("i",$id);
	$query->execute();
	$query->bind_result( $result);
	$query->fetch();
	mysqli_stmt_close($query);
	
	
	

echo '<li><a href="#">Alumni List</a></li>';
echo '<li><a href="#">Bulletin Board</a></li>';
echo '<li><a href="#"> Login</a></li>';
echo '<li><a href="#">register</a></li>';
}
?>

<!--loged in  -->
<?php 
if ( isset($_SESSION ['login']) ){

	$id=$_SESSION['login'];
	
	if(isset($_GET['id'])){
		$id=$_GET['id'];
	}
	
	
	$query=$conn->prepare("SELECT FirstName, LastName, Term, AcademicYear, Major, LevelCode, Degree FROM wb_longpre.csdegrees WHERE id = ?;");
	$query->bind_param("i",$id);
	$query->execute();
	$query->bind_result( $result['FirstName'], $result ['LastName'], $result['Term'], $result['AcademicYear'], $result['Major'], $result['LevelCode'], $result['Degree'] );
	$query->fetch();
	mysqli_stmt_close($query);
	

echo '<li><a href="#">Alumni List</a></li>';
echo '<li><a href="#">Bulletin Board</a></li>';
echo '<li><a href="#"> Profile</a></li>';
echo '<li><a href="#">Logout</a></li>';
}
?>

<!-- photo -->


<!-- body main data 
grab from database the specific user that the user clik on-->

<?php 
if( !isset($_GET['visible'])){
	echo "<br>";
	echo "<br>";
	echo "<br>";
	
 echo  "the First Name is: ".$result['FirstName'];
 echo "<br>";
 echo "the Last Name is: ". $result['LastName'] ;
 echo "<br>";
echo "the term is: ".$result['Term'] ;
echo "<br>";
 echo "the Major is: ".$result['Major'] ;
 echo "<br>";
 echo "the Level Code is: ".$result['LevelCode'] ;
 echo "<br>";
 echo "the Degree is: ".$result['Degree'];
}
 ?>
 <?php if(isset($_GET['id']) && isset($_SESSION['login'])){
 if($_GET['id']==$_SESSION['login']){
 echo '<form action="profile.php?='.$_SESSION['login'].'" method="get"  enctype="multipart/form-data">>';
 echo	'<input type="radio" name="visible" value="visible">';
 echo  '<input type="submit" value="submit">';
 echo '<input type= "hidden" value="'.$_SESSION['login'].'"name="id">';
 echo ' Select image to upload:';
 echo ' <input type="file" name="fileToUpload" id="fileToUpload">';
  
 	echo '</form>';
 	
 	$target_dir = "uploads/";
 	//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 	$uploadOk = 1;
 //	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
 	// Check if image file is a actual image or fake image
 	if(isset($_Get["submit"])) {
 		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
 		if($check !== false) {
 			echo "File is an image - " . $check["mime"] . ".";
 			$uploadOk = 1;
 		} else {
 			echo "File is not an image.";
 			$uploadOk = 0;
 		}
 	}
 	
 	
 	
?>
 	<img src="uploads/XO0Sej8.jpeg" alt="profile pic" style="width:304px;height:228px;">
 	<?php 
 }
 }
 		?>

 	
 	

</html>


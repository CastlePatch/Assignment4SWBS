<?php
//javascript for the textbox to open onclick
//internal css also in the head
echo <<<_END
<!DOCTYPE html>
<html>
<head><title>Main List</title>
<style>
table {border-collapse: collapse;}
table, th, td {border: 1px solid black;}
th, td {text-align: center;
    padding: 5px;}
tr:hover {background-color: #CCCCCC;}
ul{display:flex;
    list-style-type: none;
    margin-left: auto;
    margin-right:auto;
    max-width:1000px;}
ul a{
    flex-grow:1;
    width:auto;}
</style>
<script type="text/javascript">
function textfield(name){
  if(name=='') document.getElementById('div1').innerHTML='';
  if(name=='lastname') document.getElementById('div1').innerHTML='Last Name: <input type="text" name="lastname" /><input type="submit" value="Filter">';
  if(name=='firstname') document.getElementById('div1').innerHTML='First Name: <input type="text" name="firstname" /><input type="submit" value="Filter">';
  if(name=='year') document.getElementById('div1').innerHTML='Academic Year (e.g. 2012-13): <input type="text" name="year" /><input type="submit" value="Filter">';
  if(name=='major') document.getElementById('div1').innerHTML='Major (Abbreviation): <input type="text" name="major" /><input type="submit" value="Filter">';
  if(name=='degree') document.getElementById('div1').innerHTML='Degree (Abbreviation): <input type="text" name="degree" /><input type="submit" value="Filter">';
  if(name=='level') document.getElementById('div1').innerHTML='Level of Graduate (UG or GR): <input type="text" name="level" /><input type="submit" value="Filter">';
}
</script>
</head>
_END;
//beginning of the body introducing the sort and filter forms
//with some minor inline css for alignment
echo <<<_END
<body>
<h2 style="text-align: center">Alumni List</h2>
<ul>
    <a href="#"><li>Alumni</li></a>
    <a href="profile.php"><li>Profile</li></a>
    <a href="login/index.php"><li>Log In</li></a>
    <a href="register/index.php"><li>Register</li></a>
</ul>
   <p style="text-align: right">Sort by:<form style="text-align: right" method="post" action="mainlist.php">
    <select name="sort" size="1">
        <option selected="selected"></option>
        <option value="lname">Last Name</option>
        <option value="fname">First Name</option>
        <option value="yr">Academic Year</option>
        <option value="mjr">Major</option>
        <option value="dgr">Degree</option>
    </select>
    <input type="submit" value="Sort"></p>
    </form>
   
_END;
//filter
echo <<<_END
<p style="text-align: right">Filter by:<form style="text-align: right" method="post" action="mainlist.php">
    <select name="filter" size="1" onchange="textfield(this.value)">
        <option selected="selected"></option>
        <option value="lastname">Last Name</option>
        <option value="firstname">First Name</option>
        <option value="year">Academic Year</option>
        <option value="major">Major</option>
        <option value="degree">Degree</option>
        <option value="level">Level of Graduate</option>
        </select></p><div style="text-align: right" id="div1"></div>
    </form>
_END;
//accessing wb_longpre database
$hn = "earth.cs.utep.edu";
$un = "cs5339team7fa16";
$db = "wb_longpre";
$pw = "cs5339!cs5339team7fa16";
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
if(isset($_POST['filter']))
{
    if(isset($_POST['lastname']))
    {
        $value = $_POST['lastname'];
        $result = $conn->query("SELECT * FROM csdegrees WHERE LastName='$value'");
        if (!$result) die($conn->error);
        printTable($result);
    }
    if(isset($_POST['firstname']))
    {
        $value = $_POST['firstname'];
        $result = $conn->query("SELECT * FROM csdegrees WHERE FirstName='$value'");
        if (!$result) die($conn->error);
        printTable($result);
    }
    if(isset($_POST['year']))
    {
        $value = $_POST['year'];
        $result = $conn->query("SELECT * FROM csdegrees WHERE AcademicYear='$value'");
        if (!$result) die($conn->error);
        printTable($result);
    }
    if(isset($_POST['major']))
    {
        $value = $_POST['major'];
        $result = $conn->query("SELECT * FROM csdegrees WHERE Major='$value'");
        if (!$result) die($conn->error);
        printTable($result);
    }
    if(isset($_POST['degree']))
    {
        $value = $_POST['degree'];
        $result = $conn->query("SELECT * FROM csdegrees WHERE Degree='$value'");
        if (!$result) die($conn->error);
        printTable($result);
    }
    if(isset($_POST['level']))
    {
        $value = $_POST['level'];
        $result = $conn->query("SELECT * FROM csdegrees WHERE LevelCode='$value'");
        if (!$result) die($conn->error);
        printTable($result);
    }
 if(isset($_POST['degree']))
    {
        $value = $_POST['degree'];
        $result = $conn->query("SELECT * FROM csdegrees WHERE Degree='$value'");
        if (!$result) die($conn->error);
        printTable($result);
    }
}
elseif(isset($_POST['sort']))
{
    
    if($_POST['sort'] == 'lname')
    {
        $result = $conn->query("SELECT * FROM csdegrees ORDER BY LastName");
        if (!$result) die($conn->error);
        printTable($result);
    }
    if($_POST['sort'] == 'fname')
    {
        $result = $conn->query("SELECT * FROM csdegrees ORDER BY FirstName");
        if (!$result) die($conn->error);
        printTable($result);
    }
    if($_POST['sort'] == 'yr')
    {
        $result = $conn->query("SELECT * FROM csdegrees ORDER BY AcademicYear");
        if (!$result) die($conn->error);
        printTable($result);
    }
    if($_POST['sort'] == 'mjr')
    {
        $result = $conn->query("SELECT * FROM csdegrees ORDER BY Major");
        if (!$result) die($conn->error);
        printTable($result);
    }
    if($_POST['sort'] == 'dgr')
    {
        $result = $conn->query("SELECT * FROM csdegrees ORDER BY Degree");
        if (!$result) die($conn->error);
        printTable($result);
    }
}
else 
{
    $result = $conn->query("SELECT * FROM csdegrees ORDER BY LastName");
        if (!$result) die($conn->error);
    printTable($result);
}
//condensed the repeating table creation into a single function
function printTable($res)
{
     echo <<<_END
    <table>
    <tr>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Academic Year</th>
        <th>Term</th>
        <th>Major</th>
        <th>Level of Graduate</th>
        <th>Degree</th>
        <th>Link</th>
    </tr>
_END;
    $rows = $res->num_rows;
    for ($j = 0 ; $j < $rows ; ++$j)
      {
       $res->data_seek($j);
        $row = $res->fetch_array(MYSQLI_BOTH);
        echo "<tr>";
        echo "<td>".$row['LastName']."</td>";
        echo "<td>".$row['FirstName']."</td>";
        echo "<td>".$row['AcademicYear']."</td>";
        echo "<td>".$row['Term']."</td>";
        echo "<td>".$row['Major']."</td>";
        echo "<td>".$row['LevelCode']."</td>";
        echo "<td>".$row['Degree']."</td>";
        echo "<td><a href='profile.php?id=".$row[0]."'>Profile Page</a></td>";
        echo "</tr>";
      }
     echo "</table>";
     
}
?>

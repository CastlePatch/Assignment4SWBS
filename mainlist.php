<?php

echo <<<_END
<html>
<head><title>Main List</title>
<script type="text/javascript">
function textfield(name){
  if(name=='') document.getElementById('div1').innerHTML='';
  if(name=='lastname') document.getElementById('div1').innerHTML='Last Name: <input type="text" name="lastname" /><input type="submit" value="Filter">';
  if(name=='year') document.getElementById('div1').innerHTML='Year: <input type="text" name="year" /><input type="submit" value="Filter">';
  if(name=='degree') document.getElementById('div1').innerHTML='Degree: <input type="text" name="degree" /><input type="submit" value="Filter">';
  if(name=='level') document.getElementById('div1').innerHTML='Level of Graduate: <input type="text" name="level" /><input type="submit" value="Filter">';
}
</script>
</head>
_END;

echo <<<_END
<p>Sort by:<form method="post" action="mainlist.php">
    <select name="sort" size="1">
        <option value="lname">Last Name</option>
        <option value="yr">Year</option>
        <option value="mjr">Major</option>
    </select>
    <input type="submit" value="Sort"></p>
    </form>
   
_END;

echo <<<_END
<p>Filter by:<form method="post" action="mainlist.php">
    <select name="filter" size="1" onchange="textfield(this.value)">
        <option selected="selected"></option>
        <option value="lastname">Last Name</option>
        <option value="year">Year Graduated</option>
        <option value="degree">Degree</option>
        <option value="level">Level of Graduate</option>
        </select></p><div id="div1"></div>
    </form>
_END;

$hn = "earth.cs.utep.edu";
$un = "cs5339team7fa16";
$db = "cs5339team7fa16";
$pw = "cs5339!cs5339team7fa16";

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);



if(isset($_POST['sort']))
{
    
    
    if($_POST['sort'] == 'lname')
    {
        $result = $conn->query("SELECT * FROM users ORDER BY lastname");
        if (!$result) die($conn->error);

        echo <<<_END
    <table>
    <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Major</th>
        <th>Year Graduated</th>
        <th>Level</th>
    </tr>
_END;

    $rows = $result->num_rows;
    for ($j = 0 ; $j < $rows ; ++$j)
      {
       $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo "<tr><br>";
        echo "<td>".$row['username']."</td><br>";
        echo "<td>".$row['firstname']."</td><br>";
        echo "<td>".$row['lastname']."</td><br>";
        echo "<td>".$row['email']."</td><br>";
        echo "<td>".$row['major']."</td><br>";
        echo "<td>".$row['year']."</td><br>";
        echo "<td>".$row['level']."</td><br>";
        echo "</tr>";
      }
     echo "</table>";
     echo "</html>";
     
    }
    if($_POST['sort'] == 'yr')
    {
        $result = $conn->query("SELECT * FROM users ORDER BY year");
        if (!$result) die($conn->error);

        echo <<<_END
    <table>
    <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Major</th>
        <th>Year Graduated</th>
        <th>Level</th>
    </tr>
_END;

    $rows = $result->num_rows;
    for ($j = 0 ; $j < $rows ; ++$j)
      {
       $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo "<tr><br>";
        echo "<td>".$row['username']."</td><br/>";
        echo "<td>".$row['firstname']."</td><br/>";
        echo "<td>".$row['lastname']."</td><br/>";
        echo "<td>".$row['email']."</td><br/>";
        echo "<td>".$row['major']."</td><br/>";
        echo "<td>".$row['year']."</td><br/>";
        echo "<td>".$row['level']."</td><br/>";
        echo "</tr>";
      }
     echo "</table>";
     echo "</html>";
     
    }
    if($_POST['sort'] == 'mjr')
    {
        $result = $conn->query("SELECT * FROM users ORDER BY major");
        if (!$result) die($conn->error);

        echo <<<_END
    <table>
    <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Major</th>
        <th>Year Graduated</th>
        <th>Level</th>
    </tr>
_END;

    $rows = $result->num_rows;
    for ($j = 0 ; $j < $rows ; ++$j)
      {
       $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo "<tr><br>";
        echo "<td>".$row['username']."</td><br>";
        echo "<td>".$row['firstname']."</td><br>";
        echo "<td>".$row['lastname']."</td><br>";
        echo "<td>".$row['email']."</td><br>";
        echo "<td>".$row['major']."</td><br>";
        echo "<td>".$row['year']."</td><br>";
        echo "<td>".$row['level']."</td><br>";
        echo "</tr>";
      }
     echo "</table>";
     echo "</html>";
     
    }
}
if(isset($_POST['filter']))
{
    if(isset($_POST['lastname']))
    {
        $value = $_POST['lastname'];
        $result = $conn->query("SELECT * FROM users WHERE lastname='$value'");
        if (!$result) die($conn->error);

        echo <<<_END
    <table>
    <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Major</th>
        <th>Year Graduated</th>
        <th>Level</th>
    </tr>
_END;

    $rows = $result->num_rows;
    for ($j = 0 ; $j < $rows ; ++$j)
      {
       $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo "<tr><br>";
        echo "<td>".$row['username']."</td><br>";
        echo "<td>".$row['firstname']."</td><br>";
        echo "<td>".$row['lastname']."</td><br>";
        echo "<td>".$row['email']."</td><br>";
        echo "<td>".$row['major']."</td><br>";
        echo "<td>".$row['year']."</td><br>";
        echo "<td>".$row['level']."</td><br>";
        echo "</tr>";
      }
     echo "</table>";
     echo "</html>";
     
    }
    if(isset($_POST['year']))
    {
        $value = $_POST['year'];
        $result = $conn->query("SELECT * FROM users WHERE year='$value'");
        if (!$result) die($conn->error);

        echo <<<_END
    <table>
    <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Major</th>
        <th>Year Graduated</th>
        <th>Level</th>
    </tr>
_END;

    $rows = $result->num_rows;
    for ($j = 0 ; $j < $rows ; ++$j)
      {
       $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo "<tr><br>";
        echo "<td>".$row['username']."</td><br>";
        echo "<td>".$row['firstname']."</td><br>";
        echo "<td>".$row['lastname']."</td><br>";
        echo "<td>".$row['email']."</td><br>";
        echo "<td>".$row['major']."</td><br>";
        echo "<td>".$row['year']."</td><br>";
        echo "<td>".$row['level']."</td><br>";
        echo "</tr>";
      }
     echo "</table>";
     echo "</html>";
     
    }
    if(isset($_POST['degree']))
    {
        $value = $_POST['degree'];
        $result = $conn->query("SELECT * FROM users WHERE major='$value'");
        if (!$result) die($conn->error);

        echo <<<_END
    <table>
    <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Major</th>
        <th>Year Graduated</th>
        <th>Level</th>
    </tr>
_END;

    $rows = $result->num_rows;
    for ($j = 0 ; $j < $rows ; ++$j)
      {
       $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo "<tr><br>";
        echo "<td>".$row['username']."</td><br>";
        echo "<td>".$row['firstname']."</td><br>";
        echo "<td>".$row['lastname']."</td><br>";
        echo "<td>".$row['email']."</td><br>";
        echo "<td>".$row['major']."</td><br>";
        echo "<td>".$row['year']."</td><br>";
        echo "<td>".$row['level']."</td><br>";
        echo "</tr>";
      }
     echo "</table>";
     echo "</html>";
     
    }
    if(isset($_POST['level']))
    {
        $value = $_POST['level'];
        $result = $conn->query("SELECT * FROM users WHERE level='$value'");
        if (!$result) die($conn->error);

        echo <<<_END
    <table>
    <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Major</th>
        <th>Year Graduated</th>
        <th>Level</th>
    </tr>
_END;

    $rows = $result->num_rows;
    for ($j = 0 ; $j < $rows ; ++$j)
      {
       $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo "<tr><br>";
        echo "<td>".$row['username']."</td><br>";
        echo "<td>".$row['firstname']."</td><br>";
        echo "<td>".$row['lastname']."</td><br>";
        echo "<td>".$row['email']."</td><br>";
        echo "<td>".$row['major']."</td><br>";
        echo "<td>".$row['year']."</td><br>";
        echo "<td>".$row['level']."</td><br>";
        echo "</tr>";
      }
     echo "</table>";
     echo "</html>";
     
    }
    
}
else 
{
    $result = $conn->query("SELECT * FROM users ORDER BY username");
    if (!$result) die($conn->error);

echo <<<_END
<table>
    <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Major</th>
        <th>Year Graduated</th>
        <th>Level</th>
    </tr>
_END;

$rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo "<tr><br>";
    echo "<td>".$row['username']."</td><br>";
    echo "<td>".$row['firstname']."</td><br>";
    echo "<td>".$row['lastname']."</td><br>";
    echo "<td>".$row['email']."</td><br>";
    echo "<td>".$row['major']."</td><br>";
    echo "<td>".$row['year']."</td><br>";
    echo "<td>".$row['level']."</td><br>";
    echo "</tr>";
  }
  echo "</table>";
  echo "</html>";
  
  
}

?>

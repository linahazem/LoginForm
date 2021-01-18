<html>
  <head>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="signin.css" href="signin.css" media="screen">
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="university";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$encryptedPassword = $_POST['password'];

$sql = "SELECT* from user where email ='".$_POST['email']."' and password = md5('".$encryptedPassword."')";
$result = $conn->query($sql);

$sql2 = "SELECT* from department ";
$result2 = $conn->query($sql2);
$count = $result2->num_rows;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<font color=#fff size='20pt'> <br> Welcome " . $row["name"] . "<br><br>";
    }
    echo "<table border=2px cellspacing=2px cellpading=2px width=100% height=50%> 
    <tr> <td><font color=#fff>Id</td> <td> <font color=#fff>Name </td> <td> <font color=#fff>Description</font></td></tr>";
    for($x = 0 ; $x <$count ; $x++)
    {
        $row = $result2->fetch_assoc();
        echo "<tr> <td><font color=#fff> " .$row["id"] ." </td> <td> <font color=#fff>"
        .$row["name"] ." </td> <td> <font color=#fff>" .$row["description"] ."</font></td></tr>" ; 
    }
    echo "</table>";
    
} else {
    include 'signin.html';
    echo "<font color=#fff size='4pt'> Please enter valid data";
}

    $conn->close();
?>
</body>
</html>
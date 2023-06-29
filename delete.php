<?php

$servername = 'localhost';
$username = 'swapnil';
$password = 'swapnil259';
$dbname = "login_details";


$conn = mysqli_connect($servername, $username, $password,$dbname);


if ($conn->connect_error) {
  die("Connection failed: " .  mysql_error());
}
echo "Connected successfully<br><br>";
$email = $_GET['email'];


$modifyuser= "UPDATE `details` SET modification = 'delete' WHERE email = '$email' AND status = 'user'";
mysqli_query($conn,$modifyuser);
$alldata = "SELECT name, gender, address, status, email, phone, stay, modification FROM `details` WHERE modification = 'nodelete'";
$checkdata = mysqli_query($conn, $alldata);


echo "all user details<br><br>";

    $id=1;
    while($showdata = mysqli_fetch_assoc($checkdata)){
      echo "$id) ";
      echo " Name: " . $showdata['name'] ."<br>";
      echo "Gender: " . $showdata['gender'] . "<br>";
      echo "Address: " . $showdata['address'] . "<br>";
      echo "Email: " . $showdata['email'] . "<br>";
      echo "Phone: " . $showdata['phone'] . "<br>";
      echo "Stay: " . $showdata['stay'] . "<br><br>";
      $id++;
    }
   
    


?>
<script>
  // window.location = "user.php";
 
  window.history.back();

 
   </script>
    

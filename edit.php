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

$checkemailedit = "SELECT name, gender,address,phone,stay FROM `details` WHERE email = '$email' ";
$editresult = mysqli_query($conn,$checkemailedit);
$checkedit =mysqli_fetch_assoc($editresult);


$name = $checkedit['name'];
$gender = $checkedit['gender'];
$address = $checkedit['address'];
$phone = $checkedit['phone'];
$stay = $checkedit['stay'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
$name= $_POST['name'];
$gender= $_POST['gender'];
$address= $_POST['address'];
$phone= $_POST['phone'];
$stay= $_POST['stay'];

$updatedetails = "UPDATE `details` SET name = '$name' , gender = '$gender', address = '$address', phone = '$phone', stay = '$stay' WHERE email = '$email'";
$checkdetails = mysqli_query($conn, $updatedetails);
}

  echo "<form action='' method='post'>";
echo "  <label for='name' >Name:</label><input type='text' id='name' name='name'value = '$name'  ><br><br>";
echo "Gender: $gender<br>" ;
echo "  <label for='gender' >Change Gender:</label>
 <select name='gender' id='gender' value '$gender'> 
<option value='$gender'>Select</option>
<option value='male'  >male</option>
<option value='female'>female</option>
<option value='other'>other</option>
</select><br><br>";
echo "<label for='address' >Address:</label><input type='text' id='address' name='address'  value = '$address'><br><br>";
echo "<label for='email' >Email:</label><input type='text' id='email' name='email' value = '$email'><br><br>";
echo "<label for='phone' >Phone:</label><input type='text' id='phone' name='phone' value = '$phone'><br><br>";
echo "Stay: $stay<br>";
echo "<label for='stay' >Change Stay:</label><select name='stay' id='stay' value '$stay'>
<option value='$stay'>Select</option>
<option value='hostel'  >hostel</option>
<option value='outside'>outside</option>
</select><br><br>";
echo "<input type='submit' value = 'submit'  ><br>";
echo "</form>";
?>
<?php

$servername = 'localhost';
$username = 'swapnil';
$password = 'swapnil259';
$dbname = "login_details";


$conn = mysqli_connect($servername, $username, $password,$dbname);


if ($conn->connect_error) {
  die("Connection failed: " .  mysql_error());
}
echo "Connected successfully<br>";


$name = $_POST['name'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$stay=$_POST['stay'];
$pass=$_POST['pass'];
$confirmpass=$_POST['confirmpass'];
$checkEmailQuery = "SELECT COUNT(*) as count FROM `details` WHERE email = '$email'";
$EmailResult = mysqli_query($conn, $checkEmailQuery);
$checkEmailData = mysqli_fetch_assoc($EmailResult);
 

if ($checkEmailData['count'] > 0) {
  echo "Error: Email already exists!";
} elseif(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/',$pass)){
   
  echo "Password should include at least one upper case letter, one number, and one special character";
} elseif ($confirmpass!==$pass) {
   echo "password should be same";
} else { 
      $sql = "INSERT INTO `details` (name, gender, address, email, phone, stay,pass)
     VALUES ('$name','$gender','$address','$email','$phone','$stay','$pass')";
    
    if (mysqli_query($conn, $sql)) {
      echo "New record has been added successfully !<br>";
      session_start();
      $_SESSION['user'] = true;
      $userdetails = "SELECT name , gender, address, email, phone, stay FROM `details` WHERE email = '$email'";
      $userresult= mysqli_query($conn, $userdetails);
      $checkdetails = mysqli_fetch_assoc($userresult);
   
      echo "<br>USER: Details<br>";
      echo "Name => " . $checkdetails['name'] . "<br>";
      echo "Gender => " . $checkdetails['gender'] . "<br>";
      echo "Address => " . $checkdetails['address'] . "<br>";
      echo "Email => " . $checkdetails['email'] . "<br>";
      echo "Phone => " . $checkdetails['phone'] . "<br>";
      echo "Stay => " . $checkdetails['stay'] . "<br>";
     }
    else {
      echo "Error: " . $sql . ":-" . mysqli_error($conn);
   }
    }
  



  //  $userdetails = "SELECT name , gender, address, email, phone, stay FROM `details` WHERE email = '$email'";
  //  $userresult= mysqli_query($conn, $userdetails);
  //  $checkdetails = mysqli_fetch_assoc($userresult);

  //  echo "USER-DETAILS<br>";
  //  echo "Name => " . $checkdetails['name'] . "<br>";
  //  echo "Gender => " . $checkdetails['gender'] . "<br>";
  //  echo "Address => " . $checkdetails['address'] . "<br>";
  //  echo "Email => " . $checkdetails['email'] . "<br>";
  //  echo "Phone => " . $checkdetails['phone'] . "<br>";
  //  echo "Stay => " . $checkdetails['stay'] . "<br>";



?>
 
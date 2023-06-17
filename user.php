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


$email = $_POST['email'];
$pass = $_POST['pass'];

$checkEmailQuery = "SELECT COUNT(*) as count FROM `details` WHERE email = '$email'";
$EmailResult = mysqli_query($conn, $checkEmailQuery);
$checkEmailData = mysqli_fetch_assoc($EmailResult);

if ($checkEmailData['count'] >0) {
  $status = $checkstatus['status'];

  if ($status === 'admin'){
    setcookie('status', 'admin' );
    $alldata = "SELECT name, gender, address, email, phone, stay FROM `details`"; 
    $checkdata = mysqli_query($conn, $alldata);
   
    echo "all user details<br>";
    while($showdata = mysqli_fetch_assoc($checkdata)){
      echo "Name: " . $showdata['name'] . "<br>";
      echo "Gender: " . $showdata['gender'] . "<br>";
      echo "Address: " . $showdata['address'] . "<br>";
      echo "Email: " . $showdata['email'] . "<br>";
      echo "Phone: " . $showdata['phone'] . "<br>";
      echo "Stay: " . $showdata['stay'] . "<br>";
    }
       } else {
        session_start();
        $_SESSION['user'] = true;
        $userdetails = "SELECT name , gender, address, email, phone, stay FROM `details` WHERE email = '$email' AND pass = '$pass'";
        $userresult= mysqli_query($conn, $userdetails);
         $checkdetails = mysqli_fetch_assoc($userresult);
           if($checkdetails) {
           echo "USER-DETAILS<br>";
           echo "Name => " . $checkdetails['name'] . "<br>";
           echo "Gender => " . $checkdetails['gender'] . "<br>";
           echo "Address => " . $checkdetails['address'] . "<br>";
           echo "Email => " . $checkdetails['email'] . "<br>";
           echo "Phone => " . $checkdetails['phone'] . "<br>";
           echo "Stay => " . $checkdetails['stay'] . "<br>";
          } else {
          echo "invalid password";
   } }
} else {
    
    header("Location: homepage.html");
    exit;
}
?>
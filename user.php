<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = 'localhost';
$username = 'swapnil';
$password = 'swapnil259';
$dbname = "login_details";


$conn = mysqli_connect($servername, $username, $password,$dbname);


if ($conn->connect_error) {
  die("Connection failed: " .  mysql_error());
}
echo "Connected successfully<br><br>";


$email = $_POST['email'];
$pass = $_POST['pass'];

$checkEmailQuery = "SELECT COUNT(*) as count, status, pass FROM `details` WHERE email = '$email'";
$EmailResult = mysqli_query($conn, $checkEmailQuery);
$checkEmailData = mysqli_fetch_assoc($EmailResult);

if ($checkEmailData['count'] >0) {
  $status = $checkEmailData['status'];
  $hashedpass = $checkEmailData['pass'];
  if(password_hash($pass, PASSWORD_DEFAULT)){
 if ($status === 'admin') {
      setcookie('role', 'admin', time() + (86400 * 30), '/'); 
  
  
    $alldata = "SELECT name, gender, address, email, phone, stay FROM `details`WHERE modification = 'nodelete'"; 
    $checkdata = mysqli_query($conn, $alldata);
   
    echo "all user details<br><br>";
    $id=1;
    while($showdata = mysqli_fetch_assoc($checkdata)){
      echo "$id) ";
      echo " Name: " . $showdata['name'] ;
      echo " \t\t<input type = 'submit' value = 'delete' name = 'delete' onclick = 'Userdelete(\"" . $showdata['email'] . "\")'/> \t\t";
      echo "<input type = 'submit' value = 'edit' name = 'update' onclick = 'Useredit(\"" . $showdata['email'] . "\")'/><br>";
      echo "Gender: " . $showdata['gender'] . "<br>";
      echo "Address: " . $showdata['address'] . "<br>";
      echo "Email: " . $showdata['email'] . "<br>";
      echo "Phone: " . $showdata['phone'] . "<br>";
      echo "Stay: " . $showdata['stay'] . "<br><br>";
      $id++;
        
    }
       } else {
        session_start();
        $_SESSION['user'] = true;
        $userdetails = "SELECT name , gender, address, email,pass, phone, stay FROM `details` WHERE email = '$email' ";
        $userresult= mysqli_query($conn, $userdetails);
         $checkdetails = mysqli_fetch_assoc($userresult);
         $hashedpass = $checkdetails['pass'];
         if(password_verify($pass,$hashedpass)){
        
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
   } } else {
    echo "invalid password";
   } }

   }
   }  else {
    
     header("Location: homepage.html");
     exit;
}
?>
<script>

function Userdelete(email) {
 window.location.href = 'delete.php?email=' + encodeURIComponent(email);

}

function Useredit(email) {
window.location.href = 'edit.php?email=' + encodeURIComponent(email);
}

</script>
  
 

  
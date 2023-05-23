<?php
session_start();


$email = $_POST['email'];
$password = $_POST['password'];

$connection = oci_connect("scott", "tiger", "XE");


if($email!='' && $password != ''){
  $sql = "SELECT * FROM Employee WHERE email = :email and password = :password";
  $statement = oci_parse($connection, $sql);

  oci_bind_by_name($statement, ':email', $email);
  oci_bind_by_name($statement, ':password', $password);

  oci_execute($statement);

  if ($row = oci_fetch_assoc($statement)) {
    $_SESSION['authenticated'] = true;
    header("Location:ADMIN_DASHBORD.php");
    exit;
  }

  else{
    echo "Invalid email address or password.";
  }
}


?>

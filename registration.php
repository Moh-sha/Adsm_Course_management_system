<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];

$connection = oci_connect('scott', 'tiger', 'XE');

$Id= "SELECT MAX(EmployeeID)+1 from Employee";

$Id = oci_parse($connection, $Id);
oci_execute($Id);

while ($row = oci_fetch_array($Id, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $Id) {
         
    }
}

$sql = "INSERT INTO Employee (EmployeeID, FirstName, LastName, Email, Password) VALUES (:Id, :fname, :lname, :email, :password)";

$statement = oci_parse($connection, $sql);

oci_bind_by_name($statement, ':Id', $Id);
oci_bind_by_name($statement, ':fname', $fname);
oci_bind_by_name($statement, ':lname', $lname);
oci_bind_by_name($statement, ':email', $email);
oci_bind_by_name($statement, ':password', $password);

$success = oci_execute($statement);

if($success){
    echo "Registration successful!";
}
?>
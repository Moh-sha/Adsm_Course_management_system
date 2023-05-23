<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>AMS</title>
    <link rel="stylesheet" href="style2.css">
    <style>
    a:link, a:visited {
    background-color: #2691d9;
    border-radius: 25px;
    color: white;
    padding: 14px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    }

    a:hover, a:active {
    background-color: skyblue;
    }
    </style>
    </head>
    <body>
    <a href="index.php" >HOME</a>
    <a href="ADMIN_DASHBORD.php" >ADMIN DASHBORD</a> 
    
    <div class="container">
        <h1>STUDENT DETAILS</h1>
        <h4 style="color:white;">Course System</h4>
    </div>
    <div id="mainHolder" style="overflow: auto; max-height: 400px;">
    <?php
        $conn = oci_connect("scott", "tiger", "XE");   
        if (!$conn) {
          echo 'Failed to connect to oracle' . "<br>";
        }

        $stid = oci_parse($conn, 'SELECT * FROM STUDENT_DETAILS_S');
        oci_execute($stid);
        echo "<table border='1'>
        <tr>
            <th>STUDENT ID</th>
            <th>STUDENT NAME</th>
            <th>STUDENT CGPA</th>
                 
        </tr>";

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
    echo "<tr>";
    echo "<td>" . $row['S_ID_S'] . "</td>";
    echo "<td>" . $row['S_NAME'] . "</td>";
   
 
    echo "<td>" . $row['S_CGPA'] . "</td>";
   
    echo "</tr>";
    }
    echo "</table>\n";
    
    ?>


<?php 
    oci_free_statement($stid);
    oci_close($conn);
?>
</body>
</html>
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
    <a href="update.php" >UPDATE COURSE</a> 
    <a href="search.php" >SEARCH COURSE</a> 
    <a href="ADMIN.php" >COURSE & STUDENT DETAILS</a> 
    <a href="admin2.php" >COURSE TOTAL SELL DETAILS</a> 
    <a href="student.php" >STUDENT DETAILS</a> 
    <a href="insert.php" >INSERT VALUE</a>
    <a href="Faculty.php" >FACULTY DETAILS</a>  
    <a href="delect.php" >DELETE VALUE</a>  
    <div class="container">
        <h1>COURSE DASHBOARD</h1>

    </div>
    <div id="mainHolder" style="overflow: auto; max-height: 500px;">
        <?php
        $conn = oci_connect("scott", "tiger", "XE");
        if (!$conn) {
            echo 'Failed to connect to Oracle.' . "<br>";
        }

        if (isset($_POST['submit'])) {
            $courseName = $_POST['COURSE_NAME'];
            $courseRequirement = $_POST['COURSE_REQUIREMENT'];

            // Prepare the INSERT statement
            $stid = oci_parse($conn, "INSERT INTO COURSES (COURSE_ID, COURSE_NAME, COURSE_REQUIREMENT) VALUES (COURSE_ID_SEQ.NEXTVAL, :courseName, :courseRequirement)");

            // Bind the parameters
            oci_bind_by_name($stid, ":courseName", $courseName);
            oci_bind_by_name($stid, ":courseRequirement", $courseRequirement);

            // Execute the statement
            $result = oci_execute($stid);

            if ($result) {
                echo "<div class='center'>Course added successfully.</div>";
            } else {
                echo "<div class='center'>Failed to add course.</div>";
            }
        }

        // Retrieve data from the database
        $stid = oci_parse($conn, "SELECT * FROM COURSES");
        oci_execute($stid);

        echo "<table>
                <tr>
                    <th>COURSE_ID</th>
                    <th>COURSE_NAME</th>
                    <th>COURSE_REQUIREMENT</th>
                </tr>";

        while (($row = oci_fetch_array($stid, OCI_ASSOC)) !== false) {
            echo "<tr>";
            echo "<td>" . $row['COURSE_ID'] . "</td>";
            echo "<td>" . $row['COURSE_NAME'] . "</td>";
            echo "<td>" . $row['COURSE_REQUIREMENT'] . "</td>";
            echo "</tr>";
        }

        echo "</table>\n";

        oci_close($conn);
        ?>
    </div>

</body>
</html>
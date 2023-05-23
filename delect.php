<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>AMS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table th, table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        form {
            margin-top: 20px;
            text-align: center;
        }

        .txt_field {
            position: relative;
            margin-bottom: 30px;
        }

        .txt_field input {
            font-size: 18px;
            padding: 10px 10px 10px 5px;
            display: block;
            width: 100%;
            border: none;
            border-bottom: 1px solid #999;
        }

        .txt_field label {
            pointer-events: none;
            position: absolute;
            top: 50%;
            left: 5px;
            color: #999;
            transform: translateY(-50%);
            font-size: 18px;
            transition: 0.5s;
        }

        .txt_field input:focus ~ label,
        .txt_field input:valid ~ label {
            top: -5px;
            left: 0;
            color: #2691d9;
            font-size: 14px;
            background-color: #fff;
            padding: 0 5px;
        }

        .center {
            text-align: center;
            margin-top: 20px;
        }

        .center input[type="submit"] {
            background-color: #2691d9;
            border-radius: 25px;
            color: white;
            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }

        .center input[type="submit"]:hover {
            background-color: skyblue;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>COURSE DASHBOARD</h1>
        <a href="ADMIN_DASHBORD.php">ADMIN</a>
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

        if (isset($_POST['delete'])) {
            $courseId = $_POST['courseId'];

            // Prepare the DELETE statement
            $stid = oci_parse($conn, "DELETE FROM COURSES WHERE COURSE_ID = :courseId");

            // Bind the parameter
            oci_bind_by_name($stid, ":courseId", $courseId);

            // Execute the statement
            $result = oci_execute($stid);

            if ($result) {
                echo "<div class='center'>Course deleted successfully.</div>";
            } else {
                echo "<div class='center'>Failed to delete course.</div>";
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
                    <th>ACTION</th>
                </tr>";

        while (($row = oci_fetch_array($stid, OCI_ASSOC)) !== false) {
            echo "<tr>";
            echo "<td>" . $row['COURSE_ID'] . "</td>";
            echo "<td>" . $row['COURSE_NAME'] . "</td>";
            echo "<td>" . $row['COURSE_REQUIREMENT'] . "</td>";
            echo "<td>
                      <form method='post'>
                          <input type='hidden' name='courseId' value='" . $row['COURSE_ID'] . "'>
                          <input type='submit' value='Delete' name='delete'>
                      </form>
                  </td>";
            echo "</tr>";
        }

        echo "</table>\n";

        oci_close($conn);
        ?>
    </div>

  

</body>
</html>

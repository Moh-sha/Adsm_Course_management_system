<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>AMS</title>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            text-align: center;
            margin-top: 30px;
        }

        h1 {
            color: #2691d9;
        }

        #mainHolder {
            margin-top: 30px;
            overflow: auto;
            max-height: 500px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2691d9;
            color: white;
        }

        .center {
            text-align: center;
            margin-top: 30px;
        }

        .txt_field {
            position: relative;
            margin-bottom: 30px;
        }

        input[type="text"], input[type="number"] {
            font-size: 16px;
            padding: 10px;
            border: none;
            border-bottom: 1px solid #ccc;
            width: 100%;
            background: transparent;
        }

        input[type="submit"] {
            background-color: #2691d9;
            color: white;
            border: none;
            padding: 12px 20px;
            text-decoration: none;
            cursor: pointer;
            border-radius: 25px;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: skyblue;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>COURSE DASHBOARD</h1>
       
    </div>
    <div id="mainHolder">
        <?php
            $conn = oci_connect("scott", "tiger", "XE");
            if (!$conn) {
                echo 'Failed to connect to Oracle.' . "<br>";
            }

            if (isset($_POST['submit'])) {
                $courseID = $_POST['COURSE_ID'];
                $courseName = $_POST['COURSE_NAME'];
                $courseRequirement = $_POST['COURSE_REQUIREMENT'];

                // Prepare the UPDATE statement
                $stid = oci_parse($conn, "UPDATE COURSES SET COURSE_NAME = :courseName, COURSE_REQUIREMENT = :courseRequirement WHERE COURSE_ID = :courseID");

                // Bind the parameters
                oci_bind_by_name($stid, ":courseName", $courseName);
                oci_bind_by_name($stid, ":courseRequirement", $courseRequirement);
                oci_bind_by_name($stid, ":courseID", $courseID);

                // Execute the statement
                $result = oci_execute($stid);

                if ($result) {
                    echo "Course updated successfully.";
                } else {
                    echo "Failed to update course.";
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

    <div class="center">
        <form method="post">
            <div class="txt_field">
                <input type="number" name="COURSE_ID" required>
                <label>COURSE ID</label>
            </div>

            <div class="txt_field">
                <input type="text" name="COURSE_NAME" required>
                <label>COURSE NAME</label>
            </div>

            <div class="txt_field">
                <input type="text" name="COURSE_REQUIREMENT" required>
                <label>COURSE REQUIREMENT</label>
            </div>

            <input type="submit" value="UPDATE COURSE" name="submit">
        </form>
        <a href="index.php" >ADMIN</a>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>AMS</title>

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

    .container {
        background-color: #f2f2f2;
        padding: 20px;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
    </style>
</head>
<body>
    <a href="index.php">HOME</a>
    <a href="ADMIN_DASHBORD.php">ADMIN DASHBOARD</a>

    <div class="container">
        <h1>VIEWS</h1>
        <h4 style="color: white;">Course System</h4>
    </div>

    <div id="mainHolder" style="overflow: auto; max-height: 400px;">
        <?php
            $conn = oci_connect("scott", "tiger", "XE");
            if (!$conn) {
                echo 'Failed to connect to Oracle' . "<br>";
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $studentId = $_POST['student_id'];
                $studentName = $_POST['student_name'];
                $studentEmail = $_POST['student_email'];
                $studentPhone = $_POST['student_phone'];
                $courseId = $_POST['course_id'];
                $courseName = $_POST['course_name'];

                $query = "INSERT INTO COURSE_ADMIN_ (STUDENT_ID, STUDENT_NAME, STUDENT_EMAIL, STUDENT_PHONE, COURSE_ID, COURSE_NAME) 
                          VALUES (:student_id, :student_name, :student_email, :student_phone, :course_id, :course_name)";

                $stid = oci_parse($conn, $query);
                oci_bind_by_name($stid, ':student_id', $studentId);
                oci_bind_by_name($stid, ':student_name', $studentName);
                oci_bind_by_name($stid, ':student_email', $studentEmail);
                oci_bind_by_name($stid, ':student_phone', $studentPhone);
                oci_bind_by_name($stid, ':course_id', $courseId);
                oci_bind_by_name($stid, ':course_name', $courseName);

                if (oci_execute($stid)) {
                    echo "Record inserted successfully.";
                } else {
                    echo "Failed to insert record.";
                }

                oci_free_statement($stid);
            }

            $stid = oci_parse($conn, 'SELECT * FROM COURSE_ADMIN_');
            oci_execute($stid);

            echo "<table border='1'>
            <tr>
                <th>STUDENT_ID</th>
                <th>STUDENT_NAME</th>
                <th>STUDENT_EMAIL</th>
                <th>STUDENT_PHONE</th>
                <th>COURSE_ID</th>
                <th>COURSE_NAME</th>
            </tr>";

            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                echo "<tr>";
                echo "<td>" . $row['STUDENT_ID'] . "</td>";
                echo "<td>" . $row['STUDENT_NAME'] . "</td>";
                echo "<td>" . $row['STUDENT_EMAIL'] . "</td>";
                echo "<td>" . $row['STUDENT_PHONE'] . "</td>";
                echo "<td>" . $row['COURSE_ID'] . "</td>";
                echo "<td>" . $row['COURSE_NAME'] . "</td>";
                echo "</tr>";
            }

            echo "</table>\n";
        ?>

    </div>

    <div class="container">
        <h2>Insert Values</h2>
        <form method="POST" action="">
            <label for="student_id">Student ID:</label>
            <input type="text" name="student_id" id="student_id" required><br>

            <label for="student_name">Student Name:</label>
            <input type="text" name="student_name" id="student_name" required><br>

            <label for="student_email">Student Email:</label>
            <input type="email" name="student_email" id="student_email" required><br>

            <label for="student_phone">Student Phone:</label>
            <input type="text" name="student_phone" id="student_phone" required><br>

            <label for="course_id">Course ID:</label>
            <input type="text" name="course_id" id="course_id" required><br>

            <label for="course_name">Course Name:</label>
            <input type="text" name="course_name" id="course_name" required><br>

            <input type="submit" value="Insert">
        </form>
    </div>

    <?php 
        oci_free_statement($stid);
        oci_close($conn);
    ?>
</body>
</html>

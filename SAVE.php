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
            echo "Course added successfully.";
        } else {
            echo "Failed to add course.";
        }
    }

    // Retrieve data from the database
    $stid = oci_parse($conn, "SELECT * FROM COURSES");
    oci_execute($stid);

    echo "<table border='1'>
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

<div class="center">
    <form method="post">
        <div class="txt_field">
            <input type="text" name="COURSE_NAME" required>
            <label>COURSE NAME</label>
        </div>

        <div class="txt_field">
            <input type="text" name="COURSE_REQUIREMENT" required>
            <label>COURSE REQUIREMENT</label>
        </div>

        <input type="submit" value="ADD COURSE" name="submit">
    </form>
</div>

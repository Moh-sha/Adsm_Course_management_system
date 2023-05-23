<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>AMS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
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
            background-color: #2691d9;
            padding: 20px;
            color: white;
        }

        h1, h2, h4 {
            margin: 0;
            padding: 0;
        }

        #mainHolder {
            overflow: auto;
            max-height: 400px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #2691d9;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: inline-block;
            width: 150px;
        }

        input[type="text"] {
            width: 250px;
            padding: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #2691d9;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: skyblue;
        }
    </style>
</head>
<body>
    <a href="index.php">HOME</a>
    <a href="ADMIN_DASHBORD.php">ADMIN DASHBOARD</a> 
    
    <div class="container">
        <h1>FACULTY DETAILS</h1>
        <h4>Course System</h4>
    </div>

    <div id="mainHolder">
        <?php
        $conn = oci_connect("scott", "tiger", "XE");   
        if (!$conn) {
            echo 'Failed to connect to Oracle' . "<br>";
        }

        if (isset($_POST['submit'])) {
            $facultyName = $_POST['faculty_name'];
            $facultyPhone = $_POST['faculty_phone'];

            // Retrieve the next value from the sequence
            $stid = oci_parse($conn, 'SELECT faculty_seq.NEXTVAL FROM DUAL');
            oci_execute($stid);
            $row = oci_fetch_array($stid, OCI_ASSOC);
            $facultyId = $row['NEXTVAL'];

            // Insert the values into the table
            $stid = oci_parse($conn, 'INSERT INTO FACULTY_DETAILS(FACULTY_ID, FACULTY_NAME, FACULTY_NUMBER) VALUES (:id, :name, :phone)');
            oci_bind_by_name($stid, ':id', $facultyId);
            oci_bind_by_name($stid, ':name', $facultyName);
            oci_bind_by_name($stid, ':phone', $facultyPhone);
            oci_execute($stid);
        }

        $stid = oci_parse($conn, 'SELECT * FROM FACULTY_DETAILS_VIEW');
        oci_execute($stid);
        echo "<table>
        <tr>
            <th>FACULTY ID</th>
            <th>FACULTY NAME</th>
                  
        </tr>";

        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            echo "<tr>";
            echo "<td>" . $row['FACULTY_ID'] . "</td>";
            echo "<td>" . $row['FACULTY_NAME'] . "</td>";
          
            echo "</tr>";
        }
        echo "</table>\n";
        ?>

    </div>

    <div class="container">
        <h2>Insert Faculty</h2>
        <form method="POST" action="">
            <label for="faculty_name">Faculty Name:</label>
            <input type="text" name="faculty_name" id="faculty_name" required><br>

            <label for="faculty_phone">Faculty Phone:</label>
            <input type="text" name="faculty_phone" id="faculty_phone" required><br>

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>

    <?php 
    oci_free_statement($stid);
    oci_close($conn);
    ?>
</body>
</html>

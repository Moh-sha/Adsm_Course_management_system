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
    <a href="index.php">HOME</a>
    <a href="ADMIN_DASHBORD.php">ADMIN DASHBOARD</a> 
    
    <div class="container">
        <h1>COURSE STATUS VIEWS</h1>
        <h4 style="color:white;"></h4>
    </div>
    <div id="mainHolder" style="overflow: auto; max-height: 400px;">
    <?php
        $conn = oci_connect("scott", "tiger", "XE");   
        if (!$conn) {
            echo 'Failed to connect to Oracle.' . "<br>";
        }
    ?>
    </div>
    <div class="container">
        <h4 style="color:white;"><br>COURSE SELL DETAILS</h4>
    </div>

    <div id="mainHolder" style="overflow: auto; max-height: 400px;">
    <?php
        // Check if a search query is submitted
        if (isset($_POST['search'])) {
            $searchValue = $_POST['searchValue'];
            $stid = oci_parse($conn, 'SELECT * FROM COURSE_SELL WHERE COURSE_ID = :searchValue');
            oci_bind_by_name($stid, ':searchValue', $searchValue);
        } else {
            $stid = oci_parse($conn, 'SELECT * FROM COURSE_SELL');
        }

        oci_execute($stid);

        echo "<table border='1'>
                <tr>
                    <th>COURSE_ID</th>
                    <th>COURSE TOTAL PRICE</th>
                </tr>";

        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            echo "<tr>";
            echo "<td>" . $row['COURSE_ID'] . "</td>";
            echo "<td>" . $row['COURSE_TOTAL_PRICE'] . "</td>";
            echo "</tr>";
        }
        echo "</table>\n"; 
    ?>
    </div>

    <div class="container">
        <h4 style="color:white;"><br>Search by COURSE_ID:</h4>
        <form method="post">
            <input type="text" name="searchValue" placeholder="Enter COURSE_ID" required>
            <input type="submit" name="search" value="Search">
        
        </form>
    </div>

    <?php 
        oci_free_statement($stid);
        oci_close($conn);
    ?>
</body>
</html>

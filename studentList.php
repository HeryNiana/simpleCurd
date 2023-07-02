<?php
include_once("config.php");

// Pagination
$records_per_page = 5;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($page - 1) * $records_per_page;

// Get total number of records in 'students' table
$total_records = $dbConn->query("SELECT COUNT(*) as total FROM students")->fetch()['total'];
$total_pages = ceil($total_records / $records_per_page);

// Fetch data from 'students' table with pagination
$query = $dbConn->query("SELECT s.*, c.name as className FROM students s INNER JOIN class c ON s.idClass = c.id ORDER BY s.id DESC LIMIT $start_from, $records_per_page");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Students</title>
</head>

<body>
    <a href="addStudents.php">Add New Student</a><br /><br />
    <a href="index.php">List Class</a><br /><br />

    <table width='80%' border=1>
        <tr bgcolor='#CCCCCC'>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Class</td>
            <td>Admission Date</td>
            <td>Actions</td>
        </tr>
        <?php
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['className'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td><a href=\"editStudent.php?id=$row[id]\">Edit</a> | <a href=\"deleteStudent.php?id=$row[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <?php
    // Pagination links
    echo "<br/><br/>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='studentList.php?page=$i'>$i</a> ";
    }
    ?>
</body>

</html>
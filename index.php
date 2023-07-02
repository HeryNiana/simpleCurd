<?php
include_once("config.php");

$result = $dbConn->query("SELECT * FROM class ORDER BY id DESC");
?>

<html>

<head>
	<title>Homepage</title>
</head>

<body>
	<a href="add.html">Add New Class</a><br /><br />
	<a href="studentList.php">Students</a>
	<table width='80%' border=0>

		<tr bgcolor='#CCCCCC'>
			<td>Numéro</td>
			<td>Name</td>
			<td>Section</td>
			<td>Update</td>
		</tr>
		<?php
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr>";
			echo "<td>" . $row['id'] . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['section'] . "</td>";
			echo "<td><a href=\"edit.php?id=$row[id]\">Edit</a> | <a href=\"delete.php?id=$row[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
		}
		?>
	</table>
</body>

</html>
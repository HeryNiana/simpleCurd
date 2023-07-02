<html>

<head>
	<title>Add Data</title>
</head>

<body>
	<?php
	include_once("config.php");

	if (isset($_POST['Submit'])) {
		$name = $_POST['name'];
		$section = $_POST['section'];

		if (empty($name) || empty($section)) {

			if (empty($name)) {
				echo "<font color='red'>Name field is empty.</font><br/>";
			}

			if (empty($section)) {
				echo "<font color='red'>Section field is empty.</font><br/>";
			}

			echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
		} else {

			$sql = "INSERT INTO class(name, section) VALUES(:name, :section)";
			$query = $dbConn->prepare($sql);

			$query->bindparam(':name', $name);
			$query->bindparam(':section', $section);
			$query->execute();

			header("Location: index.php");
		}
	}
	?>
</body>

</html>
<?php
include_once("config.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$name = $_POST['name'];
	$section = $_POST['section'];
	
	if(empty($name) || empty($section)) {	
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($section)) {
			echo "<font color='red'>Section field is empty.</font><br/>";
		}
		
	} else {	
		$sql = "UPDATE class SET name=:name, section=:section WHERE id=:id"; // Correction de la virgule
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':id', $id);
		$query->bindparam(':name', $name);
		$query->bindparam(':section', $section);
		$query->execute();
		
		header("Location: index.php");
	}
}
?>

<?php
$id = $_GET['id'];

$sql = "SELECT * FROM class WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$name = $row['name'];
	$section = $row['section'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $name;?>"></td>
			</tr>
			<tr> 
				<td>Section</td>
				<td><input type="text" name="section" value="<?php echo $section;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>

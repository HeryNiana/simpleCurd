<?php
include_once("config.php");

if (isset($_POST['update'])) {
    $id = $_POST['id'];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $idClass = $_POST['idClass'];
    $date = $_POST['date'];

    if (empty($name) || empty($email) || empty($idClass) || empty($date)) {
        if (empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }

        if (empty($email)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }

        if (empty($idClass)) {
            echo "<font color='red'>Class field is empty.</font><br/>";
        }

        if (empty($date)) {
            echo "<font color='red'>Admission Date field is empty.</font><br/>";
        }
    } else {
        $sql = "UPDATE students SET name=:name, email=:email, idClass=:idClass, date=:date WHERE id=:id";
        $query = $dbConn->prepare($sql);

        $query->bindparam(':id', $id);
        $query->bindparam(':name', $name);
        $query->bindparam(':email', $email);
        $query->bindparam(':idClass', $idClass);
        $query->bindparam(':date', $date);
        $query->execute();

        header("Location: studentList.php");
    }
}
?>

<?php
$id = $_GET['id'];

$sql = "SELECT * FROM students WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $name = $row['name'];
    $email = $row['email'];
    $idClass = $row['idClass'];
    $date = $row['date'];
}
?>

<html>

<head>
    <title>Edit Student</title>
</head>

<body>
    <a href="studentsList.php">Back to List</a>
    <br /><br />

    <form name="form1" method="post" action="editStudent.php">
        <table border="0">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td>Class</td>
                <td>
                    <select name="idClass">
                        <?php
                        $classQuery = $dbConn->query("SELECT * FROM class");
                        while ($classRow = $classQuery->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($classRow['id'] == $idClass) ? 'selected' : '';
                            echo "<option value='" . $classRow['id'] . "' $selected>" . $classRow['name'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Admission Date</td>
                <td><input type="date" name="date" value="<?php echo $date; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>

</html>
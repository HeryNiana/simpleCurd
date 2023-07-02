<?php
include_once("config.php");

if (isset($_POST['Submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $idClass = $_POST['class'];
    $date = $_POST['date'];

    if (empty($name) || empty($email) || empty($idClass) || empty($date)) {
        echo "<font color='red'>Veuillez remplir tous les champs.</font><br/>";
    } else {
        $sql = "INSERT INTO students (name, email, idClass, date) VALUES (:name, :email, :idClass, :date)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':name', $name);
        $query->bindParam(':email', $email);
        $query->bindParam(':idClass', $idClass);
        $query->bindParam(':date', $date);
        $query->execute();

        echo "<font color='green'>L'étudiant a été ajouté avec succès.</font><br/>";
        echo "<br/><a href='studentList.php'>Retour à la liste des étudiants</a>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Students</title>
</head>

<body>
    <?php
    // Récupérer la liste des classes depuis la table 'class'
    $query = $dbConn->query("SELECT * FROM class");
    $classes = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <form action="addStudents.php" method="post" name="form1">
        <table width="50%" border="0">
            <tr>
                <td>Student Name</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Classes</td>
                <td>
                    <select name="class">
                        <option></option>
                        <?php foreach ($classes as $class) : ?>
                            <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td>Admission Date</td>
                <td><input type="date" name="date"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>
</body>

</html>
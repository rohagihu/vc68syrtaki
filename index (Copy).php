<?php

/* Vars */
$DB_FILENAME = "db/test";
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : null;
$delete = isset($_POST['delete']) ? htmlspecialchars($_POST['delete']) : null;
$editNameInput = isset($_POST['editNameInput']) ? htmlspecialchars($_POST['editNameInput']) : null;
$edit = isset($_POST['edit']) ? htmlspecialchars($_POST['edit']) : null;

/* SQLite Connection */
$db = new SQLite3($DB_FILENAME);


/* SQL Query - All Names */
$getAllNames = $db->query("
    SELECT *
    FROM `Names`
    ORDER BY `ID`, `Name`");

/* SQL Query - Insert New Name */
IF (isset($_POST['add']) && $name != null ) {
    $do = $db->exec("
        INSERT INTO `Names`(`Name`) VALUES('$name')
        ");
    $name = null;
    header("Location: index.php");
}

/* SQL Query - Delete Name */
IF (isset($_POST['delete']) && $delete != null ) {
    $do = $db->exec("
        DELETE FROM `Names` WHERE `ID` = '$delete'
        ");
    header("Location: index.php");
}

/* SQL Query - Edit Name */
IF (isset($_POST['edit']) && $editNameInput != null) {
    $do = $db->exec("
        UPDATE `Names` SET `Name` = '$editNameInput' WHERE `ID` = '$edit'
        ");
    header("Location: index.php");

}

?>


<!doctype html>
<html>
<head>
    <meta charset="UTF-8"> 
    <link rel="stylesheet" type="text/css" href="stylesheets/style.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/head.js"></script>
    <script src="js/components/test.js"></script>

    <title>Syrtaki Cup 2018</title>
</head>
<body>
    <section>
        <h2>Add New Name</h2>
        <form method="post" action="index.php">
            Name: <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Name"> 
            <button name="add" type="submit">Senden</button>
        </form>
    </section>

    <section>
        <h2>Names List</h2>
        <form method="post" action="index.php">
            <table>
                <th>ID</th>
                <th>Name</th>

                <?php
                while ($row = $getAllNames->fetchArray()) {
                    echo "  <tr>
                                <td>".$row['ID']."</td>
                                <td class='js-editName'>".$row['Name']."</td>
                                <td>
                                    <button type='submit' name='delete' value='".$row['ID']."'>&#10008</button>
                                </td>
                            </tr>";
                }
                ?>

            </table>
        </form>
    </section>

    <script src="js/footer.js"></script>
</body>
</html>
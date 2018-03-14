<?php

/* No Cache */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

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
    <link rel="stylesheet" type="text/css" href="stylesheets/normalize.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/vendor/foundation.min.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/style.css">
    <script src="js/base.js"></script>
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/object-watch.js"></script>
    <script src="js/head.js"></script>
    <script src="js/components/test.js"></script>
    <script src="js/components/shuffle.js"></script>
    <script src="js/components/watch_teams.js"></script>
    <script src="js/components/start.js"></script>

    <title>Syrtaki Cup 2018</title>
</head>
<body>
    <h1>Einstellungen</h1>

    <form class="einstellungen">
        <h2>Spielmodus:</h2>
        <ul>
            <li><input type="radio" name="spielmodus" value="zeit">
             Zeit
                <ul data-spielmodus="zeit">
                    <li>Spielsätze <input type="number" name="spielsaetze" value="2"></li>
                    <li>Satzdauer <input type="time" name="satzdauer" value="00:15"></li>
                    <li>Spielpause <input type="time" name="spielpause" value="00:10"></li>
                    <li>Spielbeginn <input type="time" name="spielbeginn" value="09:00"></li>
                </ul>
            </li>
            <li><input type="radio" name="spielmodus" value="punkte">
             Punkte
                <ul data-spielmodus="punkte">
                    <li>Spielsätze <input type="number" name="spielsaetze" value="2"></li>
                    <li>bis Punktzahl <input type="number" name="maxpunktzahl" value="15"></li>
                </ul>
            </li>
        </ul>
        <section class="row">
            <h2>Mannschaften</h2>
            <article class="column small-6 teams">
                <ol>
                    <?php
                    for ($i = 0; $i < 15; $i++) {
                        echo "<li><input type='text' value='$i' name='team$i'></li>";
                    }
                    ?>
                </ol>
                <button class="js-shuffle">Mischen</button>
            </article>

            <article class="column small-6 teams">
                <table class="js-finalTeams">
                    <?php
                    for ($i = 0; $i < 5; $i++) {
                        echo "<tr>";
                        for ($j = 0; $j < 3; $j++) {
                            echo "<td><input type='text' name='team".(($j*5)+$i)."' value='".(($j*5)+$i)."'></td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </article>
        </section>
        <button class="js-start">Start</button>
    </form>

    <script src="js/footer.js"></script>
</body>
</html>
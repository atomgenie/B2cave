<?php

require('../../php/bdd.php');
require("modifClass.php");

if(isset($_POST['text'])){
    $modif = new modifClass($bdd, $_POST['tableName']);
    $modif->updateText($_POST['id'], $_POST['text']);
    header("Location: ../");
    return;
}

if(!isset($_GET['id']) || !isset($_GET['tableName'])){
    header("Location: ../");
    return;
}

$modif = new modifClass($bdd, $_GET['tableName']);
$printText = $modif->loadText($_GET['id']);

?>
<form action="modif.php" method="POST" autocomplete="off">
    <textarea autofocus="true" autocomplete="off" name="text" style="
    display: block;
    margin: 30px auto;
    height: 300px;
    width: 800px;
    "><?php echo htmlentities($printText); ?></textarea>
    <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id" />
    <input type="hidden" value="<?php echo $_GET['tableName']; ?>" name="tableName" />
    <input type="submit" />
</form>
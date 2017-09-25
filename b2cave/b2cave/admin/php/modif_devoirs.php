<?php
require('../../php/bdd.php');
$action = $_POST['action'];
if($action == "add"){
    $yolo = $bdd->prepare('INSERT INTO devoirs (curse, text, date, day, month) VALUES (:title, :text, :jour, :date, :month)');
    $yolo->execute(array(
        "title" => $_POST['title'],
        "text" => $_POST['text'],
        "jour" => $_POST['jour'],
        "date" => $_POST['date'],
        "month" => $_POST['month']
    ));
    echo 'Bien Ajouté !';
}
elseif($action == "suppr"){
    $yolo = $bdd->prepare('DELETE FROM devoirs WHERE id = :id');
    $yolo->execute(array(
        "id" => $_POST['id']
    ));
    echo 'Bien Supprimé !';
}
?>
<?php
require('../../php/bdd.php');
$action = $_POST['action'];
if($action == "add"){
    $yolo = $bdd->prepare('INSERT INTO infos (title, text, date) VALUES (:title, :text, 0)');
    $yolo->execute(array(
        "title" => $_POST['title'],
        "text" => $_POST['text']
    ));
    echo 'Bien Ajouté !';
}
elseif($action == "suppr"){
    $yolo = $bdd->prepare('DELETE FROM infos WHERE id = :id');
    $yolo->execute(array(
        "id" => $_POST['id']
    ));
    echo 'Bien Supprimé !';
}
?>
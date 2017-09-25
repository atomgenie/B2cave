<?php
require('bdd.php');
session_start();
$action = $_POST['action'];
if($action == "add"){
    $req = $bdd->prepare('INSERT INTO notepad (user, title, text) VALUES (:user, :title, :text)');
    $req->execute(array(
        "user" => $_SESSION['id'],
        "title" => $_POST['title'],
        "text" => $_POST['text']
    ));
    echo 'Effectué !';
}
elseif($action == "suppr"){
    $req = $bdd->prepare('DELETE FROM notepad WHERE id = :id AND user = :user');
    $req->execute(array(
        "id" => $_POST['id'],
        "user" => $_SESSION['id']
    ));
    echo 'Supprimé !';
}
else{
    echo "Error: Invalid action";
}
    
?>
<?php


require('../../php/bdd.php');
$id = $_POST['id'];
$target = $_POST['action'];
if($target == "add"){
    $req = $bdd->prepare('UPDATE devoirs SET suggest = 0, public = 1 WHERE id = :id');
    $req->execute(array(
        'id' => $id
    ));
    echo "Ajouté !";
}
elseif($target == "del"){
    $req = $bdd->prepare('UPDATE devoirs SET suggest = 0, public = 0 WHERE id = :id');
    $req->execute(array(
        'id' => $id
    ));
    echo "Supprimé !";
}

?>
<?php
require('bdd.php');
$action = $_POST['action'];
session_start();
$id_user = $_SESSION['id'];
if($action == "ajout"){
    $req1 = $bdd->prepare('SELECT * FROM end_devoirs WHERE id_devoirs = :devoir AND name = :id_user');
    $req1->execute(array(
        "devoir" => $_POST['id'],
        "id_user" => $id_user
    ));
    if(!($req1->fetch())){
        // Vérification dans la base de donnée si c'est un devoir créer par l'user
        $req_check = $bdd->prepare('SELECT * FROM devoirs WHERE id = :id AND public = 0 AND id_user = :id_user');
        $req_check->execute(array(
            "id" => $_POST['id'],
            "id_user" => $id_user
        ));
        if($req_check->fetch()){
            $deletion = $bdd->prepare('DELETE FROM devoirs WHERE id = :id');
            $deletion->execute(array(
                "id" => $_POST['id']
            ));
            echo "Fait !";
            return;
        }
        
        
        
        $req2 = $bdd->prepare('INSERT INTO end_devoirs (name, id_devoirs) VALUES (:name, :id_devoirs)');
        $req2->execute(array(
            "name" => $id_user,
            "id_devoirs" => $_POST['id']
        ));
        echo "Fait !";
    }
}

elseif($action == "enlev"){
        $req2 = $bdd->prepare('DELETE FROM end_devoirs WHERE name = :name AND id_devoirs = :id_devoirs');
        $req2->execute(array(
            "name" => $id_user,
            "id_devoirs" => $_POST['id']
        ));
        echo "Fait ! (enlevé)";
}
else{
    echo 'Error';
}

?>
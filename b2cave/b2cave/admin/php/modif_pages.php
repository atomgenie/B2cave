<?php
require('../../php/bdd.php');
if($_POST['action'] == "modif"){    
    $url = $_POST['url'];
    $title = $_POST['title'];
    $text = urldecode($_POST['text']);
    if($_POST['reff'] == 'oui'){
        $reff = 1;
    }
    else{
        $reff = 0;
    }
    $req = $bdd->prepare('UPDATE pages SET title = :title, text = :text, ref = :reff WHERE id = :url');
    $req->execute(array(
        "title" => $title,
        "text" => $text,
        "url" => $url,
        "reff" => $reff
    ));
    $req->CloseCursor();
    echo "ok";
}
elseif($_POST['action'] == "add"){
    $title = $_POST['title'];
    $reff = $_POST['reff'];
    if($reff == "oui"){
        $reff = 1;
    }
    else{
        $reff = 0;
    }
    $req = $bdd->prepare('INSERT INTO pages (title, ref) VALUES (:title, :reff)');
    $req->execute(array(
        "title" => $title,
        "reff" => $reff
    ));
    $req->CloseCursor();
    echo "ok";
    
}
elseif($_POST['action'] == "delete"){
    $url = $_POST['url'];
    $req = $bdd->prepare('DELETE FROM pages WHERE id = :url');
    $req->execute(array(
        "url" => $url
    ));
    $req->CloseCursor();
    echo "Supprimé !";
}
?>
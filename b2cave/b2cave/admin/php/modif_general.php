<?php
require('../../php/bdd.php');

$bdd->query('DELETE FROM general WHERE 1');
$reqe = $bdd->prepare('INSERT INTO general (name, text, date) VALUES (:label, :text, 0)');
$reqe->execute(array(
    "label" => 'titre_accueil',
    "text" => $_POST['title']
));
$reqe->CloseCursor();
$reqe = $bdd->prepare('INSERT INTO general (name, text, date) VALUES (:label, :text, 0)');
$reqe->execute(array(
    "label" => 'text_accueil',
    "text" => $_POST['text']
));
$reqe->CloseCursor();
$reqe = $bdd->prepare('INSERT INTO general (name, text, date) VALUES (:label, :text, 0)');
$reqe->execute(array(
    "label" => 'foot_accueil',
    "text" => $_POST['foot']
));
$reqe->CloseCursor();
echo "Effectué !";

?>
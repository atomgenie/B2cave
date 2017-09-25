<?php
require('bdd.php');
session_start();
$id_user = $_SESSION['id'];

$title = $_POST['title'];
$jour = $_POST['jour'];
$date = intval($_POST['date']);
$mois = intval($_POST['mois']);
$text = $_POST['text'];
$check = ($_POST['check'] == "true") ? true : false;

if(gettype($date) !== "integer" || gettype($date) !== "integer" || gettype($check) !== "boolean" || !id_user){
    echo gettype($check);
    return;
}



$req = $bdd->prepare('INSERT INTO devoirs (curse, text, date, day, month, suggest, public, id_user) VALUES (:curse, :text, :date, :day, :month, :suggest, 0, :id_user)');
$req->execute(array(
    'curse' => $title,
    'text' => $text,
    'date' => $jour,
    'day' => $date,
    'month' => $mois,
    'suggest' => $check,
    'id_user' => $id_user
));
$req->CloseCursor();
if ($check){
    $passage_ligne = "\n";
    $boundary = "-----=".md5(rand());  
    
    $header = "From: \"B2Cave R00T\"<tran@tamtanguy.fr>".$passage_ligne;
    $header.= "Reply-to: \"atomgenie\" <tran@tamtanguy.fr>".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
    
    $sujet = "B2CAVE R00T";
    $sav_user = $bdd->prepare('SELECT * FROM user WHERE id = :id LIMIT 1');
    $sav_user->execute(array(
        'id' => $id_user
    ));
    $user_name = '';
    if($sav_user_d = $sav_user->fetch()){
        $user_name = $sav_user_d['name'];
    }
    $sav_user->CloseCursor();
    $message = '\n '. $user_name .' propose un devoir : \n '. $title .' : '. $text .' \n ------------------------ \n (pour le '. $date .'  '. $day .'  '. $month .' par '. $id_user .')';
    
    file_get_contents('https://smsapi.free-mobile.fr/sendmsg?user=11807800&pass=HgQLHYywHmVyrb&msg='. $user_name);
    mail("clement.david@epita.fr",$sujet,$message,$header);
    
}
echo "yep";

?>
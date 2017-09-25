<?php
require('bdd.php');
$code = $_GET['code'];
$state = $_GET['session_state'];



$url = "https://login.microsoftonline.com/common/oauth2/v2.0/token";

// YA ENCORE DES CHOSES A MODIFIER + CREER UN COMPTE API UR MICROSOFT EN LIGNE POUR L'AUTENTIFICATION AUTH 2.0, MAIS JE SAIS PLUS COMMENT FAIRE ^^

$param = 'client_id=8763bc24-83ea-4713-b71c-38aa18407590&scope=User.Read&code='. $code .'&redirect_uri=URL_DU_SITE&grant_type=authorization_code
&client_secret=CODE_SECRET';


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$responce = curl_exec($curl);
curl_close($curl);
$token2 = json_decode($responce, true);
$token = $token2["access_token"];


$url = "https://graph.microsoft.com/v1.0/me";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '. $token
    ));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$responce = curl_exec($curl);
curl_close($curl);
$data = json_decode($responce, true);
$mail = $data['mail'];
$name = $data['displayName'];
$id = $data['id'];
session_start();
$req = $bdd->prepare('SELECT * FROM user WHERE id = :id');
$req->execute(array(
    'id' => $id
));
if($req->fetch()){
    $_SESSION['id'] = $id;
}
else{
    $req2 = $bdd->prepare('INSERT INTO user (id, name, mail) VALUES (:id, :user, :mail)');
    $req2->execute(array(
        'id' => $id,
        'user' => $name,
        'mail' => $mail
    ));
    $_SESSION['id'] = $id;
}

header('Location: ..');


?>
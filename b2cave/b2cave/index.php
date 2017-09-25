
<?php
require('php/bdd.php');
session_start();
$req = $bdd->prepare('SELECT * FROM user WHERE id = :id LIMIT 1');
$req->execute(array(
    'id' => $_SESSION['id']
));
$co = false;
if($donnees = $req->fetch()){
    $co = true;
    $req->CloseCursor();
}
$normal = $bdd->query('SELECT * FROM general');
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css"/>
        <title>B2 Cave</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,400,400i,700" rel="stylesheet">
        <link rel="icon" type="image/png" href="images/noun_570431_cc.png" />
    </head>
    <body>
     
        <script src="assets/jquery.js"></script>
       <header>
          <?php
           include('templates/header.php');
           ?>
       </header>
       <nav>
          <?php
           include('templates/nav.php');
           ?>
       </nav>
       <div id="main">
           <div class="alert">
               <div class="title"><h2><?php $data = $normal->fetch(); echo htmlentities($data['text']); ?></h2></div>
               <div class="text"><p><?php $data = $normal->fetch(); echo nl2br($data['text']); ?>
               
                
               </p></div>
               <div class="foot"><?php $data = $normal->fetch(); echo htmlentities($data['text']); ?></div>
           </div>
       </div>
       <div id="all">
           <div class="countain">
               <table>
                   <tr>
                       <td class="left" onclick="window.location.href = 'QCM/';">
                           <div class="in">
                                QCM
                           </div>
                       </td>
                       <td class="middle" onclick="window.location.href = 'devoirs/';">
                           <div class="in">
                               Devoirs
                           </div>
                       </td>
                       <td class="right" onclick="window.location.href = 'infos/';">
                           <div class="in">
                               Informations
                           </div>
                       </td>
                   </tr>
               </table>
           </div>
       </div>
       <footer onclick="easteregg();" style="cursor: pointer;">
       <?php
           include('templates/footer.php');
           ?>
       </footer>
        <script src="script.js"></script>
        <script>
        </script>
    </body>
</html>
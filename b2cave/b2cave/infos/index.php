
<?php
require('../php/bdd.php');
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
        <link rel="stylesheet" href="../style.css"/>
        <title>B2 Cave</title>
        <link rel="icon" type="image/png" href="../images/noun_570431_cc.png" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,400,400i,700" rel="stylesheet">
    </head>
    <body>
     
        <script src="../assets/jquery.js"></script>
      
       <header>
       <?php
           include('../templates/header.php');
           ?>
       </header>
       <nav>
           <?php
           include('../templates/nav.php');
           ?>
       </nav>
       
       <div id="all_info">
           <div class="countain">
               <h3>Infos</h3>
               <div id="list_info">
                   <?php
                   $info = $bdd->query('SELECT * FROM infos ORDER BY id DESC');
                   $i = 1;
                   while($list_info = $info->fetch()){
                       ?>
                       <div class="info">
                           <div class="title_info"><?php echo $i .'. '. htmlentities($list_info['title']); ?> : </div>
                           <div class="text_info"><?php echo nl2br(htmlentities($list_info['text'])); ?></div>
                       </div>
                       <?
                       $i++;
                   }
                   
                   $info->CloseCursor();
                   ?>
               </div>
           </div>
       </div>
       <footer>
           <?php
           include('../templates/footer.php');
           ?>
       </footer>
        <script src=".. /script.js"></script>
    </body>
</html>
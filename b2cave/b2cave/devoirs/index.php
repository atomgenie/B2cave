
<?php
require('../php/bdd.php');
session_start();
$req = $bdd->prepare('SELECT * FROM user WHERE id = :id LIMIT 1');
$req->execute(array(
    'id' => $_SESSION['id']
));
$co = false;
if($donnees = $req->fetch()){
    if($donnees['ban'] !== '0'){
        header('Location: '. $donnees['ban']);
        return;
    }
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
        <link rel="stylesheet" href="../assets/alertify.min.css" />
        <link rel="stylesheet" href="../assets/semantic.min.css" />
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
       
       <div id="all_devoirs">
           <div class="countain">
               <h3>Devoirs</h3>
               <div id="list_devoirs">
                   <?php
                   if($co){
                        
                       $devoirs = $bdd->prepare('SELECT * FROM devoirs WHERE public = 1 OR id_user = :user ORDER BY month, day');
                       $devoirs->execute(array(
                            "user" => $_SESSION['id']
                       ));
                       }
                   else{
                        $devoirs = $bdd->query('SELECT * FROM devoirs WHERE public = 1 ORDER BY month, day');
                   }
                   while($list_devoirs = $devoirs->fetch()){
                       ?>
                       <div class="devoirs <?php
                       if($co){
                           $fait = $bdd->prepare('SELECT * FROM end_devoirs WHERE name = :name AND id_devoirs = :id_devoirs');
                           $fait->execute(array(
                               "name" => $donnees['id'],
                               "id_devoirs" => $list_devoirs['id']
                           ));
                           if($do = $fait->fetch()){
                               echo 'opa';
                               $deja = true;
                           }
                           else{
                               $deja = false;
                           }
                       }
                       ?>">
                          <?php
                       
                       if($co){
                           ?>
                           
                           <div class="fait_devoirs"<?php
                           
                           if($deja){
                               echo ' onclick="enlev_fait(\''. $list_devoirs['id'] .'\');">';
                               echo 'Enlever de "Fait"';
                           }
                           else{
                               echo ' onclick="ajout_fait(\''. $list_devoirs['id'] .'\');">';
                               echo 'Ajouter à "Fait"';
                           }
                           
                           ?></div>
                           
                           <?php
                       }
                       
                       ?>
                           <div class="date_devoirs"><?php echo $list_devoirs['date'] .' '. $list_devoirs['day'] .'/'. $list_devoirs['month']; ?></div>
                           <div class="title_devoirs"><?php echo htmlentities($list_devoirs['curse']); ?> : </div>
                           <div class="text_devoirs"><?php echo nl2br($list_devoirs['text']); ?></div>
                       </div>
                       <?php
                   }
                   
                   $devoirs->CloseCursor();
                   if($co){
                        ?>
                        <div class="button_add_devoirs" onclick="add_devoirs();">
                            Ajouter des devoirs
                        </div>
                        <?php
                   }
                   
                   
                   ?>
               </div>
               </div>
           </div>
           <?php
           
           
                   if($co){
                        ?>
                        <div id="surface" onclick="go_normal();">
                        </div>
                         <div id="in_surface">
                             <h2>Ajouter des Devoirs</h2>
                             <div class="surface_form">
                                <label>Titre de la matière :</label>
                                <input type="text" class="surface_title" placeholder="Maths, Algo..." />
                                <label>Jour (en lettres) du devoir :</label>
                                <input type="text" class="surface_jour_lettre" placeholder="Lundi, Mardi..." />
                                <label>Jour (en chiffre) du devoir :</label>
                                <input type="text" class="surface_jour_chiffre" placeholder="1, 15..." />
                                <label>Mois (en chiffre) :</label>
                                <input type="text" class="surface_mois" placeholder="1, 11..." />
                                <label>Texte du devoir :</label>
                                <textarea class="surface_text"></textarea>
                                <br>
                                <label class="label_spe" style="display: inline-block;">Proposer le devoir à tous le monde ?</label>
                                <input type="checkbox" class="surface_check" />
                                <br>
                                <div class="envoyer_new_devoir" onclick="envoyer_devoir();">Envoyer</div>
                             </div>
                         </div>
                        <?php
                   }
           
           ?>
           
       <footer>
           <?php
           include('../templates/footer.php');
           ?>
       </footer>
       <script src="../assets/alertify.min.js"></script>
        <script src="../script.js"></script>
        <?php
        if($co){
            ?>
            <script>
        
        </script>
            <?php
        }
        ?>
    </body>
</html>
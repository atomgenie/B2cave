
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
if($co){
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../style.css"/>
        <title>B2 Cave</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,400,400i,700" rel="stylesheet">
        <link rel="stylesheet" href="../assets/alertify.min.css" />
        <link rel="stylesheet" href="../assets/semantic.min.css" />
        <link rel="icon" type="image/png" href="../images/noun_570431_cc.png" />
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
       
       <div id="all_notepad">
           <div class="countain">
               <h3>NotePad</h3>
               
               <div id="list_notepad">
                   <?php
    $reqe = $bdd->prepare('SELECT * FROM notepad WHERE user = :user ORDER BY id ASC');
    $reqe->execute(array(
        "user" => $_SESSION['id']
    ));
    while($data = $reqe->fetch()){
        ?>
        <div class="col_notepad">
           <div class="suppr_notepad" onclick="suppr_notepad('<?php echo $data['id']; ?>');">Supprimer</div>
            <div class="title_notepad"><?php echo htmlentities($data['title']); ?> :</div>
            <div class="text_notepad"><?php echo nl2br(htmlentities($data['text'])); ?></div>
        </div>
        <?php
    }
    $reqe->CloseCursor();
    ?>
              <div class="ajout_notepad" onclick="ajout_notepad();">Ajouter une note</div>
              <div class="hide_notepad">
              <textarea name="" id="" cols="30" rows="10" class="textarea_notepad"></textarea>
              <div class="ajout_notepad_enr">Enregistrer</div>
                   </div>
               </div>
               
               </div>
           </div>
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
<?php
}
?>
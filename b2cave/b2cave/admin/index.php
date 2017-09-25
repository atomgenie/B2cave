<?php

require('../php/bdd.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css"/>
        <title>B2 Cave | ADMIN</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,400,400i,700" rel="stylesheet">

    </head>
    <body>
     
        <script src="../assets/jquery.js"></script>
      <table id="table_main">
          <tr>
              <td id="nav_left">
                 <h1>Admin B2 Cave</h1>
                 <div class="section">Général</div>
                 <div class="puce" onclick="charge('#main');">Accueil</div>
                  <div class="section">Pages</div>
                  <div class="puce" onclick="charge('#devoirs');">Devoirs</div>
                  <div class="puce" onclick="charge('#qcm');">QCM</div>
                  <div class="puce" onclick="charge('#infos');">Infos</div>
                  <div class="section">Modération</div>
                  <div class="puce" onclick="charge('#modo');">Devoirs Proposés</div>
                  <div class="puce" onclick="charge('#user');">Liste User</div>
                  <div class="section">Pages</div>
                  <?php
                  $pages = $bdd->query('SELECT * FROM pages ORDER BY id DESC');
                  while($pages_d = $pages->fetch()){
                    ?>
                    
                  <div class="puce" onclick="charge_page('<?php echo $pages_d['id']; ?>');"><?php echo $pages_d['title']; ?></div>
                  
                    <?php
                  }
                  $pages->CloseCursor();
                  ?>
                  <div class="puce" onclick="ajout_pages();">Ajouter une page</div>
                  <div class="li_nav"></div>
              </td>
              <td id="nav_right">
                  <div id="main" class="full">
                      <div class="contain">
                          <h2>Bonjour,</h2>
                          <?php
                          $reqe = $bdd->query('SELECT * FROM general');
                          
                          ?>
                          <input type="text" value="<?php $data = $reqe->fetch(); echo htmlentities($data['text']); ?>" class="input_title_general" />
                          
                          <textarea class="input_text_general"><?php $data = $reqe->fetch(); echo htmlentities($data['text']); ?></textarea>
                          
                          <input type="text" value="<?php $data = $reqe->fetch(); echo htmlentities($data['text']); ?>" class="input_title_foot" />
                          
                          <a class="envoyer_general">Envoyer</a>
                      </div>
                  </div>
                  <div id="devoirs" class="full">
                      <div class="contain">
                          <h3>Devoirs</h3>
                          <a class="ajouter ajouter_devoirs">Ajouter</a>
                          <div class="div_ajout div_ajout_devoirs">
                              <textarea class="textarea_devoirs"></textarea>
                              <a class="a_envoyer_devoirs">Envoyer</a>
                          </div>
                          <div class="list devoirs_list">
                              <?php
                              $reqe = $bdd->query('SELECT * FROM devoirs WHERE suggest = 0 AND public = 1 ORDER BY month, day');
                              while($datas = $reqe->fetch()){
                                  ?>
                                  <div class="col">
                                      <a class="suppr" onclick="suppr_devoirs('<?php echo $datas['id']; ?>');">Supprimer</a>
                                      <a class="modif" onclick="modifTextAll('<?php echo $datas['id']; ?>', 'devoirs');">Modifier</a>
                                      <span class="info_date"><?php echo $datas['date'] .' '. $datas['day'] .'/'. $datas['month']; ?></span>
                                      <div class="text"><?php
                                  echo $datas['curse'] .' : '. $datas['text'];
                                  
                                  ?></div>
                                  </div>
                                  <?php
                              }
                              $reqe->CloseCursor();
                              
                              ?>
                          </div>
                      </div>
                  </div>
                  <div id="qcm" class="full">
                      <div class="contain">
                          <h3>QCM</h3>
                          <a class="ajouter ajouter_qcm">Ajouter</a>
                          <div class="div_ajout div_ajout_qcm">
                              <textarea class="textarea_qcm"></textarea>
                              <a class="a_envoyer_qcm">Envoyer</a>
                          </div>
                          <div class="list qcm_list">
                              <?php
                              $reqe = $bdd->query('SELECT * FROM QCM ORDER BY id DESC');
                              while($datas = $reqe->fetch()){
                                  ?>
                                  <div class="col">
                                      <a class="suppr" onclick="suppr_qcm('<?php echo $datas['id']; ?>');">Supprimer</a>
                                      <a class="modif" onclick="modifTextAll('<?php echo $datas['id']; ?>', 'QCM');">Modifier</a>
                                      <div class="text"><?php
                                  echo $datas['curse'] .' : '. $datas['text'];
                                  
                                  ?></div>
                                  </div>
                                  <?php
                              }
                              $reqe->CloseCursor();
                              
                              ?>
                          </div>
                      </div>
                  </div>
                  <div id="infos" class="full">
                      <div class="contain">
                          <h3>Infos</h3>
                          <a class="ajouter ajouter_infos">Ajouter</a>
                          <div class="div_ajout div_ajout_infos">
                              <textarea class="textarea_infos"></textarea>
                              <a class="a_envoyer_infos">Envoyer</a>
                          </div>
                          <div class="list infos_list">
                              <?php
                              $reqe = $bdd->query('SELECT * FROM infos ORDER BY id DESC');
                              while($datas = $reqe->fetch()){
                                  ?>
                                  <div class="col">
                                      <a class="suppr" onclick="suppr_infos('<?php echo $datas['id']; ?>');">Supprimer</a>
                                      <a class="modif" onclick="modifTextAll('<?php echo $datas['id']; ?>', 'infos');">Modifier</a>
                                      <div class="text"><?php
                                  echo $datas['title'] .' : '. $datas['text'];
                                  
                                  ?></div>
                                  </div>
                                  <?php
                              }
                              $reqe->CloseCursor();
                              
                              ?>
                          </div>
                      </div>
                  </div>
                  <div id="modo" class="full">
                          <h3>Devoirs Proposés</h3>
                      <div class="contain">
                          <div class="list devoirs_list">
                              <?php
                              $reqe = $bdd->query('SELECT * FROM devoirs WHERE suggest = 1 AND public = 0 ORDER BY month, day');
                              while($datas = $reqe->fetch()){
                                  ?>
                                  <div class="col">
                                      <a class="suppr" onclick="suppr_devoirs_modo('<?php echo $datas['id']; ?>');">Supprimer</a>
                                      <a class="modif" onclick="add_devoir_modo('<?php echo $datas['id']; ?>');">Ajouter</a>
                                      <span class="info_date"><?php echo $datas['date'] .' '. $datas['day'] .'/'. $datas['month']; ?></span>
                                      <div class="text"><?php
                                  echo $datas['curse'] .' : '. $datas['text'];
                                  
                                  ?></div>
                                  </div>
                                  <?php
                              }
                              $reqe->CloseCursor();
                              
                              ?>
                          </div>
                      </div>
                  </div>
                  <div id="user" class="full">
                      <div class="contain">
                          <h3>Liste des users</h3>
                          <div class="list_user">
                              <?php
                              $reqe = $bdd->query('SELECT * FROM user ORDER BY name ASC');
                              while($data = $reqe->fetch()){
                                  ?>
                                  
                                  <div class="col_user">
                                      <span class="user_name"><?php echo $data['name']; ?></span>
                                      <span class="user_id"><?php echo $data['id']; ?></span>
                                      <span class="user_mail"><?php echo $data['mail']; ?></span>
                                  </div>
                                  
                                  <?php
                                  
                              }
                              $reqe->CloseCursor();
                              ?>
                          </div>
                      </div>
                  </div>
                  <div id="pages" class="full">
                      <div class="contain">
                          <h3>Pages</h3>
                          <div class="pages_text">
                              
                          </div>
                      </div>
                  </div>
                  
              </td>
          </tr>
      </table>
      
      
      
      
     
        <script src="script.js"></script>
        <script>
            $('#table_main').height($(window).height());
            
            function charge(actu){
                $('.full').css('display', 'none');
                console.log(actu);
                $(actu).css('display', 'block');
            };
            
        </script>
    </body>
</html>
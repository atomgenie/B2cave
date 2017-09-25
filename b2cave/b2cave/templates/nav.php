 <div class="countain">
               <div class="puce" onclick="window.location.href = '/b2cave';">Accueil</div>
               <div class="puce" onclick="window.location.href = '/b2cave/devoirs';">Devoirs</div>
               <div class="puce" onclick="window.location.href = '/b2cave/QCM';">QCM</div>
               <div class="puce" onclick="window.location.href = '/b2cave/infos';">Infos</div>
               <?php if($co){ ?><div class="puce" onclick="window.location.href = '/b2cave/notepad';">NotePad</div><?php }?>
               <?php
              $pages_nav = $bdd->query('SELECT * FROM pages WHERE ref = 1');
              while($pages_nav_d = $pages_nav->fetch()){
                            ?>
               <div class="puce" onclick="window.location.href = '/b2cave/pages/?url=<?php echo $pages_nav_d['id']; ?>';"><?php echo $pages_nav_d['title']; ?></div>
                            <?php
              }
              $pages_nav->CloseCursor();
               ?>
           </div>
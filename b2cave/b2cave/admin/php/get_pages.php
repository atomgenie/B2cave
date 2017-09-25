<?php
require('../../php/bdd.php');
$id = $_GET['url'];
$pages = $bdd->prepare('SELECT * FROM pages WHERE id = :url LIMIT 1');
$pages->execute(array(
    'url' => $id
));
if($pages_d = $pages->fetch()){
    ?>
    <div>url : https://b2cave.tamtanguy.fr/b2cave/pages/?url=<?php echo $pages_d['id']; ?></div>
    <div class="pages_action pages_modifier" onclick="show_area_pages();">Modifier</div>
    <div class="pages_action pages_delete" onclick="supprimer_pages('<?php echo $pages_d['id']; ?>');">Supprimer</div>
    <div class="pages_text_contain">
        <h4><?php echo $pages_d['title']; ?></h4>
        <p><?php echo $pages_d['text']; ?></p>
    </div>
    <div class="pages_form" style="display: none;">
        <input type="text" value="<?php echo htmlentities($pages_d['title']); ?>" class="pages_input_title" />
        <textarea id="pages_area_text" class="pages_area_text"><?php echo htmlentities($pages_d['text']); ?></textarea>
        <div class="bouton_envoyer_pages" onclick="envoyer_pages('<?php echo $pages_d['id']; ?>');">Envoyer</div>
    </div>
    
    
    
    <?php
}
else{
    echo "Erreur ! (Pas de pages sous ce noms...)";
}


?>
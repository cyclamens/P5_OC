<?php $title = 'Administrateur'; ?>

<?php ob_start(); ?>
<div id="admin">
    <strong>Page de rédaction des catégories :</strong><button><a href="index.php?action=redaction">REDACTION DES CATEGORIES</a>
    </button><br><br>
    <strong>Page de rédaction des topics :</strong><button><a href="index.php?action=nouveautopic">REDACTION DES TOPICS</a>
    </button><br><br>
    <div id="flagcomment"> 
        <h4><em>Liste des topics</em></h4>
        <?php
        while ($data = $posts->fetch())://affiche les topics dans l'admin
        
        ?>
            <h3>
                <strong><?= $data['title'] ?></strong>
                <em>le <?= $data['creation_date_fr'] ?></em>
                <a href="index.php?action=modifTopic&id=<?=$data['topic_id'] ?>" title="Modifier le topic" >Modifier</a>
                <a href="index.php?action=supprimTopic&id=<?=$data['topic_id'] ?>" title="Supprimer le topic" class="supprim">Supprimer</a>
            </h3>    
        
        <?php
        endwhile;
        $posts->closeCursor();
        ?>
        <br><br>
        <h4><em>Liste des catégories</em></h4>
        <?php
        while ($cat = $cats->fetch())://affiche les catégories dans l'admin
        
        ?>
            <h3>
                <strong><?= $cat['title'] ?></strong>
                <em>le <?= $cat['creation_date_fr'] ?></em>
                <a href="index.php?action=modifCategorie&id=<?=$cat['categorie_id'] ?>" title="Modifier la catégorie" >Modifier</a>
                <a href="index.php?action=supprimCategorie&id=<?=$cat['categorie_id'] ?>" title="Supprimer la catégorie" class="supprim">Supprimer</a>
            </h3>    
        
        <?php
        endwhile;
        $cats->closeCursor();
        ?>
        <br><br>
        <h4><em>Liste des commentaires signalés</em></h4>
        <?php
        while ($comment = $flagComments->fetch())://affiche les commentaires signalés dans l'admin
        
        ?>      
            <div id="postcomment"><strong><?= $comment['author']?></strong>  : <?= nl2br($comment['content']) ?>, le <?= $comment['comment_date_fr'] ?>
                <a href="index.php?action=designal&id=<?=$comment['comment_id'] ?>" title="Désignaler le commentaire">Désignaler</a>
                <a href="index.php?action=supprimeComment&id=<?=$comment['comment_id'] ?>" title="Supprimer le commentaire" class="supprim" >Supprimer</a>

            </div>
        <?php
        endwhile;
        $flagComments->closeCursor();
        ?>

    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
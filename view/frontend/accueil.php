<?php $title = 'Accueil'; ?>
<?php ob_start(); ?>


<h1>Forum</h1>
<p id="paraforum"> L'environnement est au coeur de nos activités et fait parti de nos préoccupations. C'est la raison pour laquelle ce site est fait pour vous. Nous avons souhaité par le biais de ce forum, développer un module de sensibilisation environnementale, afin de favoriser par tous l'appropriation des thématiques de l'environnement. </p>

<?php
$categorie = '';
while($data = $catopic->fetch()):

  if($data['catitle'] != $categorie){//si on change de categorie
    if($categorie != ''){//si ce n'est pas la première categorie
      ?>
    </div>
<?php
}
?>
<div id="containcatopic">
  <h2 class="btn btn-primary btn-lg"><?=$data['catitle']?></h2>

<?php
  $categorie = $data['catitle'];
}
?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>
       
        </th>
        <th>
        
        </th>
        <th>
        
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <h4><a href="index.php?action=topic&id=<?=$data['topic_id']?>"><?=$data['toptitle']?></a></h4>
        </td>
        <td>
          <em>par <?=$data['pseudo']?></em>
        </td>
        <td>
          <em>le <?=$data['creation_date_fr']?></em>
        </td>
      </tr>
    </tbody>
  </table>
<?php
endwhile;
?>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
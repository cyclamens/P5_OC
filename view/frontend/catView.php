<?php ob_start(); ?>
 
 <?php
 while($c = $post->fetch())
{
?>

<div id="news">
    <h2><?=$c['title']?><br><br> le <em><?=$c['creation_date_fr']?></em></h2>
    
</div>
<?php
}
?>


<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>

<?php $title = 'Modification d\'un topic'; ?>

<?php ob_start(); ?>

<h2>Modification du topic</h2>
<?php if(isset($_SESSION['adminconnect']) && ($_SESSION['adminconnect'] == 1)): ?>
<!--formulaire qui permet de modifier un topic -->
<div id="modiftopic">
	<form action="index.php?action=saveTopic&id=<?= $_GET['id']?>" method="post">
		<div class="input-group flex-nowrap">
  			<div class="input-group-prepend">
    			<span class="input-group-text" id="addon-wrapping">Sujet :</span>
  			</div>
  			<input type="text" name="topic_title"  id="sujet" class="form-control" aria-label="Votre Sujet" aria-describedby="addon-wrapping" value="<?=$editTopic['title']?>" />
		</div>
		<div class="input-group flex-nowrap">
  			<div class="input-group-prepend">
    			<span class="input-group-text" id="addon-wrapping">Message :</span>
  			</div>
  			<textarea  name="topic_content" id="editor" cols="70" rows="15"  class="form-control" aria-label="Votre message" aria-describedby="addon-wrapping" >
  				<?= nl2br($editTopic['content']) ?>
  			</textarea>
		</div>
	
		<input type="submit" value="Envoyer le topic" class="btn btn-primary"/>
	</form>
</div>	
<?php else:?>
	 <?php throw new Exception("Page réservée à l'administrateur");?>
<?php endif; ?>	  

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
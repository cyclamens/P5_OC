<?php $title = 'Modification d\'une catégorie'; ?>

<?php ob_start(); ?>

<h2>Modification d'une catégorie</h2>
<?php if(isset($_SESSION['adminconnect']) && ($_SESSION['adminconnect'] == 1)): ?>
<!--formulaire qui permet de modifier une catégorie -->
	<form action="index.php?action=saveCategorie&id=<?= $_GET['id']?>" method="post">
		<div class="input-group flex-nowrap">
  			<div class="input-group-prepend">
    			<span class="input-group-text" id="addon-wrapping">Sujet :</span>
  			</div>
  			<?php
  			while($cat = $editCat->fetch())
  			{
  			?>
  			<input type="text" name="cat_title"  id="sujet" class="form-control" aria-label="Votre Sujet" aria-describedby="addon-wrapping" value="<?=$cat['title']?>" />
  			<?php
  			}
  			?>
		</div>
		
		<input type="submit" value="Envoyer la catégorie" class="btn btn-primary"/>
	</form>
<?php else:?>
	 <?php throw new Exception("Page réservée à l'administrateur");?>
<?php endif; ?>	  

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>


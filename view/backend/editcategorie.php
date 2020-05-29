<?php $title = 'Rédaction des catégories'; ?>

<?php ob_start(); ?>

<h2>Rédaction</h2>
<?php if(isset($_SESSION['adminconnect']) && ($_SESSION['adminconnect'] == 1)): ?>
<!--formulaire de rédaction des catégories -->
	<form action="index.php?action=redaction" method="post">
		<input type="text" name="cat_title" placeholder="Titre">
		<input type="submit" value="Envoyer la catégorie" class="btn btn-primary" />	
	</form>
<?php else:?>
	<?php throw new Exception("Page réservée à l'administrateur");?>
<?php endif; ?>	  

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
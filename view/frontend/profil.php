<?php $title = 'Mon profil'; ?>
<?php ob_start(); ?>

	<div id="profil" align="center">
                <h2>Profil de <?php echo $_SESSION['pseudoconnect']; ?></h2>
                <img src="public/membres/avatars/<?= $_SESSION['avatarconnect'];?>" width="85O">
                <br /><br />
                Pseudo = <?php echo $_SESSION['pseudoconnect']; ?>
                <br />
                Mail = <?php echo $_SESSION['mailconnect'];?>
                <br />
                <?php if(isset($_SESSION['idconnect']) AND $_SESSION['pseudoconnect']): ?>
        
                <br />
         	<a href="index.php?action=editprofil&id=<?=$_SESSION['idconnect'] ;?>" class="btn btn-primary">Editer mon profil</a>
         	<a href="index.php?action=deconnexion" class="btn btn-danger">Se déconnecter</a>
                <?php endif; ?>
         
 	</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
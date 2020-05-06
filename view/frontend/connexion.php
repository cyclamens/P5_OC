<?php $title = 'Connexion'; ?>
<?php ob_start(); ?>
<div id="connexion" align="center">
	<h2>Connexion</h2>
	<!--formulaire de connexion -->
	<form method="POST" action="">
		<div class="form-group">
			<label for="pseudo">Pseudo :
				<input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudoconnect" class="form-control" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" required />
			</label>	
    	</div>
		
		<div class="form-group">
			<label for="mdp">Mot de passe :
				<input type="password" placeholder="Votre mot de passe" id="mdp" name="mdpconnect" class="form-control" required >
			</label>
		</div>
		<button type="submit" name="formconnexion" class="btn btn-primary">Se connecter</button>
		<p>Pas encore de compte ?</p><button><a href="index.php?action=inscription">S'inscrire</a></button>
	</form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
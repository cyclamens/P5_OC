<?php $title = 'Inscription'; ?>
<?php ob_start(); ?>

<div id="inscription" align="center">
	<h2>Inscription</h2>
	<!--formulaire d'inscription -->
	<form method="POST" action="">
		
		<div class="form-group" >
			<label for="pseudo">Pseudo :
				<input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" class="form-control" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" required />
			</label>	
    	</div>
    	<div class="form-group">		
			<label for="mail">mail :
				<input type="email" placeholder="Votre mail" id="mail" name="mail" class="form-control" value="<?php if(isset($mail)) { echo $mail; } ?>" required />
			</label>		
		</div>
		<div class="form-group">	
			<label for="mail2">Confirmation du mail :
				<input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" class="form-control" value="<?php if(isset($mail2)) { echo $mail2; } ?>" required  />
			</label>
		</div>
		<div class="form-group">
			<label for="mdp">Mot de passe :
				<input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" class="form-control"  required="" >
			</label>
		</div>
		<div class="form-group">
			<label for="mdp2">Confirmation du mot de passe :
				<input type="password" placeholder="Confirmation du mdp" id="mdp2" name="mdp2" class="form-control" required=""  >
			</label>
		</div>
		<button type="submit" name="forminscription" class="btn btn-primary" id="submit">S'inscrire</button>
		<button><a href="index.php?action=connexion">Se connecter</a></button>
	
	</form>
</div>
<!--test de validation coté client-->
<script src="public/js/testInscription.js"></script>
<script src="public/js/mainConfirm.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
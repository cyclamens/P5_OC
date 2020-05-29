<?php $title = 'Editer mon profil'; ?>
<?php ob_start(); ?>
        <div id="editprofil" align="center">
                <h2>Edition de mon profil</h2>
                <div >
                        <form method="POST" action="index.php?action=validprofil&id=<?=$_SESSION['idconnect'] ;?>" enctype="multipart/form-data">
                                <label>Pseudo :</label>
                                <input type="text" name="newpseudo" id="newpseudo"placeholder="Pseudo" value="<?= $_SESSION['pseudoconnect']; ?>" required /><br /><br />
                                <label>Mail :</label>
                                <input type="text" name="newmail" placeholder="Mail" value="<?=$_SESSION['mailconnect']; ?>" id="newmail" required /><br /><br />
                                <label>Mot de passe :</label>
                                <input type="password" name="newmdp1" placeholder="Mot de passe" id="newmdp1" required /><br /><br />
                                <label>Confirmation - mot de passe :</label>
                                <input type="password" name="newmdp2" placeholder="Confirmation du mdp" id="newmdp2" required /><br /><br />
                              
                                <label>Avatar :</label><input type="file" name="avatar"/><br><br>
                                <input type="submit" value="Mettre à jour mon profil !" class="btn btn-primary" id="submit" />
                        </form>

                </div>
        </div>
        <script src="public/js/validProfil.js"></script>
	<script src="public/js/mainProfil.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
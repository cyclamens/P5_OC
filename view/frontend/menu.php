<!--le menu du site -->
<div id="header">
  <p id="logo">
    <a href=""><img src="public/image/ecolo3.gif"><em>LE COIN ECOLO</em></a>
  </p>
  <input type="checkbox" id="chk">
    <label for="chk" id="show-menu-btn">
    	<i class="fas fa-bars"></i>
    </label>
  <ul id="menu">
    <a href="index.php">Forum</a>
    <?php if(isset($_SESSION['pseudoconnect'])): ?>
    <label for="chk" id="hide-menu-btn">
      <i class="fas fa-times"></i>
    </label>
    <?php if($_SESSION['adminconnect']==1)
      echo'<a href="index.php?action=administration">administrateur</a>';?>  
    <a href="index.php?action=profil">Mon profil</a>
    <a href="index.php?action=nouveautopic">Créer un sujet</a>                             
    <a href="index.php?action=deconnexion" class="btn btn-danger btn-lg" title="Se déconnecter">Déconnexion</a>
    <a href="index.php?action=profil" title="Accéder à mon profil"><img src="public/membres/avatars/<?= $_SESSION['avatarconnect'];?>" id="avatar" ></a>
    <?php else:?>
    <a href="index.php?action=inscription" class="btn btn-primary btn-lg" title="S'inscrire">Inscription</a>
    <a href="index.php?action=connexion" class="btn btn-success btn-lg" title="Se connecter">Connexion</a>
    <label for="chk" id="hide-menu-btn">
      <i class="fas fa-times"></i>
    </label>  
    <?php endif; ?>      		
  </ul>
</div>
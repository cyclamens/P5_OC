<!--le menu du site -->
<div id="header">
  <p id="logo"><a href=""></a></p>
  <input type="checkbox" id="chk">
    <label for="chk" id="show-menu-btn">
    	<i class="fas fa-bars"></i>
    </label>
  <ul id="menu">
    <a href="">Accueil</a>
    <a href="">Forum</a>
    <?php if(isset($_SESSION['pseudoconnect'])): ?>
      <label for="chk" id="hide-menu-btn">
        <i class="fas fa-times"></i>
      </label>
      <?php if($_SESSION['adminconnect']==1)
        echo'<a href="index.php?action=administration">administrateur</a>';?>                             
      <a href="index.php?action=deconnexion">Déconnexion</a>
    <?php else:?>
      <button type="button" class="btn btn-primary btn-lg"><a href="index.php?action=inscription">Inscription</a></button>
      <a href="index.php?action=connexion">Connexion</a>
      <label for="chk" id="hide-menu-btn">
        <i class="fas fa-times"></i>
      </label>  
    <?php endif; ?>      		
  </ul>
</div>
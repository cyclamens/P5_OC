<?php $title = 'Nouveau topic'; ?>

<?php ob_start(); ?>

<!--formulaire de rédaction d'un topic -->
<form method="POST" action="index.php?action=insertopic">
   
    <h4 id="topic">Créer un nouveau Topic</h4>
     
    <div class="input-group flex-nowrap">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="addon-wrapping">Sujet :</span>
  		</div>
  		<input type="text" name="tsujet" placeholder="Votre Sujet" id="sujet" class="form-control" aria-label="Votre Sujet" aria-describedby="addon-wrapping" />
	</div>
  <div class="input-group flex-nowrap">
    <div class="input-group-prepend">
        <span class="input-group-text" id="addon-wrapping">Catégorie :</span>
    </div>
      <select  class="form-control" name="catSelect" id="catSelect">
        
        <?php
        $selected = "selected";
        while ($cat = $post->fetch()) 
        {
        ?> 
        <option <?=$selected?> value="<?=$cat['categorie_id']?>"><?=$cat['title']?></option>
        
        <?php
        $selected = "";
        }
        ?>
      </select>
  </div>    
    <div class="input-group flex-nowrap">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="addon-wrapping">Message :</span>
  		</div>
  		<textarea name="tcontenu" id="editor" cols="70" rows="15" placeholder="Votre message..." class="form-control" aria-label="Votre message" aria-describedby="addon-wrapping" ></textarea>
	</div>
    <input type="submit" name="tsubmit" value="Poster le Topic" class="btn btn-primary" id="submit" />
</form>

<!--test de validation coté client-->
<script src="public/js/validTopic.js"></script>
<script src="public/js/mainTopic.js"></script>



<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
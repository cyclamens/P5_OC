<?php $title = 'Ma météo'; ?>
<?php ob_start(); ?>

<div id="meteo">
	<div id="input">
		<h3>La météo de ma ville !</h3>
		<input type="text" name="inputValue" id="inputValue" placeholder="Tapez votre ville ">
		<input type="submit" name="button" value="Envoyer" id="button">
	
	</div>
	<div id="display">
		<i id="wi"></i><br>
		<p><span id="temp"></span><span id="celcius">°C(<span id="desc"></span>)</span></p>
	</div>
</div>

<script src="public/js/app.js"></script>
<script src="public/js/main.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
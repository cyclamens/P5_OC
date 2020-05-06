<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <!--lien avec fichier css -->
    <link rel="stylesheet" href="public/css/style.css" /> 
    <!--responsive meta tag-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="description" content="">
	<meta name="keywords" content="" />
	<!--Google font-->
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<!--Bootstrap css compilé-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<!--CDN jquery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!--Bootstrap js compilé-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <!--Fontawesome-->
	<script src="https://kit.fontawesome.com/8692d3a619.js" crossorigin="anonymous"></script>
       
</head>
        
<body>
<!--insertion du menu-->
<?php require("menu.php"); ?>
    <!--div contenant la grande section-->
    <div class="container-fluid">
        <?= $content ?>
    </div>
    <script type="text/javascript" src="public/js/app.js"></script>
<!-- le pieds de page -->     
<?php require('footer.php'); ?>
</body>
</html>

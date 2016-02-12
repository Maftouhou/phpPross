<?php 
//Importation 
require_once ('contact-function.php');

//Suppression si l'Id existe dans l'URL
if (isset($_GET['idDelete'])) {
	deleteContact($_GET['idDelete']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<p><a href="index.php">Ajouter</a></p>
        <?= getlistContact(); ?>
</body>
</html>
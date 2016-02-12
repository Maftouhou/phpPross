<?php require_once('form-function.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Me !</title>
</head>
<body>
<?= getMessage(); ?>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
    <p><input type="hidden" name="id" value="<?php echo $inputValues['id']['value'] ; ?>"></p>
    <p><label for="MyName">Nom</label>
        <input type="text" name="monNom" value="<?php echo $inputValues['monNom']['value'] ; ?>"></p>

    <p><label for="myLastname">Prenom</label>
        <input type="text" name="monPrenom"  value="<?php echo $inputValues['monPrenom']['value'] ; ?>"></p>

    <p><label for="myEmail">Adresse email </label>
        <input type="email" name="monEmail"  value="<?php echo $inputValues['monEmail']['value'] ; ?>"></p>

    <select name="pays" id="myContry">
        <option value=""></option>
        <option value="Fr" <?= selectedOption('pays', 'Fr') ?>>France</option>
        <option value="It" <?= selectedOption('pays', 'It') ?>>Italy</option>
        <option value="De" <?= selectedOption('pays', 'De') ?>>Allemagne</option>
        <option value="Uk" <?= selectedOption('pays', 'Uk') ?>>Angeletaire</option>
    </select>

    <p>
        <label for="">Aimez-vous le PHP</label>
        <input type="radio" name="question" value="y" <?= checkedOption('question', 'y') ?>>Oui
        <input type="radio" name="question" value="n" <?= checkedOption('question', 'n') ?>>Non
    </p>

    <p>
        <input type="checkbox" name="hobbies[]" value="video" <?= checkedHobbie('hobbies', 'video') ?>>video
        <input type="checkbox" name="hobbies[]" value="game" <?= checkedHobbie('hobbies', 'game') ?>>game
        <input type="checkbox" name="hobbies[]" value="music" <?= checkedHobbie('hobbies', 'music') ?>>music
    </p>

    <p>
        <input type="submit" name="submit" value="Envoyer"> 
    </p>

    <pre>
        <?php
        var_dump($inputValues)
        ?>
    </pre>
</form>
<?php 
    $tableau = array(
        'cle' => 'valeur',
        'cle' => 'valeur',
        'cle' => array(
                'cle' => 'valeur',
                'cle' => 'valeur',
                'cle' => array(
                        'cle' => 'valeur',
                        'cle' => 'valeur',
                        'cle' => 'valeur',),
                'cle' => 'valeur',
                'cle' => 'valeur',
                'cle' => 'valeur',),
        'cle' => 'valeur',
        'cle' => 'valeur',
        'cle' => 'valeur',
    );
    
?>
</body>
</html>
<?php

    //importation de la class
    require_once('process.php');

    $thisClass = new Process();

    $maVariable = 'Lorem ipsum dolor.';
    function maFonction(){
        global $maVariable;
        echo $maVariable;

        #Tableau Indicé
        $tableau = ['String', 12, false];
        echo $tableau[2];

        #Tableau Associatif
        $tableauAsso = [
            'key1' => 'valeur1',
            'key2' => 'valeur2',
            'key3' => 'valeur3',
        ];

        #Les boucles
        for ($i=0; $i <count($tableau) ; $i++) { 
            #echo '<h1>'.$tableau[$i].'</h1>';
        }

        foreach ($tableauAsso as $key => $value) {
            #echo '<p>'. $key .' a pour valeur '. $value ;
            echo '<p>'. $key .' a pour valeur '. $value . '</p>' ;
        }

        #les condition 
        $meteo = 'lune';

        if ($meteo === 'pluie') {
            # code...
            #echo "la meteo n'est pas bonne, il y a la ".$meteo. " tout la journé";
        }elseif($meteo === 'soleil'){
            #echo ' aujourd\'hui, le '.$meteo. ' nous sourie';
        }

        switch ($meteo) {
            case 'pluie':
            echo "la meteo n'est pas bonne, il y a la ".$meteo. " tout la journé";
                # code...
                break;           

            case 'soleil':
            echo ' aujourd\'hui, le '.$meteo. ' nous sourie';
                # code...
                break;
            
            default:
            echo 'On dirait qu\'il fait toujours nuit';
                # code...
                break;
        }
    }

    $variable1 = '';
    $variable2 = $_GET['var2'];
    $variable3 = $_GET['var2'];

    if (isset($_POST['name']) && $_POST['name'] !== Null ) {
        $postedInfo = $_POST['name'];
    
    }
    
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<p>
    <a href="index.php?var1=valeur1&var2=valeur2"> Transmission des variable</a>
</p>

<form action="#" method="POST">
    <label for="name">Nom</label>
    <input type="text" id="name" name="name" value="<?php echo $postedInfo ?>" required>
    <input type="submit" value="Envouer">
</form>
    <?php
        #maFonction();

    $thisClass -> setMaPropriete('Proprity has changed');
    // $thisClass -> nvllMethode();

    echo $thisClass ->getMaPropriete();

    if (isset($postedInfo) && $postedInfo !== Null ) {
        # code...
        echo '<p>' . $postedInfo;
    }


    ?>
</body>
</html>
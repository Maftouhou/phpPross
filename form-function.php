<?php

//Import contact function 
require_once ('contact-function.php');

//Valeur / erreur des champs
$inputValues = [
    'id' => [
        'value' => null
    ],
    'monNom' => [
        'value' => null,
        'erreur' => 'vous n\'avez pas saisis votre nom'
    ],
    'monPrenom' => [
        'value' => null,
        'erreur' => 'vous n\'avez pas saisis votre prenom'
    ],
    'monEmail' => [
        'value' => null,
        'erreur' => 'votre email est incorect'
    ],
    'pays' => [
        'value' => null,
        'erreur' => 'Veillez Selectionné un pays'
    ],
    'question' => [
        'value' => null,
        'erreur' => 'Veillez repondre à la question'
    ],
    'hobbies' => [
        'value' => [],
        'erreur' => 'Merci de choisir votre loisir'
    ]
];

$message = null;

//Initialisation 
function init(){
    fill();

    if (isset($_POST['submit'])) {
        check();
    }
}

function fill(){
    global $inputValues;
    
    //Si il n'y a pas d'id defini en URL
    if(!isset($_GET['id'])){
        if (isset($_POST['id'])){
            $inputValues['id']['value'] = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
        }
        
        if (isset($_POST['monNom'])) {
            $inputValues['monNom']['value'] = filter_var($_POST['monNom'], FILTER_SANITIZE_STRING);
        }

        if (isset($_POST['monPrenom'])) {
            $inputValues['monPrenom']['value'] = filter_var($_POST['monPrenom'], FILTER_SANITIZE_STRING);
        }

        if (isset($_POST['monEmail'])) {
            $inputValues['monEmail']['value'] = filter_var($_POST['monEmail'], FILTER_VALIDATE_EMAIL);
        }

        if (isset($_POST['pays'])) {
            $inputValues['pays']['value'] = filter_var($_POST['pays'], FILTER_SANITIZE_STRING);
        }

        if (isset($_POST['question'])) {
            $inputValues['question']['value'] = filter_var($_POST['question'], FILTER_SANITIZE_STRING);
        }

        if (isset($_POST['hobbies'])) {
            $inputValues['hobbies']['value'] = filter_var($_POST['hobbies'], FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
        }
    }else{
        $result = getOneContact($_GET['id']);
       // var_dump($result);
        $inputValues['id']['value'] = $result->ID;
        $inputValues['monNom']['value'] = $result->nom;
        $inputValues['monPrenom']['value'] = $result->prenom;
        $inputValues['monEmail']['value'] = $result->email;
        $inputValues['pays']['value'] = $result->pays;
        $inputValues['question']['value'] = $result->question;
        $inputValues['hobbies']['value'] = json_decode($result->hobbies);
    }
}

function check(){
    global $inputValues;
    global $message;

    $validationInputs = filter_input_array(INPUT_POST, [
            'monNom' => [
                'filter' => FILTER_SANITIZE_STRING,
            ],

            'monPrenom' => [
                'filter' => FILTER_SANITIZE_STRING,
            ],

            'monEmail' => [
                'filter' => FILTER_SANITIZE_STRING,
                'flags' => FILTER_VALIDATE_EMAIL,
            ],

            'pays' => [
                'filter' => FILTER_SANITIZE_STRING,
            ],

            'question' => [
                'filter' => FILTER_SANITIZE_STRING,
            ],

            'hobbies' => [
                'filter' => FILTER_SANITIZE_STRING,
                'flags' => FILTER_REQUIRE_ARRAY,
            ]
        ]);

    foreach ($validationInputs as $key => $value) {
        if (!$value) {
           $message .= '<p>'.$inputValues[$key]['erreur'].'</p>';
        }
    }

    if (empty($message)) {
    //  $message = 'Formulaire valide';
        if(empty($_POST['id'])){
            addContact();
        }else{
            updateContact();
        }
//        addContact();
    }
}

function getMessage(){
    global $message;
    return $message;
}

function selectedOption($field, $value){
    global $inputValues;
    if($value === $inputValues[$field]['value']){
        return 'selected';
    }
}

function checkedOption($field, $value){
    global $inputValues;
    if($value === $inputValues[$field]['value']){
        return 'checked';
    }
    
}

function checkedHobbie($field, $value){
    global $inputValues;
    if(in_array($value, $inputValues[$field]['value']) ){
        return 'checked';        
    }
}

// Lancelemnt de la funciton d'initialisation 
init();



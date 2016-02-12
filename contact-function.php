<?php
require_once ('form-function.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$connection = new PDO(
        'mysql:host=localhost; dbname=crud; charset=utf8', 
        'root', 
        '', 
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

function addContact(){
    global $inputValues;
    global $connection;
    
    $sql  = 'INSERT INTO crud.contact
             VALUES ( NULL, :nom, :prenom, :email, :pays, :question, :hobbies )';
    
    $query = $connection->prepare($sql);
    try{
        $query->execute([
            'nom' => $inputValues['monNom']['value'],
            'prenom' => $inputValues['monPrenom']['value'],
            'email' => $inputValues['monEmail']['value'],
            'pays' => $inputValues['pays']['value'],
            'question' => $inputValues['question']['value'],
            'hobbies' => json_encode($inputValues['hobbies']['value'])
        ]);
    } catch (PDOException $ex) {
        $code = [
            '23000' => 'duplication'
        ];
        $split = preg_split('/key/i', $ex->getMessage());
        //echo $code[$ex->getCode()];
        echo $split[1];
    }
}

function updateContact(){
    
}

//Lister les enregistrement 
function getAllcontact(){
    global $connection;
    $sql = 'SELECT contact.* FROM crud.contact';
    
    $query = $connection ->prepare($sql);
    
    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}

//Selectionner un seul contact pour la modifier
function getOneContact($id){
    global $connection;
    $sql = 'SELECT contact.* FROM crud.contact WHERE contact.id = :id';
    
    $query = $connection ->prepare($sql);
    
    try{
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}

function getlistContact(){
    $contact = getAllcontact();
    $html = '<table border ="1">';
    $html .= '<tr>';
    $html .= '<th>Nom</th>';
    $html .= '<th>Prénom</th>';
    $html .= '<th>email</th>';
    $html .= '<th>Pays</th>';
    $html .= '<th>Question</th>';
    $html .= '<th>Loisir</th>';
    $html .= '<th></th>';
    $html .= '<th></th>';
    $html .= '</tr>';
    
    foreach ($contact as $key => $values){
        $html .= '<tr>';
        $html .= '<td>'.$values->nom.'</td>';
        $html .= '<td>'.$values->prenom.'</td>';
        $html .= '<td>'.$values->email.'</td>';
        $html .= '<td>'.$values->pays.'</td>';
        $html .= '<td>'.$values->question.'</td>';
        $html .= '<td>'. implode(',', json_decode($values->hobbies)).'</td>';
        $html .= '<td><a href="index.php?id='.$values->ID.'">&cirmid; </a></td>';
        $html .= '<td><a href="admin.php?idDelete='.$values->ID.'">&xotime; </a></td>';
        $html .= '</tr>';
    }
    
    $html .= '<table>';
    return $html;
}

//Suppression 
function deleteContact($idDelete){
    global $connection;
    
    $sql = 'DELETE FROM crud.contact WHERE contact.id = :id';
    
    $query = $connection->prepare($sql);
    
    try{
        $query->execute([
            'id' => $idDelete
        ]);
        
        header('location: admin.php');
        
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
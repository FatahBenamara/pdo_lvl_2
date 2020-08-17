<?php
// 01 se connecter la BDD
$servername  = 'l*******t';
$username = '*******a';
$password = '*a***';
$dbname = 'pdo';

$dsn = "mysql:host=$servername;dbname=$dbname";

try {
    $conn = new PDO ($dsn, $username, $password);
    $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "connected";

}catch(PDOException $e){
echo "ERROR: ". $e->getMessage();
}

// 2-1 LIER LA CLASS CRUD 
include_once 'person.php';

// 2-2 lier la personne à la class personDB pour avoir acces aux ajustement de CRUD:    $person= new PersonDB();
// 2-3 lier la personne a la BDD pour se connecter
$person= new PersonDB($conn);

// 6-4 faire une fake insertion dans la base de donnée 
// 6-4-1 phpmyadmin>sql>faire insert> supprimer id> value:




















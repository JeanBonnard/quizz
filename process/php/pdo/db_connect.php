<?php
$dsn = 'mysql:dbname=mega-quizz;host=127.0.0.1';
$user = 'jean';
$password = 'root';

try {
    $bdd = new PDO($dsn, $user, $password);
    $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //echo 'connection bdd OK ';
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
?>
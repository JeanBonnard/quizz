<?php
require_once 'pdo/db_connect.php';


if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {

    $pseudo = $_POST['pseudo'];
    $pass = $_POST['pass'];

    try {
        $result = $bdd-> prepare('INSERT INTO users (pseudo,password)VALUES(?,?)');
        $result->execute(array($pseudo,$pass));

        echo 'tu as reussi';
        header( 'location: /mega-quizz/index.php?message=utilisateur ajouté');
    } catch (PDOException $err) {
        echo 'echec prepare exec' . $err->getMessage();
        //header( 'location : ajout-patient.php');
    }
}
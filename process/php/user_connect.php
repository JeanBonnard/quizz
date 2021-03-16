<?php
require_once 'pdo/db_connect.php';

if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])){
    $pseudo = $_POST['pseudo'];
    $pass = $_POST['pass'];

    try {
        $result = $bdd-> prepare('SELECT * FROM users WHERE pseudo = ?');
        $result->execute([$pseudo]);

        $user = $result->fetch(PDO::FETCH_ASSOC);

        $id = $user['id'];

        if ($pseudo===$user['pseudo'] && $pass===$user['password']){
            setcookie('cookieName',$user['pseudo']);

        }

        echo 'tu as reussi';
        header( 'location: /mega-quizz/index.php?id='.$id.'&user='.$user['pseudo']);
    } catch (PDOException $err) {
        echo 'echec prepare exec' . $err->getMessage();

    }

}
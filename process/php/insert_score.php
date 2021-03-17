<?php
require_once 'pdo/db_connect.php';


    try {
        $result = $bdd-> prepare('UPDATE users SET score = ? where id = ?');
        $result->execute(array($_GET['score'],$_GET['id']));

        $result1 = $bdd-> prepare('UPDATE users SET id_questions = ? where id = ?');
        $result1->execute(array('',$_GET['id']));

        echo 'tu as reussi';
        header( 'location: /mega-quizz/index.php?id='.$_GET['id'].'&user='.$_GET['user'].'&message=tu as obtenu'.$_GET['score'].'points');
    } catch (PDOException $err) {
        echo 'echec prepare exec' . $err->getMessage();

    }

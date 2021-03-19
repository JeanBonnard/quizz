<?php

require_once 'pdo/db_connect.php';

$result2 = $bdd-> prepare('UPDATE users SET id_questions = ? where id = ?');
$result2->execute(array('',$_GET['id']));
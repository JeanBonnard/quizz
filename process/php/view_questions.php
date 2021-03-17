<?php
try {

    require_once 'pdo/db_connect.php';

$result1 = $bdd->prepare ('SELECT COUNT(*) FROM questions');
$result1->execute();
$count = $result1->fetch(PDO::FETCH_ASSOC);
$random = rand(1,$count['COUNT(*)']);

$test = $bdd->prepare ('SELECT * FROM users WHERE id = ?');
$test->execute([$_GET['id']]);
$user = $test->fetch(PDO::FETCH_ASSOC);

if ($user['id_questions'] === ''){
    $update = $bdd->prepare ('UPDATE users SET id_questions = ? where id = ?');
    $update->execute([$random,$_GET['id']]);

}else{
    $exp = explode('/',$user['id_questions']);
if( count($exp) != 10 ){
    while (in_array($random, $exp)){
        $random = rand(1,$count['COUNT(*)']);
    }
    $new_result = $user['id_questions'] ."/". $random;
    $update1 = $bdd->prepare ('UPDATE users SET id_questions = ? where id = ?');
    $update1->execute([$new_result,$_GET['id']]);


}else{
    echo 'QUIZ TERMINE FELICITATION';

    $result2 = $bdd-> prepare('UPDATE users SET id_questions = ? where id = ?');
    $result2->execute(array('',$_GET['id']));
}

}

$result = $bdd->prepare('SELECT * FROM `questions` WHERE `id` = ? ');
$result->execute([$random]);

$question = $result->fetch(PDO::FETCH_ASSOC);

echo '
    <div class="row">
        <div class="container">
            <h2>' . $question['q_content'] . '<h2>
        </div>
    </div>
    <div class="row divorder">
        <div class="container red border" id="bd-resp-1">
            <a href="#!"><h3>' . $question['bd_response2'] . '</h3></a>
        </div>
    </div>
    <div class="row divorder">
        <div class="container red border" id="bd-resp-2">
            <a href="#!"><h3>' . $question['bd_response'] . '</h3></a>
        </div>
    </div>
    <div class="row divorder">
        <div class="container green border" id="gd-resp">
            <a href="#!"><h3>' . $question['gd_response'] . '</h3></a>
        </div>
    </div>

';

} catch (PDOException $err) {
echo 'echec prepare exec' . $err->getMessage();

}
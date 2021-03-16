<?php
require_once 'process/php/pdo/db_connect.php';
include 'view/header.php';
?>
<header>
    <h1 style="font-weight: bold; color: black" class="title">Méga-quizz 🤔</h1>
    <div class="row">
        <div class="container">
            <?php
                include 'view/sign_in.php'
            ?>
            <?php
                include 'view/login.php'
            ?>
        </div>
    </div>
    <div class="row">
        <a href="#" id="cercle-sign"><img src="assets/img/sign.png" class="image-sign"></a>
        <a href="#" id="cercle-log"><img src="assets/img/log.png" class="image-log"></a>
    </div>
    <div class="row">
        <div class="col-12 logo">
            <img src="assets/img/25844931.png" class="logo-home">
        </div>
    </div>
    <?php
    if (isset($_GET['id'])){
        echo "<h2>Salut</h2>".$_GET['user']."<br>";
        ?>
        <button class="btn btn-success" id="start">Commencer le quiz</button>
   <?php
    }
    ?>
</header>
    <input type="hidden" id="id" name="id" value="<?=$_GET['id']?>">
    <input type="hidden" id="user" name="user" value="<?=$_GET['user']?>">
    <div class="quest display" id="quest">
        <?php

        include 'process/php/view_questions.php';

        ?>


    </div>
    <button class="btn btn-success" id="next">Next-></button>
<?php
try {
    $result = $bdd->prepare('SELECT score FROM users WHERE id = ?');
    $result->execute([$_GET['id']]);

    $score_user = $result->fetch(PDO::FETCH_ASSOC);

    $score = $score_user['score'];

} catch (PDOException $err) {
    echo 'echec prepare exec' . $err->getMessage();
}
?>

<?php
echo "<label for='score'>score</label>
<input disabled id='score' value='".$score."'>"
?>

<?php
include 'view/footer.php';
?>
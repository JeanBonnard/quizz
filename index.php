<?php
require_once 'process/php/pdo/db_connect.php';
include 'view/header.php';
?>

<!--__________________________________HEADER_______________________________________________-->

<header>


    <div class="row" style="margin-top: 1vw;">
        <a href="#" id="cercle-sign"><img src="assets/img/sign.png" class="image-sign"></a>
        <a href="#" id="cercle-log"><img src="assets/img/log.png" class="image-log"></a>
        <a href="view/top5.php" id="cercle-cour"><img src="assets/img/cour.png" class="image-cour"></a>
        <?php
            if (isset($_GET['id'])) {
                echo "<h2 style='position: absolute; right: 1vw;'>Salut " . $_GET['user'] . "</h2><br>";
            }
        ?>
    </div>
    <div id="ligne"></div>
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
    <h1 style="font-weight: bold; color: black" class="title">Méga-quizz 🤔</h1>
    <div class="row">
        <div class="col-12 logo">
            <img src="assets/img/25844931.png" class="logo-home">
        </div>
    </div>
    <?php
    if (isset($_GET['id'])){

        ?>
        <button class="btn btn-success" id="start">Commencer le quiz</button>
   <?php
    }
    ?>
</header>

<!-----------------------------------CONTENT----------------------------------------->


    <h1 id="countdown"></h1>
    <input type="hidden" id="id" name="id" value="<?=$_GET['id']?>">
    <input type="hidden" id="user" name="user" value="<?=$_GET['user']?>">
    <div class="quest display" id="quest">
        <?php

        include 'process/php/view_questions.php';

        ?>
    </div>

<!--________________________________GET SCORE______________________________________________-->

<?php

if (isset($_GET['id'])&& !empty($_GET['id'])){
    try {
        $result = $bdd->prepare('SELECT score FROM users WHERE id = ?');
        $result->execute([$_GET['id']]);

        $score_user = $result->fetch(PDO::FETCH_ASSOC);

        $score = $score_user['score'];



    } catch (PDOException $err) {
        echo 'echec prepare exec ' . $err->getMessage();
    }
}
?>
<!--__________________________________DISPLAY SCORE_________________________________________________-->
<?php
if (isset($_GET['id'])&& !empty($_GET['id'])) {
    echo "<div id='scoreDiv' class='display'>
            <label for='score'>score</label>
            <input disabled id='score' value='" . $score . "'>
            <button class='btn btn-success' id='next'>Next-></button>
          </div>";
    }
?>

<?php
include 'view/footer.php';
?>
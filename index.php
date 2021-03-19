<?php
require_once 'process/php/pdo/db_connect.php';
include 'view/header.php';
?>

<!--__________________________________HEADER_______________________________________________-->

<header>


    <div class="row" style="margin-top: 1vw;">
        <div class="col-2 d-flex">
        <div>
            <a href="#" id="cercle-sign"><img src="assets/img/sign.png" class="image-sign" title="sign in"></a>
            <p class="sous-titre">Sign-in</p>
        </div>
        <div>
            <a href="#" id="cercle-log"><img src="assets/img/log.png" class="image-log" title="log in"></a>
            <p class="sous-titre">Log-in</p>
        </div>
        <?php
            if (isset($_GET['id'])&& !empty($_GET['id'])){
                echo '<div>
                        <a href="view/top5.php" id="cercle-cour"><img src="assets/img/cour.png" class="image-cour" title="top 5"></a>
                        <p class="sous-titre">Top 5</p>
                      </div>';
                    }
                ?>
        </div>
        <div class="col-8"></div>
        <?php
            if (isset($_GET['id'])) {
                echo "<div class='col-2 d-flex'></div> <h2 style='position: absolute; right: 1vw; font-size: 2vw;'>Salut " . $_GET['user'] . "</h2></div><br>";
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
    <h1 style="font-weight: bold;" class="title"><span style="color:#5cbf45">Mega</span><span style="color: #fbc736">-</span><span style="color: #e02423">quizz</span> 🤔</h1>
    <div class="row">
        <?php
        if (isset($_GET['id'])&& !empty($_GET['id'])){
            echo '<div class="col-md-4 col-lg-2">
                    <button class="btn btn-success btn-block" id="start">Commencer le quiz</button>
                  </div>';
        }
        ?>

        <div class="col-sm-9 col-md-9 col-12 logo">
            <img src="assets/img/25844931.png" class="logo-home" >
        </div>
        <div class="col-sm-1 col-md-1 col-12 d-flex" style="justify-content: end">
            <img src="assets/img/idea.png" alt="" style="width: 8vw">
        </div>
    </div><br>
    <?php
    if (isset($_GET['id'])){

        ?>

   <?php
    }
    ?>
</header>

<!-----------------------------------CONTENT----------------------------------------->


    <h1 id="countdown"></h1>
    <input type="hidden" id="id" name="id" value="<?=$_GET['id']?>">
    <input type="hidden" id="user" name="user" value="<?=$_GET['user']?>">

        <div class="row">
            <div class="col-2">
                <img src="assets/img/tab.png" style="width: 10.5vw; position: absolute;" alt="">
            </div>
            <div class="quest display col-9" id="quest">
                <?php

                include 'process/php/view_questions.php';

                ?>
            </div>
            <div class="col-1"></div>
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
    echo "<div id='scoreDiv' class='display' style='display: flex;
justify-content: center;'>
            <label for='score'>score</label>
            <input disabled id='score' value='".$score."'>
            <button class='btn btn-success' id='next'>Next-></button>
          </div>";
    }
?>

<?php
include 'view/footer.php';
?>
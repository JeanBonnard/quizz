<?php
    require_once '../process/php/pdo/db_connect.php';
    include 'header.php';
?>
<div class="row">
<div class="col-5">
    <div id="uv-div"></div>
</div>
<?php

try {
    $result = $bdd->prepare('SELECT score as value,pseudo as name FROM users order by `value` desc limit 5');
    $result->execute();

    $best_players = $result->fetchAll();

} catch (PDOException $err) {
    echo 'echec prepare exec ' . $err->getMessage();
}

?>
<div class="col-7">
    <img class="school" src="../assets/img/school.png">
    <img class="school" src="../assets/img/school2.png" alt="">
</div>
</div>
<?php
    include 'footer.php';
?>
<script type="text/javascript">

    let graphdef = {
        categories : ['Questionnaire Dèv'],
        dataset : {
            'Questionnaire Dèv' : <?=json_encode($best_players)?>
        }
    }
    let chart = uv.chart ('Bar', graphdef, {
        meta : {
            caption : '👑 [TOP 5] Players',
            //subcaption : 'among Imaginea OS products',
            hlabel : 'Nombre de points',
            vlabel : 'Meilleurs joueurs',
            //vsublabel : 'in thousands'
        }
    })

</script>

<?php
    require_once '../process/php/pdo/db_connect.php';
    include 'header.php';
?>

<div id="uv-div"></div>

<?php

try {
    $result = $bdd->prepare('SELECT score as value,pseudo as name FROM users order by `value` desc limit 5');
    $result->execute();

    $best_players = $result->fetchAll();


} catch (PDOException $err) {
    echo 'echec prepare exec ' . $err->getMessage();
}

?>


<?php
    include 'footer.php';
?>
<script type="text/javascript">

    let graphdef = {
        categories : ['uvCharts'],
        dataset : {
            'uvCharts' : <?=json_encode($best_players)?>
        }
    }
    let chart = uv.chart ('Bar', graphdef, {
        meta : {
            caption : '[TOP 5] Players',
            //subcaption : 'among Imaginea OS products',
            hlabel : 'Nombre de points',
            vlabel : 'Meilleurs joueurs',
            //vsublabel : 'in thousands'
        }
    })

</script>

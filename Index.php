<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link href="style.css" rel="stylesheet">
    <script src="toast.js"></script>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="form.php">Formulaire</a></li>  
            </ul>
        </nav>
    </header>    
<?php
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=ampoule', 'root');
        } catch (PDOException $e) {
            print "Erreur: " . $e->getMessage() . "<br/>";
            die();
            }

    $page = $_GET['page'];       
    $lineperpage = 5;
    $numberlinereq = $bdd->query("SELECT `id` FROM `ampoule`");
    $numberline = $numberlinereq->rowCount();
    $totalpage = ceil($numberline/$lineperpage);

    if(isset($page) && !empty($page) && $page > 0 && $page <= $totalpage){
        $page = intval($page);
        $currentpage = $page;
    } else {
        $currentpage = 1;
    }

    $start = ($currentpage-1)*$lineperpage;
?>
<div class="history">
    <h1>Historique : </h1>
        <ul>
            <?php
                $req=$bdd->query('SELECT * FROM ampoule ORDER BY `date_changement` LIMIT '.$start.','.$lineperpage);
                foreach($req as $ampoule) :
            ?>
            <li>
             <?= $ampoule['date_changement'];?> | <?= $ampoule['etage'];?> |  <?= $ampoule['position'];?> | <?= $ampoule['prix'] . '€';?> | 
             <a href="http://projet:8080/projet_ampoule/form.php?id_ampoule=<?= $ampoule['id'] ?>">Modifier</a> | 
             <a onclick= "return confirm('Voulez vous vraiment supprimer cette ligne?')" href="http://projet:8080/projet_ampoule/index.php?idampoule=<?= $ampoule['id'] ?>" >Supprimer</a>
            </li>
            <?php endforeach; ?>
        </ul> 
</div>
<div class="page">        
    <?php
        for($i=1;$i<=$totalpage;$i++){
             echo '<a href="http://projet:8080/projet_ampoule/index.php?page='.$i.'">'.$i.' </a> ';
        }
    ?>     
</div>
<div id="toast">La ligne a bien été supprimé.</div>
</body>
</html>
<?php
if(isset($_GET['idampoule'])){
    $req=$bdd->prepare("DELETE FROM `ampoule` WHERE id = :id_amp");
    $req->bindValue(':id_amp', $_GET['idampoule'], PDO::PARAM_INT);
    $req->execute();
    $req = toast();
}    
?>
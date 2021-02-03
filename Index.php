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

    $Elementsparpage = 5;
    $nombreelementreq = $bdd->query("SELECT `id` FROM `ampoule`");
    $nombreelement = $nombreelementreq->rowCount();
    $pagestotales = ceil($nombreelement/$Elementsparpage);

    if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $pagestotales){
        $_GET['page'] = intval($_GET['page']);
        $pagecourante = $_GET['page'];
    } else {
        $pagecourante = 1;
    }

    $depart = ($pagecourante-1)*$Elementsparpage;
?>
<div class="history">
    <h1>Historique : </h1>
        <ul>
            <?php
                $req=$bdd->query('SELECT * FROM ampoule ORDER BY `date_changement` LIMIT '.$depart.','.$Elementsparpage);
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
        for($i=1;$i<=$pagestotales;$i++){
             echo '<a href="http://projet:8080/projet_ampoule/index.php?page='.$i.'">'.$i.' </a> ';
        }
    ?>     
</div>
<div class="toast">La ligne a bien été supprimé.</div>
</body>
</html>
<?php
if(isset($_GET['idampoule'])){
    $req=$bdd->prepare("DELETE FROM `ampoule` WHERE id = :id_amp");
    $req->bindValue(':id_amp', $_GET['idampoule'], PDO::PARAM_INT);
    $req->execute();
    //echo toast('show');
}    
?>
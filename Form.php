<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link href="style.css" rel="stylesheet">
</head>
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=ampoule', 'root');
    } catch (PDOException $e) {
    print "Erreur: " . $e->getMessage() . "<br/>";
    die();
    }

//Logout        
session_start();        
if(isset($_GET['deconnexion'])){ 
    if($_GET['deconnexion']==true){  
        session_destroy();
        header("location:Index.php");
    }
}        

if(isset($_GET["submit"])){
    $date = ($_GET["date"]);
    $floor = ($_GET["floor"]);
    $position = ($_GET["position"]);
    $price = ($_GET["price"]);

        if($_GET['id_ampoule']){
            $update=$bdd->prepare("UPDATE `ampoule` SET `date_changement`=:date,`etage`=:floor,`position`=:position,`prix`=:price WHERE id = :id_amp");
            $update->bindParam(':id_amp', $_GET['id_ampoule'], PDO::PARAM_INT);
            $update->bindParam(':date',$date);
            $update->bindParam(':floor',$floor);
            $update->bindParam(':position',$position);
            $update->bindParam(':price',$price);
            $update->execute();
            header('Location: History.php');
            } else {
              $insertion = $bdd->prepare ("INSERT INTO `ampoule`(`date_changement`, `etage`, `position`, `prix`) VALUES (:date,:floor, :position, :price)");
              $insertion->bindParam(':date',$date);
              $insertion->bindParam(':floor',$floor);
              $insertion->bindParam(':position',$position);
              $insertion->bindParam(':price',$price);
              $insertion->execute();  
            }
}

$req=$bdd->prepare("SELECT * FROM `ampoule` WHERE id = :id_amp");
$req->bindParam(':id_amp', $_GET['id_ampoule'], PDO::PARAM_INT);
$req->execute();
$ampoule = $req->fetch(); 
?>

<body>
<header>
    <nav>
        <ul>
            <li><a href="History.php">Accueil</a></li>
            <li><a href="Form.php">Formulaire</a></li>
            <li><a href='Index.php?deconnexion=true'>Déconnexion</a></li>      
        </ul>
    </nav>
</header>
<form method="get">
    <div>
        <input type="hidden" name="id_ampoule" value="<?= $ampoule['id'] ?? '';?>">
    </div>
    <div>
        <label for="date">Date de changement de l'ampoule :</label>
        <input type="date" id="date" name="date" value="<?= $ampoule['date_changement'] ?? '';?>">
    </div>
    <div>
        <label for="floor">Etage :</label>
        <select name="floor" id="floor">
            <option value=""></option>
            <option value="rez-de-chaussee" <?= ($ampoule['etage'] == "rez-de-chaussee")? "selected" : "" ?>>rez-de-chaussée</option>
            <option value="etage 1"<?= ($ampoule['etage'] == "etage 1")? "selected" : "" ?>>étage 1</option>
            <option value="etage 2"<?= ($ampoule['etage'] == "etage 2")? "selected" : "" ?>> étage 2 </option>
            <option value="etage 3"<?= ($ampoule['etage'] == "etage 3")? "selected" : "" ?>>étage 3</option>
            <option value="etage 4"<?= ($ampoule['etage'] == "etage 4")? "selected" : "" ?>>étage 4</option>
            <option value="etage 5"<?= ($ampoule['etage'] == "etage 5")? "selected" : "" ?> >étage 5</option>
            <option value="etage 6"<?= ($ampoule['etage'] == "etage 6")? "selected" : "" ?> >étage 6</option>
            <option value="etage 7"<?= ($ampoule['etage'] == "etage 7")? "selected" : "" ?> >étage 7</option>
            <option value="etage 8"<?= ($ampoule['etage'] == "etage 8")? "selected" : "" ?> >étage 8</option>
            <option value="etage 9"<?= ($ampoule['etage'] == "etage 9")? "selected" : "" ?> >étage 9</option>
            <option value="etage 10"<?= ($ampoule['etage'] == "etage 10")? "selected" : "" ?> >étage 10</option>
            <option value="etage 11"<?= ($ampoule['etage'] == "etage 11")? "selected" : "" ?> >étage 11</option>
        </select>
    </div>
    <div>
        <label for="position">Position :</label>
        <select name="position" id="position" value="<?= $ampoule['position'];?>">
            <option value=""></option>
            <option value="gauche"<?= ($ampoule['position'] == "gauche")? "selected" : "" ?> >côté gauche</option>
            <option value="droit"<?= ($ampoule['position'] == "droit")? "selected" : "" ?> >côté droit</option>
            <option value="fond"<?= ($ampoule['position'] == "fond")? "selected" : "" ?> >fond</option>
        </select>
    </div>
    <div>
        <label for="price">Prix de l'ampoule :</label>
        <input type="number" id="price" name="price" step="0.01" required  value="<?= $ampoule['prix'] ?? '';?>"> 
    </div>
        <input type="submit" value="Valider" name="submit">
</form>
</body>
</html>

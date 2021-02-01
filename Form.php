<!DOCTYPE html> .
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link href="style.css" rel="stylesheet">
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
<form method="get">
    <div>
        <label for="date">Date de changement de l'ampoule :</label>
        <input type="date" id="date" name="date">
    </div>
    <div>
        <label for="floor">Etage :</label>
        <select name="floor" id="floor">
            <option value=""></option>
            <option value="rez-de-chaussee" <?php echo $rdc; ?>>rez-de-chaussée</option>
            <option value="etage 1" <?php echo $etage1; ?>>étage 1</option>
            <option value="etage 2" <?php echo $etage2; ?>>étage 2</option>
            <option value="etage 3" <?php echo $etage3; ?>>étage 3</option>
            <option value="etage 4" <?php echo $etage4; ?>>étage 4</option>
            <option value="etage 5"<?php echo $etage5; ?>>étage 5</option>
            <option value="etage 6"<?php echo $etage6; ?>>étage 6</option>
            <option value="etage 7"<?php echo $etage7; ?>>étage 7</option>
            <option value="etage 8"<?php echo $etage8; ?>>étage 8</option>
            <option value="etage 9"<?php echo $etage9; ?>>étage 9</option>
            <option value="etage 10"<?php echo $etage10; ?>>étage 10</option>
            <option value="etage 11"<?php echo $etage11; ?>>étage 11</option>
        </select>
    </div>
    <div>
        <label for="position">Position :</label>
        <select name="position" id="position">
            <option value=""></option>
            <option value="gauche"<?php echo $gauche; ?>>côté gauche</option>
            <option value="droit"<?php echo $droit; ?>>côté droit</option>
            <option value="fond"<?php echo $fond; ?>>fond</option>
        </select>
    </div>
    <div>
        <label for="price">Prix de l'ampoule :</label>
        <input type="number" id="price" name="price" step="0.01" required>
    </div>
        <input type="submit" value="Valider" name="submit">
</form>
</body>
</html>
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=ampoule', 'root');
    } catch (PDOException $e) {
    print "Erreur: " . $e->getMessage() . "<br/>";
    die();
    }

if(isset($_GET["submit"])){
    $date = ($_GET["date"]);
    $floor = ($_GET["floor"]);
    $position = ($_GET["position"]);
    $price = ($_GET["price"]);
   
    $insertion = $bdd->prepare ("INSERT INTO `ampoule`(`date_changement`, `etage`, `position`, `prix`) VALUES (:date,:floor, :position, :price)");
    $insertion->bindParam(':date',$date);
    $insertion->bindParam(':floor',$floor);
    $insertion->bindParam(':position',$position);
    $insertion->bindParam(':price',$price);
    $insertion->execute();
} 

$req=$bdd->prepare("SELECT * FROM `ampoule` WHERE id = :id_ampoule");
$req->bindValue(':id_ampoule', $_GET['id_ampoule'], PDO::PARAM_INT);
?>
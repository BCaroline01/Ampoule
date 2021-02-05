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
<body>
<h1>Connexion</h1>
<form class="login" method="POST">
    <input type="text" placeholder="Nom d'utilisateur" name="username" required>
    <input type="password" placeholder="Mot de passe" name="password" required>
    <input type="submit" name="register" value="LOGIN" >
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=ampoule', 'root');
    } catch (PDOException $e) {
    print "Erreur: " . $e->getMessage() . "<br/>";
    die();
    }

    function valid_data($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    
    if (isset($_POST['register']) && !empty ($_POST['username']) && !empty ($_POST['password'])){
        $username = valid_data($_POST['username']);
        $password = valid_data($_POST['password']);  
        if($username == "Concierge" && $password == "Ampoule"){
            session_start();
            header('Location: History.php');
        }else{
           echo '<p>Utilisateur ou mot de passe incorrect</p>';
            }
    }
?>
</form>
</body>
</html>


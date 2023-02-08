<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APPLICATION PHP BDD - CONSULTATION</title>
</head>

<body>

    <h1> Bienvenue sur votre page d'accès ToDoList </h1>

    <?php

    try {
        $ipserver = "192.168.64.86";
        $nomBase = "ToDoList";
        $loginPrivilege = "Utilisateur";
        $passPrivilege = "todolist1234";

        $GLOBALS["pdo"] = new PDO('mysql:host=' . $ipserver . ';dbname=' . $nomBase . '', $loginPrivilege, $passPrivilege);
    } catch (Exception $error) {
        echo "error est : " . $error->getMessage();
    }


    if (isset($_POST["connexion"])) {
        $requete = "SELECT * FROM `Utilisateurs` WHERE Utilisateurs.login = '" . $_POST["username"] . "' AND Utilisateurs.mdp='" . $_POST["password"] . "';";
        $resultat = $GLOBALS["pdo"]->query($requete);
        if ($resultat->rowCount() > 0) {
           
            $_SESSION["toto"] = "titi";
        }
    }

    
    if (isset($_SESSION["toto"]) && $_SESSION["toto"]=="titi") {
        echo "vous etes connexté";

    } else {


    ?>


        <form action="" method="post">
            <label for="username">Entrez votre nom d'utilisateur :</label>
            <input type="text" id="username" name="username">

            <label for="password">Entrez votre mot de passe :</label>
            <input type="password" id="password" name="password">

            <input type="submit" value="Submit" name="connexion">
        </form>

    <?php } ?>

</body>

</html>
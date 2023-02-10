<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APPLICATION PHP BDD - TODOLIST</title>
    <link rel="stylesheet" href="connexion.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</head>
<body>

    <h1> Bienvenue sur votre page d'accès ToDoList </h1>

    <?php

    function afficher_formulaire() // Affichage du formulaire
    {
    ?>
        <form action="" method="post">
            <label for="username">Entrez votre nom d'utilisateur :</label>
            <input type="text" id="username" name="username">
            </br>
            </br>
            <label for="password">Entrez votre mot de passe :</label>
            <input type="password" id="password" name="password">

            <input type="submit" value="Submit" name="connexion">
        </form>
    <?php
    }

    try { // Connexion à la base de donnée 
        $ipserver = "192.168.64.86";
        $nomBase = "ToDoList";
        $loginPrivilege = "root";
        $passPrivilege = "root";

        $GLOBALS["pdo"] = new PDO('mysql:host=' . $ipserver . ';dbname=' . $nomBase . '', $loginPrivilege, $passPrivilege);
    } catch (Exception $error) {
        echo "error est : " . $error->getMessage();
    }


    if (isset($_POST["connexion"])) // Vérification des login pour un compte après avoir appuyé sur le bouton "Connexion"
    {
        $requete = "SELECT * FROM `Utilisateurs` WHERE Utilisateurs.login = '" . $_POST["username"] . "' AND Utilisateurs.mdp='" . $_POST["password"] . "';";
        $resultat = $GLOBALS["pdo"]->query($requete);
        if ($resultat->rowCount() > 0) {

            $_SESSION["trueconnect"] = "true";
        }
    }


    if (isset($_SESSION["trueconnect"]) && $_SESSION["trueconnect"] == "true") 
    {
        echo "vous etes connecté";
        ?>


    <div class="container">
      <form>
        <input type="text" placeholder="Login">
        <input type="password" placeholder="Mot de passe">
        <button type="submit">S'inscrire</button>
      </form>
    </div>
    <video class="background-video" autoplay muted loop>
      <source src="video.mp4" type="video/mp4">
    </video>




<?php
    } 
    else 
    {
        afficher_formulaire();
    }


?>


</body>
</html>
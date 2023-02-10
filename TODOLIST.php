<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width>, initial-scale=1.0">
    <title>APP TODOLIST</title>
    <link rel="stylesheet" href="style_signin.css">
    <link rel="stylesheet" href="style_todomain.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font_awesome/6.1.1/css/all.min.css">

</head>

<body>

<?php

function afficher_formulaire() // Affichage du formulaire
{
    ?>
<form action="" method="post">
    <div class="box">
        <div class ="form">
            <h2>Votre ToDoList</h2>
            <div class="inputBox">
                <label for="username"><span>Login</span></label>
                <input type="text" name="username" required="required">
                <i></i>
            </div>
            <div class="inputBox">
                <label for="password"><span>Mot de Passe</span></label>    
                <input type="password" name="password" required="required">
                <i></i>
            </div>
            <div class="links">
                <a href="#">S'inscrire</a>
            </div>
            <input type="submit" value="Submit" name="connexion">
        </div>
    </div>
</form>
<?php
}

try { // Connexion à la base de donnée 
    $ipserver = "192.168.1.57";
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
  ?>
 
<div class="header">
    <p class="header_titre">Ma super Todo List ! </p>
</div>
 

<form class="taches_input" method="post" action="">
 
 
    <input id="inserer" type="text" name="creer_tache"/>
    <button id="envoyer">Créer</button>
</form>
<?php
if (isset($erreurs)) {
    ?>
    <p><?php echo $erreurs ?></p>
    <?php
}
?>
 
 
<table class="taches">
    <tr>
        <th>
            N
        </th>
        <th>
            Nom
        </th>
        <th>
            Action
        </th>
    </tr>
    <?php
    $reponse = "SELECT * FROM Taches"; // On exécute une requête visant à récupérer les tâches
    while ($taches = $reponse->fetch()) { // On initialise une boucle
        ?>
        <tr>
            <td><?php echo $taches['id'] ?></td>
            <td><?php echo $taches['nom'] ?></td>
            <td><a class="suppr" href="index.php?supprimer_tache=<?php echo $taches['id'] ?>"> X</a></td>
        </tr>
        <?php
    }
 
 
    ?>
 
 
</table>
<?php
}


else 
{
    afficher_formulaire();
}


?>

</body>
</html>


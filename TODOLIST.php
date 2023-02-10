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
    <!--<link rel="stylesheet" href="style_todomain.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font_awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="ToDolist.css">
</head>

<body>

    <?php

    function afficher_formulaire() // Affichage du formulaire
    {
    ?>
        <form action="" method="post">
        <div class="box">
                <div class="form">
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
                        <a href="#">S'inscrire (à venir, bêta privée)</a>
                    </div>
                    <input type="submit" value="ENTER" name="connexion">
                </div>
            </div>
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
        $requetelogin = "SELECT * FROM `Utilisateurs` WHERE Utilisateurs.login = '" . $_POST["username"] . "' AND Utilisateurs.mdp='" . $_POST["password"] . "';";
        //echo $requete;
        $resultatlogin = $GLOBALS["pdo"]->query($requetelogin);
        if ($resultatlogin->rowCount() > 0) {

            $tab = $resultatlogin->fetch();
            $_SESSION["idUser"] = $tab["id"];
            $_SESSION["trueconnect"] = true;
        }
    }


    if (isset($_SESSION["trueconnect"]) && $_SESSION["trueconnect"] == true) 
    {
    ?>
            <div class="header">
                <p class="header_titre">Bienvenue Lama</p>
            </div>
        <div id="myDIV" class="header">
            <h2>La ToDo List du Bled</h2>
            <form class="taches_input" method="post" action="">
                <label for="addtache"></label>
                <input id="myInput" id="inserer" type="text" name="tache" />
                <input type="submit" name="envoyer_tache" class="addBtn"></button>
                <button type="submit" name="deconnexion" class="deco" >Déconnexion</button>
            </form>
        </div>   
        </div>
        
        <?php

        if (isset($_POST["envoyer_tache"])) // Si l'utilisateur a appuyé sur le bouton "Ajouter une tâche"
        {
            if (isset($_SESSION["idUser"])) {
                $requeteaddtache = "INSERT INTO `Tache` ( `idUtilisateur`, `nom`) VALUES ( '" . $_SESSION["idUser"] . "', '" . $_POST["tache"] . "');";
                //echo $addtache;*
                $GLOBALS["pdo"]->query($requeteaddtache);
                echo "Nouvelle tâche insérée" . $GLOBALS["pdo"]->lastInsertId() . " .";
            } else {
                echo "Vous n'êtes pas identifié...";
            }
        }

        if (isset($erreurs)) {
        ?>
            <p><?php echo $erreurs ?></p>
        <?php
        }
        ?>

        <ul id="myUL">
            <?php
            $reponse = "SELECT * FROM Tache WHERE idUtilisateur = '" . $_SESSION["idUser"] . "'"; // On exécute une requête visant à récupérer les tâches
            $reponse = $GLOBALS["pdo"]->query($reponse);
            while ($tache = $reponse->fetch()) { // On initialise une boucle
            ?>
                <li>
                    <?php echo $tache['id'] ?>
                    <?php echo $tache['nom'] ?>

                    <form class="taches_supr" method="post" action="">
                    <a class="suppr" name="supprimer_tache" href="TODOLIST.php?supprimer_tache=<?php echo $tache['id'] ?>"> X</a>
                    </form>
                </li>
            <?php
            }

            if (isset($_POST["supprimer_tache"]))
            {
                if (isset($_SESSION["idUser"]))
                {
                    $requetesuppr = "DELETE FROM Tache WHERE tache.nom = '".$_POST["supprimer_tache"]."'";
                    echo $requetesuppr;
                    
                }
            }

            if(isset($_POST['deconnexion'])) // SESSION DESTROY pour la Deconnexion
            {
        session_destroy();
        header('Location: TODOLIST.php');
    }
            ?>
        </ul>
    <?php
    
    } else {
        afficher_formulaire();
    }
    ?>

</body>
</html>
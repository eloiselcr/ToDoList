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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

</head>
<style>
      body{
  display: flex;
  justify-content:center;
  flex-direction: columns;
  align-items: center;
  background-color: #f5f5f5;
  font-family: 'Roboto', sans-serif;
}
form {
  margin-top: 20px;
  background-color: #fff;
  padding: 40px 60px;
  border-radius: 10px;
  min-width: 300px;
}
form h1{
  color: #eb7371;
  text-align:center;
}
form .social-media{
  margin-top: -10px;
  display: flex;
  flex-wrap:wrap;
  justify-content:center;
}
form .social-media p{
  padding: 5px;
  width: 20px;
  margin-left: 10px;
  border-radius: 100%;
  border: 1px solid #545454;
  text-align: center;
  cursor:pointer;
  color: #545454;
}
form p.choose-email{
  text-align:center;
}
form .inputs {
  display: flex;
  flex-direction: column;
}
form .inputs input[type='text'], input[type='password']{
  padding: 15px;
  border:none;
  border-radius: 5px;
  background-color:#f2f2f2;
  outline:none;
  margin-bottom: 15px;
}
form p.inscription{
  font-size: 14px;
  margin-bottom: 20px;
  color: #878787;
}
form p.inscription span{
  color: #eb7371;
}
form button{
  padding: 15px 25px;
  border-radius: 5px;
  border:none;
  font-size: 15px;
  color: #fff;
  background-color: #eb7371;
  outline:none;
  cursor:pointer;
}
</style>

<body>


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
    if(isset($_POST['deconnexion'])) // SESSION DESTROY pour la Deconnexion
    {
        session_destroy();
        header('Location: connexion_victor.php');
    }

    
    if (isset($_SESSION["toto"]) && $_SESSION["toto"]=="titi") {
        echo 'vous etes connexté
        <form method="post">
        <input type="submit" value="deconnexion" name="deconnexion">
        </form>';
        
    } else {


    ?>


<form method="post" >     
        <h1>Se connecter</h1>
        <div class="social-media">
          <p><i class="fab fa-google"></i></p>
          <p><i class="fab fa-youtube"></i></p>
          <p><i class="fab fa-facebook-f"></i></p>
          <p><i class="fab fa-twitter"></i></p>
        </div>
        <p class="choose-email">ou utiliser mon adresse e-mail :</p>
        
        <div class="inputs">
          <input type="text" id="username" name="username" placeholder="Uset">
          <input type="password" id="password" name="password" placeholder="mdp">
        </div>
        
        <p class="inscription">Je n'ai pas de <span>compte</span>. Je m'en <a href="">créer</a><span>
                        
                 
          <script>
            document.getElementById("show-form").addEventListener("click", function() {
              document.getElementById("form-container").style.display = "block";
            });
          </script></span> un.</p>
        <div align="center">
          <button type="submit" name="connexion" >Se connecter</button>
        </div>
      </form>


    <?php } ?>

</body>

</html>
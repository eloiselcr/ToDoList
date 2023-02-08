<?php
start_session();
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
    $nomBase = "ToDolist";
    $loginPrivilege = "root";
    $passPrivilege = "root";

    $GLOBALS["pdo"] = new PDO ('mysql:host=' . $ipserver . ';dbname=' . $nomBase . '', $loginPrivilege, $passPrivilege);    
    }

    ?>


    <form action="connexion.php" method="post">
            <label for="username">Entrez votre nom d'utilisateur :</label>
            <input type="text" id="username" name="username">

            <label for="password">Entrez votre mot de passe :</label>
            <input type="password" id="password" name="password">

            <input type="submit" value="Submit">
    </form>


</body>

</html>





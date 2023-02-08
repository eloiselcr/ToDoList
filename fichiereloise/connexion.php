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
        $loginPrivilege = "Utilisateur";
        $passPrivilege = "todolist1234";

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


<section class="vh-100 gradient-custom-2">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-12 col-xl-10">

        <div class="card mask-custom">
          <div class="card-body p-4 text-white">

            <div class="text-center pt-3 pb-2">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-todo-list/check1.webp"
                alt="Check" width="60">
              <h2 class="my-4">Task List</h2>
            </div>

            <table class="table text-white mb-0">
              <thead>
                <tr>
                  <th scope="col">Team Member</th>
                  <th scope="col">Task</th>
                  <th scope="col">Priority</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr class="fw-normal">
                  <th>
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                      alt="avatar 1" style="width: 45px; height: auto;">
                    <span class="ms-2">Alice Mayer</span>
                  </th>
                  <td class="align-middle">
                    <span>Call Sam For payments</span>
                  </td>
                  <td class="align-middle">
                    <h6 class="mb-0"><span class="badge bg-danger">High priority</span></h6>
                  </td>
                  <td class="align-middle">
                    <a href="#!" data-mdb-toggle="tooltip" title="Done"><i
                        class="fas fa-check fa-lg text-success me-3"></i></a>
                    <a href="#!" data-mdb-toggle="tooltip" title="Remove"><i
                        class="fas fa-trash-alt fa-lg text-warning"></i></a>
                  </td>
                </tr>
                <tr class="fw-normal">
                  <th>
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp"
                      alt="avatar 1" style="width: 45px; height: auto;">
                    <span class="ms-2">Kate Moss</span>
                  </th>
                  <td class="align-middle">Make payment to Bluedart</td>
                  <td class="align-middle">
                    <h6 class="mb-0"><span class="badge bg-success">Low priority</span></h6>
                  </td>
                  <td class="align-middle">
                    <a href="#!" data-mdb-toggle="tooltip" title="Done"><i
                        class="fas fa-check fa-lg text-success me-3"></i></a>
                    <a href="#!" data-mdb-toggle="tooltip" title="Remove"><i
                        class="fas fa-trash-alt fa-lg text-warning"></i></a>
                  </td>
                </tr>
                <tr class="fw-normal">
                  <th>
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3-bg.webp"
                      alt="avatar 1" style="width: 45px; height: auto;">
                    <span class="ms-2">Danny McChain</span>
                  </th>
                  <td class="align-middle">Office rent</td>
                  <td class="align-middle">
                    <h6 class="mb-0"><span class="badge bg-warning">Middle priority</span></h6>
                  </td>
                  <td class="align-middle">
                    <a href="#!" data-mdb-toggle="tooltip" title="Done"><i
                        class="fas fa-check fa-lg text-success me-3"></i></a>
                    <a href="#!" data-mdb-toggle="tooltip" title="Remove"><i
                        class="fas fa-trash-alt fa-lg text-warning"></i></a>
                  </td>
                </tr>
                <tr class="fw-normal">
                  <th>
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp"
                      alt="avatar 1" style="width: 45px; height: auto;">
                    <span class="ms-2">Alexa Chung</span>
                  </th>
                  <td class="align-middle">Office grocery shopping</td>
                  <td class="align-middle">
                    <h6 class="mb-0"><span class="badge bg-danger">High priority</span></h6>
                  </td>
                  <td class="align-middle">
                    <a href="#!" data-mdb-toggle="tooltip" title="Done"><i
                        class="fas fa-check fa-lg text-success me-3"></i></a>
                    <a href="#!" data-mdb-toggle="tooltip" title="Remove"><i
                        class="fas fa-trash-alt fa-lg text-warning"></i></a>
                  </td>
                </tr>
                <tr class="fw-normal">
                  <th class="border-0">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                      alt="avatar 1" style="width: 45px; height: auto;">
                    <span class="ms-2">Ben Smith</span>
                  </th>
                  <td class="border-0 align-middle">Ask for Lunch to Clients</td>
                  <td class="border-0 align-middle">
                    <h6 class="mb-0"><span class="badge bg-success">Low priority</span></h6>
                  </td>
                  <td class="border-0 align-middle">
                    <a href="#!" data-mdb-toggle="tooltip" title="Done"><i
                        class="fas fa-check fa-lg text-success me-3"></i></a>
                    <a href="#!" data-mdb-toggle="tooltip" title="Remove"><i
                        class="fas fa-trash-alt fa-lg text-warning"></i></a>
                  </td>
                </tr>
              </tbody>
            </table>


          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<?php
    } 
    else 
    {
        afficher_formulaire();
    }


?>


</body>
</html>
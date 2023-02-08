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


<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css /> -->
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-sm-3 col-xs-12">
                            <h4 class="title">Data <span>List</span></h4>
                        </div>
                        <div class="col-sm-9 col-xs-12 text-right">
                            <div class="btn_group">
                                <input type="text" class="form-control" placeholder="Search">
                                <button class="btn btn-default" title="Reload"><i class="fa fa-sync-alt"></i></button>
                                <button class="btn btn-default" title="Pdf"><i class="fa fa-file-pdf"></i></button>
                                <button class="btn btn-default" title="Excel"><i class="fas fa-file-excel"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Age</th>
                                <th>Job Title</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Vincent Williamson</td>
                                <td>31</td>
                                <td>iOS Developer</td>
                                <td>Sinaai-Waas</td>
                                <td>
                                    <ul class="action-list">
                                        <li><a href="#" data-tip="edit"><i class="fa fa-edit"></i></a></li>
                                        <li><a href="#" data-tip="delete"><i class="fa fa-trash"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Taylor Reyes</td>
                                <td>22</td>
                                <td>UI/UX Developer</td>
                                <td>Baileux</td>
                                <td>
                                    <ul class="action-list">
                                        <li><a href="#" data-tip="edit"><i class="fa fa-edit"></i></a></li>
                                        <li><a href="#" data-tip="delete"><i class="fa fa-trash"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Justin Block</td>
                                <td>26</td>
                                <td>Frontend Developer</td>
                                <td>Overland Park</td>
                                <td>
                                    <ul class="action-list">
                                        <li><a href="#" data-tip="edit"><i class="fa fa-edit"></i></a></li>
                                        <li><a href="#" data-tip="delete"><i class="fa fa-trash"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Sean Guzman</td>
                                <td>26</td>
                                <td>Web Designer</td>
                                <td>Gloucester</td>
                                <td>
                                    <ul class="action-list">
                                        <li><a href="#" data-tip="edit"><i class="fa fa-edit"></i></a></li>
                                        <li><a href="#" data-tip="delete"><i class="fa fa-trash"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Keith Carter</td>
                                <td>20</td>
                                <td>Graphic Designer</td>
                                <td>Oud-Turnhout</td>
                                <td>
                                    <ul class="action-list">
                                        <li><a href="#" data-tip="edit"><i class="fa fa-edit"></i></a></li>
                                        <li><a href="#" data-tip="delete"><i class="fa fa-trash"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col col-sm-6 col-xs-6">showing <b>5</b> out of <b>25</b> entries</div>
                        <div class="col-sm-6 col-xs-6">
                            <ul class="pagination hidden-xs pull-right">
                                <li><a href="#"><</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">></a></li>
                            </ul>
                            <ul class="pagination visible-xs pull-right">
                                <li><a href="#"><</a></li>
                                <li><a href="#">></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    } 
    else 
    {
        afficher_formulaire();
    }


?>


</body>
</html>
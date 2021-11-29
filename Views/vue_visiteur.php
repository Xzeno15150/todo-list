<!DOCTYPE html>
<html lang="en">
<head>
    <title>TODO List</title>
    <link rel="icon" href="Views/icons/checked.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="View/sheets/main.css">
    <script src="https://kit.fontawesome.com/753235255d.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                            <i class="fas fa-home mr-3"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Rechercher">
                            <button class="btn btn-success ml-2" type="submit">Rechercher</button>
                        </form>
                    </li>
                    
                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                    <li class="nav-item mr-3">
                        <button class="btn btn-primary">Connexion</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-info">Inscription</button>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>

    <div class="container m-3 p-2 rounded mx-auto bg-light shadow">
        <div class="row m-1 p-4">
            <div class="col">
                <div class="p-1 h1 text-primary text-center mx-auto display-inline-block">
                    <i class="fas fa-check"></i>
                    <u>ToDo Lists Publiques</u>
                </div>
            </div>
        </div>
        <div class="row m-1 p-3">
            <div class="col col-11 mx-auto">
                <div class="row bg-white rounded shadow-sm p-2 add-todo-wrapper align-items-center justify-content-center">
                    <form method="post" class="d-flex col">
                        <input class="form-control form-control-lg border-1 add-todo-input bg-transparent rounded mr-3" type="text" placeholder="Ajouter une nouvelle liste.." name="nomListe">
                        <button type="button" class="btn btn-primary" type="submit">Nouvelle Liste</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="p-2 mx-4 border-black-25 border-top"></div>

        <?php foreach ($all_lists as $liste) {?>
        <div class="row px-3 align-items-center rounded ">
            <div class="col-auto m-1 p-0 d-flex align-items-center">
                <h2 class="m-0 p-0">
                    <i class="far fa-square text-primary btn m-0 p-0" title="Marqué Terminée"></i>
                    <i class="far fa-check-square text-primary btn m-0 p-0 d-none" title="Marqué Non-Terminée"></i>
                </h2>
            </div>
            <div class="col px-1 m-1 ml-3 d-flex align-items-center">
                <input type="text" class="form-control form-control-lg border-0 rounded px-3" readonly value="<?php echo $liste->getNom()?>"/>
                
            </div>
            <div class="col-auto m-1 p-0">
                <div class="row d-flex align-items-center justify-content-end">
                    <h5 class="m-0 p-0 px-2">
                        <i class="fas fa-pen text-info btn p-0 m-0" title="Modifier Liste"></i>
                    </h5>
                    <h5 class="m-0 p-0 px-2">
                        <i class="fas fa-trash text-danger btn m-0 p-0" title="Effacer Liste"></i>
                    </h5>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>


</body>
</html>

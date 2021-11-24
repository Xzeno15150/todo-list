<!DOCTYPE html>
<html lang="en">
<head>
    <title>TODO List</title>
    <link rel="icon" href="Views/icons/checked.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="View/sheets/main.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-success ml-2" type="submit">Search</button>
                        </form>
                    </li>
                    
                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>

    <div class="container m-3 p-2 rounded mx-auto bg-light shadow">
        <div class="row m-1 p-4">
            <div class="col">
                <div class="p-1 h1 text-primary text-center mx-auto display-inline-block">
                    <img src="Views/icons/checked.png" height="50"></img>
                    <u>ToDo Lists</u>
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
        <div class="p-2 mx-4 border-black-25 border-bottom"></div>

        <?php foreach ($all_lists as $liste) {?>
        <div class="row px-3 align-items-center rounded">
            <div class="col-auto m-1 p-0 d-flex align-items-center">
                <h2 class="m-0 p-0">
                    <!-- #TODO Afficher le logo de cochage-->
                </h2>
            </div>
            <div class="col px-1 m-1 d-flex align-items-center">
                <h3><?php echo $liste->getNom()?></h3>
            </div>
            <div class="col-auto m-1 p-0 px-3 d-none">
            </div>
            <div class="col-auto m-1 p-0">
                <div class="row d-flex align-items-center justify-content-end">
                    <h5 class="m-0 p-0 px-2">
                        <!-- #TODO editer la liste -->
                    </h5>
                    <h5 class="m-0 p-0 px-2">
                        <!-- #TODO supprimer la liste (poubelle)-->
                    </h5>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>


</body>
</html>

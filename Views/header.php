<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!--<ul class="navbar-nav me-auto mb-2 mb-lg-0 mr-auto">
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
                
            </ul>-->
            <div class="mr-auto">
                <a class="nav-link active" aria-current="page" href="index.php">
                    <i class="fas fa-home mr-3"></i>
                </a>
            </div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <?php if (!isset($user_connected)) { ?>
                <li class="nav-item mr-3">
                    <a type="button" class="btn btn-primary" href="Views/vue_connection.php">Connection</a>
                </li>
                <li class="nav-item">
                    <input type="button" class="btn btn-outline-info" value="Inscription" />
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <input type="button" class="btn btn-warning" value="Déconnexion" />
                </li>  
                <?php }?>
            </ul>
            
        </div>
    </div>
</nav>
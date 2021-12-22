<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="mr-auto">
                <a class="nav-link active" aria-current="page" href="index.php?action=afficherListes">
                    <i class="fas fa-home mr-3"></i>
                </a>
            </div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <?php if (!isset($user_connected)) { ?>
                <li class="nav-item mr-3">
                    <a class="btn btn-primary" href="Views/vue_connection.php">Connection</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-info" href="Views/vue_inscription.php">Inscription</a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <span href="#" class="h3 text-light rounded mr-2"><u><?php echo $user_connected->getPseudo();?></u></span>
                </li>
                <li class="nav-item">
                    <a type="button" class="btn btn-warning" href="index.php?action=deconnecter">Déconnection</a>
                </li>  
                <?php }?>
            </ul>
            
        </div>
    </div>
</nav>
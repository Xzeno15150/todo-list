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
    <?php require 'Views/header.php' ?>

    <?php if(isset($user_connected)) { ?>
        <div class="container m-3 p-2 rounded mx-auto shadow">
        <div class="row m-1 p-4">
            <div class="col">
                <div class="p-1 h1 text-success text-center mx-auto display-inline-block">
                    <i class="fas fa-lock"></i>
                    <u>ToDo Lists Privées</u>
                </div>
            </div>
        </div>
        <div class="row m-1 p-3">
            <div class="col col-11 mx-auto">
                <div class="row bg-white rounded shadow-sm p-2 add-todo-wrapper align-items-center justify-content-center">
                    <form method="post" class="d-flex col" action="index.php?action=creerListePriv">
                        <input class="form-control form-control-lg border-1 add-todo-input bg-transparent rounded mr-3" type="text" placeholder="Ajouter une nouvelle liste.." name="nomListePriv">
                        <button type="button" class="btn btn-primary" type="submit">Nouvelle Liste</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="p-2 mx-4 border-black-25 border-top"></div>

        <?php if (isset($private_lists)) { foreach ($private_lists as $liste) {?>
        <div class="row px-3 align-items-center rounded ">
            <div class="col-auto m-1 p-0 d-flex align-items-center">
                <h2 class="m-0 p-0">
                    <?php if ($liste->isChecked()) {
                        echo "<a href=\"index.php?action=checkListe&id=".$liste->getId()."\"><i class=\"far fa-check-square text-primary btn p-0 m-0\" title=\"Uncheck Liste\"></i></a>";
                    } 
                    else {
                        echo "<a href=\"index.php?action=checkListe&id=".$liste->getId()."\"><i class=\"far fa-square text-primary btn p-0 m-0\" title=\"Check Liste\"></i></a>";
                    }
                    ?>
                    
                </h2>
            </div>
            <div class="col px-1 m-1 ml-3 d-flex align-items-center">
                <?php if ($liste->isChecked()) { ?>
                    <a href="" class="btn btn-outline-dark border-0 rounded px-3">
                        <s>
                            <?php echo $liste->getNom()?>
                        </s>
                    </a>
                <?php }
                else { ?>
                    <a href="" class="btn btn-outline-dark border-0 rounded px-3">
                        <?php echo $liste->getNom()?>
                    </a>
                <?php  }?>
                
                
            </div>
            <div class="col-auto m-1 p-0">
                <div class="row d-flex align-items-center justify-content-end">
                    <h5 class="m-0 p-0 px-2">
                        <a href="index.php?action">
                            <i class="fas fa-pen text-info btn p-0 m-0" title="Modifier Liste"></i>
                        </a>
                    </h5>
                    <h5 class="m-0 p-0 px-2">
                        <i class="fas fa-trash text-danger btn m-0 p-0" title="Effacer Liste"></i>
                    </h5>
                </div>
            </div>
        </div>
    <?php }}
    if (isset($nbpagesprivees)) {
            if($nbpagesprivees > 1) { ?>
                <div class="container m-3 p-2rounded mx-auto shadow">
                    <a href="index.php?action=afficherListes&pagePrivee=1&pagePublic=<?php echo $pagePublic ?>" class="btn">1</a>
                    <?php if($pagePrivee > 2) {?>
                        <a href="index.php?action=afficherListes&pagePrivee=<?php echo $pagePrivee-1 ?>&pagePublic=<?php echo $pagePublic ?>" class="btn">&lt;</a>
                    <?php }?>
                    <span class="text-primary">...</span>
                    <?php if($pagePrivee < $nbpagesprivees-1) {?>
                        <a href="index.php?action=afficherListes&pagePrivee=<?php echo $pagePrivee+1 ?>&pagePublic=<?php echo $pagePublic?>" class="btn">&gt;</a>
                    <?php }?>
                    <a href="index.php?action=afficherListes&pagePrivee=<?php echo $nbpagesprivees ?>&pagePublic=<?php echo $pagePublic ?>" class="btn"><?php echo $nbpagesprivees?></a>
                </div>
    <?php   }
    }}?>

    

    <div class="container m-3 p-2 rounded mx-auto shadow">
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
                        <input class="form-control form-control-lg border-1 add-todo-input bg-transparent rounded mr-3" type="text" placeholder="Ajouter une nouvelle liste.." name="nomListePub">
                        <button type="button" class="btn btn-primary" type="submit">Nouvelle Liste</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="p-2 mx-4 border-black-25 border-top"></div>

        <?php if(isset($public_lists)) { foreach ($public_lists as $liste) {?>
        <div class="row px-3 align-items-center rounded ">
            <div class="col-auto m-1 p-0 d-flex align-items-center">
                <?php if ($liste->isChecked()) {
                        echo "<a href=\"index.php?action=checkListe&id=".$liste->getId()."\"><i class=\"far fa-check-square text-primary btn p-0 m-0\" title=\"Uncheck Liste\"></i></a>";
                    } 
                    else {
                        echo "<a href=\"index.php?action=checkListe&id=".$liste->getId()."\"><i class=\"far fa-square text-primary btn p-0 m-0\" title=\"Check Liste\"></i></a>";
                    }
                    ?>
            </div>
            <div class="col px-1 m-1 ml-3 d-flex align-items-center">
                <?php if ($liste->isChecked()) { ?>
                    <a href="" class="btn btn-outline-dark border-0 rounded px-3">
                        <s>
                            <?php echo $liste->getNom()?>
                        </s>
                    </a>
                <?php }
                else { ?>
                    <a href="" class="btn btn-outline-dark border-0 rounded px-3">
                        <?php echo $liste->getNom()?>
                    </a>
                <?php  }?>
                
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
        <?php }} ?>
    </div>
    <?php if (isset($nbpagespublics)) {
            if($nbpagespublics > 1) { ?>
                <div class="container m-3 p-2rounded mx-auto shadow">
                    <a href="index.php?action=afficherListes&pagePublic=1&pagePrivee=<?php echo $pagePrivee ?>" class="btn">1</a>
                    <?php if($pagePublic > 2) {?>
                        <a href="index.php?action=afficherListes&pagePublic=<?php echo $pagePublic-1 ?>&pagePrivee=<?php echo $pagePrivee ?>" class="btn">&lt;</a>
                    <?php }?>
                    <span class="text-primary">...</span>
                    <?php if($pagePublic < $nbpagespublics-1) {?>
                        <a href="index.php?action=afficherListes&pagePublic=<?php echo $pagePublic+1 ?>&pagePrivee=<?php echo $pagePrivee ?>" class="btn">&gt;</a>
                    <?php }?>
                    <a href="index.php?action=afficherListes&pagePublic=<?php echo $nbpagespublics?>&pagePrivee=<?php echo $pagePrivee ?>" class="btn"><?php echo $nbpagespublics?></a>
                </div>
    <?php   }
    }?>


</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title>TODO List - <?php echo $liste->getNom(); ?></title>
    <link rel="icon" href="Views/icons/checked.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="View/sheets/main.css">
    <script src="https://kit.fontawesome.com/753235255d.js" crossorigin="anonymous"></script>
</head>
<body>
	<?php 	if (isset($liste)) { ?>

		<div class="container m-3 p-2 rounded mx-auto shadow">
	        <div class="row m-1 p-4">
	            <div class="col">
	                <div class="p-1 h1 text-primary text-center mx-auto display-inline-block">
	                    <i class="fas fa-clipboard-list"></i>
	                    <u><?php echo $liste->getNom(); ?></u>
	                </div>
	            </div>
	        </div>
	        <div class="row m-1 p-3">
	            <div class="col col-11 mx-auto">
	                <div class="row bg-white rounded shadow-sm p-2 add-todo-wrapper align-items-center justify-content-center">
	                    <form method="post" class="d-flex col" action="index.php?action=creerTache">
	                        <input class="form-control form-control-lg border-1 add-todo-input bg-transparent rounded mr-3" type="text" placeholder="Titre.." name="titleTache">
	                        <input class="form-control form-control-lg border-1 add-todo-input bg-transparent rounded mr-3" type="text" placeholder="Description.." name="descTache">
	                        <input type="text" name="idListe" hidden value="<?php echo $liste->getId();?>">
	                        <button type="submit" class="btn btn-primary">Nouvelle Tâche</button>
	                    </form>
	                </div>
	            </div>
	        </div>
	        <div class="p-2 mx-4 border-black-25 border-top"></div>

	        <?php if(isset($lesTaches)) { 
	            foreach ($lesTaches as $tache) {?>
	        <div class="row px-3 align-items-center rounded ">
	            <div class="col-auto m-1 p-0 d-flex align-items-center">
	                <?php if ($tache->isChecked()) {
	                        echo "<a href=\"index.php?action=checkTache&idt=".$tache->getId()."&id=".$liste->getId()."\"><i class=\"far fa-check-square text-primary btn p-0 m-0\" title=\"Uncheck Tâche\"></i></a>";
	                    } 
	                    else {
	                        echo "<a href=\"index.php?action=checkTache&idt=".$tache->getId()."&id=".$liste->getId()."\"><i class=\"far fa-square text-primary btn p-0 m-0\" title=\"Check Tâche\"></i></a>";
	                    }
	                    ?>
	            </div>
	            <div class="col px-1 m-1 ml-3 d-flex align-items-center">
	                <?php 
	                if (isset($idEdit) && $tache->getId() == $idEdit) {?>

	                    <form action="index.php?action=editTache&idl=<?php echo $liste->getId(); ?>" method="post">
	                        <input type="text" name="editTacheTitle" placeholder="Ancien titre : <?php echo $tache->getTitle(); ?>" required>
	                        <input type="text" name="editTacheDesc" placeholder="Ancienne description : <?php echo $tache->getDesc(); ?>" required>
	                        <input type="text" name="idEdit" hidden value="<?php echo $tache->getId();?>">
	                        <input type="submit" class="btn btn-success" name="editTache" value="Modifier">
	                    </form>
	                <?php 
	                }
	                else {
	                    if ($tache->isChecked()) { echo '<s>';}
	                        echo "<div class=\"border-1 bg-transparent rounded mr-3\">".$tache->getTitle()."</div>";
	                        echo "<div class=\"border-1 bg-transparent rounded mr-3\">".$tache->getDesc()."</div>";
	                    if ($tache->isChecked()) { echo '</s>';}
	                } ?>
	                
	                
	            </div>
	            <div class="col-auto m-1 p-0">
	                <div class="row d-flex align-items-center justify-content-end">
	                    <h5 class="m-0 p-0 px-2">
	                        <a href="index.php?action=afficherTaches&idEdit=<?php echo $tache->getId();?>&page=<?php echo $page;?>&id=<?php echo $liste->getId(); ?>">
	                            <i class="fas fa-pen text-info btn p-0 m-0" title="Modifier Liste"></i>
	                        </a>
	                    </h5>
	                    <h5 class="m-0 p-0 px-2">
	                        <a href="index.php?action=supTache&id=<?php echo $tache->getId();?>">
	                            <i class="fas fa-trash text-danger btn m-0 p-0" title="Effacer Liste"></i>
	                        </a>
	                    </h5>
	                </div>
	            </div>
	        </div>
	        <?php }} ?>
	    </div>
	    <?php if (isset($nbpages)) {
	            if($nbpages > 1) { ?>
	                <div class="container m-3 p-2rounded mx-auto shadow">
	                    <a href="index.php?action=afficherTaches&id=<?php echo $liste->getId(); ?>&page=1" class="btn">1</a>
	                    <?php if($page > 2) {?>
	                        <a href="index.php?action=afficherTaches&id=<?php echo $liste->getId(); ?>&page=<?php echo $page-1 ?>" class="btn">&lt;</a>
	                    <?php }?>
	                    <span class="text-primary">...</span>
	                    <?php if($page < $nbpages-1) {?>
	                        <a href="index.php?action=afficherTaches&id=<?php echo $liste->getId(); ?>&page=<?php echo $page+1 ?>" class="btn">&gt;</a>
	                    <?php }?>
	                    <a href="index.php?action=afficherTaches&id=<?php echo $liste->getId(); ?>&page=<?php echo $nbpages?>" class="btn"><?php echo $nbpages?></a>
	                </div>
	    <?php   }
	    }}?>
	
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>TODO List - <?php echo $current_liste->getNom(); ?></title>
    <link rel="icon" href="Views/icons/checked.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="View/sheets/main.css">
    <script src="https://kit.fontawesome.com/753235255d.js" crossorigin="anonymous"></script>
</head>
<body>
	<?php require 'Views/header.php' ?>
		<div class="d-inline-flex vh-100">
				<div class="d-flex flex-column flex-shrink-0 p-3 text-dark vh-100" style="width: 280px;">
					<div class="h2">
						<i class="fas fa-clipboard-list"></i>
						<?php echo $current_liste->getNom(); ?>
					</div>

			        <div class="p-2 mx-2 border-black border-top"></div>
					<hr>
					<a href="#" class="btn btn-primary my-auto">
						<i class="fas fa-plus-circle"></i>
						Nouvelle Tâche
					</a>
					<hr>
					<?php foreach ($current_liste->getTaches() as $tache) { ?>
						<input class="btn btn-outline-dark" type="button" name="tacheSelected" value="<?php echo $tache->getTitle(); ?>">
					<?php } ?>
				</div>
				<?php if (isset($current_tache)) { ?>
					<div class="d-flex flex-shrink-0 p-2">
						<div class="h3 text-Dark">
							<i class="fas fa-check-square"></i>
							<?php echo $current_tache->getTitle(); ?>
							<div class="container p-3">
								
							</div>
						</div>
					</div>
				<?php  } ?>
		</div>
</body>
</html>
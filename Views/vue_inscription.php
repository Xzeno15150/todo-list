<!DOCTYPE html>
<html>
<head>
	<title>TODO List - Inscription</title>
    <link rel="icon" href="Views/icons/checked.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="View/sheets/main.css">
    <script src="https://kit.fontawesome.com/753235255d.js" crossorigin="anonymous"></script>
</head>
<body>
	<form class="container m-3 p-2 rounded mx-auto shadow" action="../index.php?action=inscription" method="post">
		<div class="form-group">
		    <label for="inputPseudo">Pseudo</label>
		    <input type="text" class="form-control" id="inputPseudo" name="inputPseudo" placeholder="Entrez un pseudo..." required>
		</div>
		<div class="form-group">
		    <label for="inputMDP">Mot de Passe </label>
		    <input type="password" class="form-control" id="inputMDP" name="inputMDP" placeholder="Mot de Passe..." aria-describedby="descMDP" required>
		</div>
		<!--<div class="form-group form-check">
			<input type="checkbox" class="form-check-input" id="stayConnectCheck" name="stayConnectCheck">
		    <label class="form-check-label" for="stayConnectCheck">Rester connecté</label>
		</div>-->
	  <button type="submit" class="btn btn-primary">Inscription</button>
	</form>
</body>
</html>
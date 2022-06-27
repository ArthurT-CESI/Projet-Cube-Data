<?php 
    include '../../../config/header.php';
    include '../../../config/connect.php';
    session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body style="/*background-image:url('/images/58914.jpg')*/background: #000000;">
	<br>
	<div class="container">
            <a href="editeur.php" class="btn btn-warning">Retour</a>
    </div>
	<h2 style="text-align:center;color:#FFC251;"><b>Pilotage des activités</b></h2>

	<div class="container" style="text-align:center">
	
	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="640" 
		height="480" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62b3959a-7fbe-4032-8e2f-f88e65bcd0b4&maxDataAge=10&theme=light&autoRefresh=true&attribution=false&filter=%7B%27id_editeur': ObjectId('<?php echo $_SESSION['id_editeur'] ?>')}&attribution=false">
	</iframe>

	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="640" 
		height="480" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=624af17b-09c4-46bd-874c-a1d9ebdef702&maxDataAge=10&theme=light&autoRefresh=true&attribution=false&filter=%7B%27id_editeur': ObjectId('<?php echo $_SESSION['id_editeur'] ?>')}&attribution=false">
	</iframe>

	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="640" 
		height="480" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=86b89c47-b467-40fa-8926-6c1ebeac493d&maxDataAge=10&theme=light&autoRefresh=true&filter=%7B%27id_editeur': ObjectId('<?php echo $_SESSION['id_editeur'] ?>')}&attribution=false">
	</iframe>

	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="640" 
		height="480" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62b39014-3cb9-4c83-8be2-411e3cdfbec5&maxDataAge=10&theme=light&autoRefresh=true&filter=%7B%27id_editeur': ObjectId('<?php echo $_SESSION['id_editeur'] ?>')}&attribution=false">
	</iframe>
	
	</div>
	
</body>
</html>
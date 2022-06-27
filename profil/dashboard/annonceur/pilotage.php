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
            <a href="annonceur.php" class="btn btn-warning">Retour</a>
    </div>
	<h2 style="text-align:center;color:#FFC251;"><b>Pilotage des activités</b></h2>

	<div class="container" style="text-align:center">

	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="640" 
		height="480" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62b0ef17-71d3-420a-8972-6a92952d3fc4&maxDataAge=10&theme=light&autoRefresh=true&filter=%7B%27Id_annonceur': ObjectId('	<?php echo $_SESSION['id_annonceur'] ?>')}&attribution=false">
	</iframe>
	
	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="640" 
		height="480" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=624ffc91-6b73-4e83-81e3-596ec007eeb2&maxDataAge=10&theme=light&autoRefresh=true&filter=%7B%27Id_annonceur': ObjectId('	<?php echo $_SESSION['id_annonceur'] ?>')}&attribution=false">
	</iframe>

	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="640" 
		height="480" src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62b39f0f-5876-4f64-8419-9d8f2c5b14a7&maxDataAge=10&theme=light&autoRefresh=true&filter=%7B%27Id_annonceur': ObjectId('	<?php echo $_SESSION['id_annonceur'] ?>')}&attribution=false">
	</iframe>

	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="640" 
		height="480" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62500464-44b4-4b7a-8da7-59ffed5eec44&maxDataAge=10&theme=light&autoRefresh=true&filter=%7B%27Id_annonceur': ObjectId('<?php echo $_SESSION['id_annonceur'] ?>')}&attribution=false">
	</iframe>


	</div>
	
</body>
</html>

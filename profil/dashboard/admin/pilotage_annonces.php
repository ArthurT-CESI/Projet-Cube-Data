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
            <a href="admin.php" class="btn btn-warning">Retour</a>
    </div>
	<h2 style="text-align:center;color:#FFC251;"><b>Suivi des annonces sur Publikeco</b></h2>

	<div class="container" style="text-align:center">
	
	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="1280" 
		height="400"
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62b0d44d-71d3-43b6-8ac7-6a9295185869&maxDataAge=10&theme=light&autoRefresh=true">
	</iframe>
	</div>

	<div class="container" style="text-align:center">

	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="640" 
		height="480" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62b0d8ef-3e2c-48ff-89aa-64ff14568c4a&maxDataAge=3600&theme=light&autoRefresh=true">
	</iframe>

	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="640" 
		height="480" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62b0ef17-71d3-420a-8972-6a92952d3fc4&maxDataAge=10&theme=light&autoRefresh=true">
	</iframe>

	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="640" 
		height="480" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62b366a6-2b11-4ff5-8c1a-6d176c3cb78c&maxDataAge=1800&theme=light&autoRefresh=true">
	</iframe>
	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="640" 
		height="480" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62b368df-cbdc-4f81-88e0-ad1b8a4db0b3&maxDataAge=60&theme=light&autoRefresh=true">
	</iframe>
	</div>
	
</body>
</html>

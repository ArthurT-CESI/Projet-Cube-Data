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
	<h2 style="text-align:center;color:#FFC251;"><b>Suivi des jeux sur Publikeco</b></h2>

	<div class="container" style="text-align:center">
	
	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="1200" 
		height="350" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62b20ee6-8ab5-4c0d-8523-bf238f5eb653&maxDataAge=10&theme=light&autoRefresh=true">
	</iframe>
	</div>

	<div class="container" style="text-align:center">

	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="1200" 
		height="350" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62b21137-8ab5-459b-885e-bf238f60803d&maxDataAge=10&theme=light&autoRefresh=true">
	</iframe>
	</div>
	
	<div class="container" style="text-align:center">
	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="850" 
		height="500" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62b22b46-852c-42ed-8285-6e0624b45baf&maxDataAge=10&theme=light&autoRefresh=true">
	</iframe>

	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="350" 
		height="500" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62b22c5c-cbdc-4ad0-8b92-ad1b8a0d6e93&maxDataAge=10&theme=light&autoRefresh=true"></iframe>
	</div>
</body>
</html>

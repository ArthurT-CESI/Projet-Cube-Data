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
	<h2 style="text-align:center;color:#FFC251;"><b>Suivi des joueurs sur Publikeco</b></h2>

	<div class="container" style="text-align:center">
	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="1200" 
		height="350" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=93bb2725-6434-458b-b323-ccee6632265c&maxDataAge=10&theme=light&autoRefresh=true">
	</iframe>
	</div>

	<div class="container" style="text-align:center">

	</div>
	
	<div class="container" style="text-align:center">
	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="598" 
		height="480" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62b234ad-2c44-4c19-85b3-fdb03c14ae8a&maxDataAge=10&theme=light&autoRefresh=true">
	</iframe>

	<iframe 
		style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);" 
		width="598" 
		height="480" 
		src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/charts?id=62b233d6-cbdc-4b20-881e-ad1b8a13d4b2&maxDataAge=10&theme=light&autoRefresh=true">
	</iframe>
</body>
</html>

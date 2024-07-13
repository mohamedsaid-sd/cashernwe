<?php
session_start();
$sid = $_SESSION['sid'] ; 
if(!isset($_SESSION['sid'])){
	echo '<meta http-equiv="refresh" content="0;url=index.php"';
}
?>
<!DOCTYPE html>
<html dir="rtl">
<head>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<title> التقارير </title>
</head>

<body>

	<center>
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	<h1> التقارير </h1>
	<a href="day.php"><button class="btn"> اليومية </button></a><br/>
	<a href="month.php"><button class="btn"> الشهرية </button><br/>
	<a href="bills.php"><button class="btn"> الفواتير </button><br/>
	<a href="home.php"><button class="btn"> خروج </button></a>
	</center>

	
<?php include 'footer.php'; ?>
</body>
</html>
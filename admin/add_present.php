<?php
include('../config.php');
session_start();
$sid = $_SESSION['sid'] ; 
if(!isset($_SESSION['sid'])){
	echo '<meta http-equiv="refresh" content="0;url=index.php"';
}

if(isset($_POST['change'])){
	$present = $_POST['present'];
	$q = mysqli_query($conn , "UPDATE `present` SET `present` = '$present' WHERE `present`.`id` = 1;");
    if($q){
 	echo "<div id='alert_good'>تمت تعديل النسبة</div>";
	}else{
	echo "<div id='alert_pad'>خطأ في عملية التعديل</div>";
	}
}	

?>
<!DOCTYPE html>
<html dir="rtl">
<head>
	
	<title> حدد النسبة </title>
	
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>

	<!-- Call Bootstrab -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<!-- Call Style File -->
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<!-- Call bootstrab-->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<!-- Call Jquery -->
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	
	<!-- Call the datatable fies -->
	<!-- Datatable style -->
	<link rel="stylesheet" type="text/css" href="css/datatable.css"/>
	<!-- Datatable Button style -->	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
	<!-- Datatable script -->
	<script type="text/javascript" src="js/datatable.js"></script>
	
</head>

<style type="text/css">
	body , button , input[type=submit] , input[type=number] {
		font-size: 25px;
	}
	input[type=number] {
		width: 210px;
		padding: 5px;
		text-align: center;
		border-radius: 10px;
		font-size: 20px;
	}
</style>
<body style="font-size: 25px;">

<center style="margin-top: 200px;">
	
	<h1> نسبة النادل </h1>

	<a href="home.php"><img src="../img/fail.png" width="30" height="20"><input style="color: #fff;background-color: red;" type="submit" value="رجوع" /></a>

	<form method="post" action="add_present.php">

		<?php 
		$q = mysqli_query($conn,"SELECT * FROM `present`");
		while ($row = mysqli_fetch_array($q)) {
		?>
		
		<input style="font-size: 20px;" type="text" name="present" value="<?php echo $row['present']; ?>"/> % <br/>

		<button name="change" class="btn"> تغيير النسبة </button>

		<?php } ?>

	</form>

</center>

<?php include 'footer.php'; ?>
</body>
</html>
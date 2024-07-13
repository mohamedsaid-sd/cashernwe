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
<style type="text/css">
	body{
		font-size: 25px;
	}
	button{
		width: 150px;
		font-size: 20px;
	}
</style>
<body>
	<center>
		<a href="reports.php"><img src="../img/fail.png" width="30" height="20"><input style="color: #fff;background-color: red;" type="submit" value="خروج" /></a>
	<form action="day.php" method="post">
	الكاشير : 
	<select name="key" style="width: 80px;text-align: center;padding:5px;font-weight: bold;border-radius:10px;">
		<option value="0"> الكل </option>
		<?php
			include('../config.php');
			$q = mysqli_query($conn,"SELECT * FROM `users`");
			while ($row = mysqli_fetch_array($q)) {
		?>
		<option value="<?php echo $row['id']; ; ?>"> <?php echo $row['name']; ?> </option>
		<?php } ?> 
	</select> <button type="submit" name="filter"> كاشير محدد </button>
	</form>


	<form action="day.php" method="post">
	النادل : 
	<select name="key" style="width: 80px;text-align: center;padding:5px;font-weight: bold;border-radius:10px;">
		<option value="0"> كاشير </option>
		<?php
			include('../config.php');
			$q = mysqli_query($conn,"SELECT * FROM `waiter`");
			while ($row = mysqli_fetch_array($q)) {
		?>
		<option value="<?php echo $row['id']; ; ?>"> <?php echo $row['name']; ?> </option>
		<?php } ?> 
	</select> <button type="submit" name="filterwaiter">  نادل محدد  </button>
	</form>

	<h2 style="color: #000;"> التقارير اليومي ليوم <?php echo date("d")-1; ?></h2>
	<table style="background-color: #fff;box-shadow: 2px 2px 5px black;padding: 5px;border-radius: 0px;color: #000;" width="80%">
			<tr>
				<th style="border-bottom: solid 1px  black;"> #الرقم </th>
				<th style="border-bottom: solid 1px  black;"> اسم المنتج </th>
				<th style="border-bottom: solid 1px  black;"> عدد الطلبات </th>
				<th style="border-bottom: solid 1px  black;"> الإجمالي </th>
			</tr>
		<?php
	
		if(isset($_POST['filter'])){
			$filter = $_POST['key'] ; 
			if($filter == "0"){
				$q = mysqli_query($conn,"SELECT * , SUM(qount) as 'qount' , COUNT(product) as 'count' , SUM(sumation) as 'sum' FROM `orders` WHERE DATE(date) = DATE(NOW()) GROUP by product ");
			}else{
				$q = mysqli_query($conn,"SELECT * , SUM(qount) as 'qount' , COUNT(product) as 'count' , SUM(sumation) as 'sum' FROM `orders` WHERE DATE(date) = DATE(NOW()) and user_id =$filter GROUP by product");
			}
		}else{
			$q = mysqli_query($conn,"SELECT * , SUM(qount) as 'qount' , COUNT(product) as 'count' , SUM(sumation) as 'sum' FROM `orders` WHERE DATE(date) = DATE(NOW()) GROUP by product ");
		}


			if(isset($_POST['filterwaiter'])){
			$filter = $_POST['key'] ; 
			if($filter == "0"){
				$q = mysqli_query($conn,"SELECT * , SUM(qount) as 'qount' , COUNT(product) as 'count' , SUM(sumation) as 'sum' FROM `orders` WHERE DATE(date) = DATE(NOW()) and waiter_id LIKE '0' GROUP by product ");
			}else{
				$q = mysqli_query($conn,"SELECT * , SUM(qount) as 'qount' , COUNT(product) as 'count' , SUM(sumation) as 'sum' FROM `orders` WHERE DATE(date) = DATE(NOW()) and waiter_id =$filter GROUP by product");
			}
			}
		$sum = 0 ; 
		$i = 1 ;
		while ($row = mysqli_fetch_array($q)) {
			$sum = $sum + $row['sum'] ; 
			echo '<tr>
				<th> '.$i.' </th>
				<th> '.$row['product'].' </th>
				<th> '.$row['qount'].' </th>
				<th> '.$row['sum'].' </th>
			</tr>
			';
			$i++;
		}
		?>
		</table>

			<table style="background-color: #fff;box-shadow: 2px 2px 5px black;padding: 5px;border-radius: 0px;color: #000;" width="80%">
		<tr>
			<th> المجموع </th>
			<th>  </th>
			<th>  </th>
			<th> <?php echo $sum." جنيه ";


			if(isset($_POST['filterwaiter'])){
			$filter = $_POST['key'] ; 
			if($filter != "0"){
				$present = "";
				$q = mysqli_query($conn,"SELECT * FROM `present`");
				while ($row = mysqli_fetch_array($q)) {
					$present = $row['present'];
				}
				// عملية النادل الحسابية 
				// المجموع * النسبة المئوية / 100
				$wsum = $sum * $present / 100 ;  
				echo " / بنسبة:".$present."%  اجمالي حساب النادل:".$wsum."جنيه" ;
			}
			}

			 ?> </th>
		</tr>
	</table>
	</center>

<?php include 'footer.php'; ?>
</body>
</html>
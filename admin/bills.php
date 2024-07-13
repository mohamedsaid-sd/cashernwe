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
	button , input[type=number]{
		width: 150px;
		font-size: 20px;
		text-align: center;
	}
</style>
<body>
	<?php
	//configration
	include('../config.php');
	?>
	<center>
		<a href="reports.php"><img src="../img/fail.png" width="30" height="20"><input style="color: #fff;background-color: red;" type="submit" value="رجوع" /></a>
	

	<form action="bills.php" method="post" style="color: #773;">
	رقم فاتورة محدد : 	<input type="number" name="bill_no" placeholder="0" />
	<button name="search"> بحث  </button>	</form>


	<table style="background-color: #fff;box-shadow: 2px 2px 5px black;padding: 5px;border-radius: 0px;color: #000;height: 100px;overflow-wrap: scroll;" width="80%">
			<tr>
				<th style="border-bottom: solid 1px  black;"> # </th>
				<th style="border-bottom: solid 1px  black;"> رقم الفاتورة </th>
				<th style="border-bottom: solid 1px  black;"> عدد العناصر </th>
				<th style="border-bottom: solid 1px  black;"> الإجمالي </th>
			</tr>
		<?php

		// searching for spesific bill number like bill no : 10 
		if(isset($_POST['search'])){

			$bill_no = $_POST['bill_no'];

			if($_POST['bill_no'] == ""){

			$q = mysqli_query($conn,"SELECT * , COUNT(order_id) as items , SUM(sumation) as total FROM `orders` GROUP BY orders.order_id ORDER BY `orders`.`id` DESC");
			}else{
					$q = mysqli_query($conn,"SELECT * , COUNT(order_id) as items , SUM(sumation) as total FROM `orders` WHERE order_id like '$bill_no' GROUP BY orders.order_id ORDER BY `orders`.`id` DESC");
			}
	
		}else{
				$q = mysqli_query($conn,"SELECT * , COUNT(order_id) as items  FROM `orders` GROUP BY orders.order_id ORDER BY `orders`.`id` DESC ");
		}
	
	
		$sum = 0 ; 
		$i = 1 ;
		while ($row = mysqli_fetch_array($q)) {
			$sum = $sum + $row['total'] ; 
			echo '<tr>
				<th> '.$i.' </th>
				<th>  فاتورة رقم <a href="bill_info.php?id='.$row['order_id'].'">'.$row['order_id'].'</a> اضغط لتفاصيل الفاتورة </th>
				<th> '.$row['items'].' </th>
				<th> '.$row['total'].' </th>
			</tr>
			';
			$i++;
		}

		if($i == 1){
			echo "<tr> <th colspan='5' style='color:red;'> لا توجد فاتورة بهذا الرقم </th>  </tr>";
		}
		?>
		</table>

			<table style="background-color: #fff;box-shadow: 2px 2px 5px black;padding: 5px;border-radius: 0px;color: #000;" width="80%">
		<tr>
			<th> المجموع </th>
			<th>  </th>
			<th>  </th>
			<th> <?php echo $sum." جنيه "; ?> </th>
		</tr>
	</table>
	</center>

<?php include 'footer.php'; ?>
</body>
</html>
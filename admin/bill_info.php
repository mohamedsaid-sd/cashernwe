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
	<?php 
	include('../config.php');
	$id = $_GET['id'];
	?>
	<center>
		<a href="bills.php"><img src="../img/fail.png" width="30" height="20"><input style="color: #fff;background-color: red;" type="submit" value="رجوع" /></a>




	<h2 style="color: #000;"> معلومات الفاتورة <?php echo $id; ?></h2>
	<table style="background-color: #fff;box-shadow: 2px 2px 5px black;padding: 5px;border-radius: 0px;color: #000;" width="80%">
			<tr>
				<th style="border-bottom: solid 1px  black;"> # </th>
				<th style="border-bottom: solid 1px  black;"> المنتج </th>
				<th style="border-bottom: solid 1px  black;"> الكمية  </th>
				<th style="border-bottom: solid 1px  black;"> السعر </th>
				<th style="border-bottom: solid 1px  black;"> الاجمالي </th>
			</tr>
		<?php
			
			$q = mysqli_query($conn,"SELECT * FROM `orders` WHERE `order_id` LIKE '$id' ");
	
		$sum   = 0 ; 
		$total = 0 ;
		$i = 1 ;
		while ($row = mysqli_fetch_array($q)) {
			$sum   = $sum   + $row['sumation'] ; 
			$total = $row['total'] ; 

			echo '<tr>
				<th> '.$i.' </th>
				<th> '.$row['product'].' </th>
				<th> '.$row['qount'].' </th>
				<th> '.$row['price'].' </th>
				<th>  '.$row['sumation'].' </th>
			</tr>
			';
			$i++;
		}
		?>
		</table>

			<table style="background-color: #fff;box-shadow: 2px 2px 5px black;padding: 5px;border-radius: 0px;color: #000;" width="80%">
		<tr>
			<th> المجموع </th>
			<th> <?php echo $sum."  "; ?> </th>
			<th> بعد الخصم : <?php echo $total."  "; ?> </th>
			<th>  الخصم :  <?php echo $sum - $total." "; ?> </th>
		</tr>
	</table>
	</center>

<?php include 'footer.php'; ?>
</body>
</html>
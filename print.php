<?php 
session_start();
if(!isset($_SESSION['sname'])){
	echo '<meta http-equiv="refresh" content="0;url=index.php"';
}
?>
<!DOCTYPE html>
<html dir="rtl">
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title> صفحة الطباعة </title>
</head>
<style type="text/css">
	body{height: initial; margin: 0px;padding: 0px;background-color: #000;}
	html{height: initial; margin: 0px;padding: 0px;}
	#ppp{
		background-color: #fff;
		box-shadow: 2px 2px 5px black;
		border-radius: 0px;
		color: #000;
		margin-bottom:30px;
		margin-top:30px;
	page-break-after: always;
	page-break-before: always;
	/*	page-break-inside: */
		/*page-break-inside: avoid; */
	}
	#p{
		margin-bottom: 300px ;
		/*page-break-inside: all;*/
	}
	#qr{
		margin-bottom: 300px ;
		/*page-break-inside: all;*/
	}
	h3{
		font-size: 23px;
	}
	th{
		font-size: 20px;
	}
</style>
<body onload="self.print();">
<!-- 	<body> -->
	<?php 
	include('config.php');
	$orderid = 0;
	$orderidint = 0;
	$dis = $_GET['dis'];
	$waiter = $_GET['waiter'];


	// Get the waiter name 
	$waiter_name = " الكاشير ";
	$query_w = mysqli_query( $conn , "SELECT * FROM `waiter` WHERE `id` = $waiter");
	while ($roww = mysqli_fetch_array($query_w)) {
		$waiter_name = $roww['name'];
	}


	// but all cart item 
	$select_department = mysqli_query( $conn , "SELECT DISTINCT (SELECT cat from product WHERE name LIKE cart.product) as 'cat' FROM `cart`");
	while ($department_row = mysqli_fetch_array($select_department)) {

		$did = $department_row['cat'];

		// Get the waiter name 
		$department_name = "";
		$query = mysqli_query( $conn , "SELECT * FROM `departments` WHERE `id` = $did");
		while ($rowo = mysqli_fetch_array($query)) {
			$department_name = $rowo['department'];
		}



		// Start Print 
		echo "<center id='ppp'>";

		echo "<h3>".$department_name." </h3>";

		echo "
		<table width='100%'>
		<tbody>
		";
		$select_product =  mysqli_query( $conn , "SELECT * FROM `cart` WHERE product in (SELECT name FROM product WHERE cat = $did);");
		while ($rowww = mysqli_fetch_array($select_product)) {
			echo " 
			<tr>
			<td> ".$rowww['product']." </td>	
			<td> الكمية ".$rowww['qount']." </td>
			</tr>
			";
		}


		// End Print 
		echo "</tbody></table><br/></center>";
		}


		$oid = '';

		$query= mysqli_query($conn,"SELECT * FROM `orders`");
		while ($order_row = mysqli_fetch_array($query)) {
			$oid = $order_row['order_id'] + 1;
			$oidint = $order_row['order_id'];
		}



		// But 0 befor one number 
		if($oid < 10){
			$oid = "0".$oid;
		}

		echo '<center id="ppp">
		<img src="img/logo.jpg" width="150"/>
		<hr/>';

			// echo "</h3><img src='barcode.php?codetype=Code39&&size=20&text=".$oid."'><br/>
			// فاتورة رقم : ".$oid." <br/> ";
			echo "</h3>فاتورة رقم : ".$oid." 
			<br/>";
			echo '<hr/>
			<h4 style="border:solid 2px black ;"> فاتورة مبيعات مبسطة  </h4>
			';
		//echo "<img style='height:10px;' id='qr' alt='testing' src='barcode.php?codetype=Code39&size=40&text=".$oid."&print=true'/>";
		
			echo " التاريخ :  ".date("Y/m/d h:i:s");
		echo '<br/>جوال : 249909642222 <hr/>
		<table width="90%" style="color: #000;">
		<tr>
			<th> المنتج </th>
			<th> الكمية </th>
			<th> السعر </th>
			<th> الاجمالي </th>
		</tr><tr>';

		$q = mysqli_query($conn,"SELECT * FROM `cart`");
		$sum = 0 ; 
		$sumall = 0 ; 

		while ($row = mysqli_fetch_array($q)) {
		$qo = mysqli_query($conn,"SELECT * FROM `orders`");
		while ($rowo = mysqli_fetch_array($qo)) {
			$orderid = $rowo['order_id'];
			$orderidint = $rowo['order_id'];
		}
		if(isset($orderid)){
			$orderid ++ ; 
			$orderidint = $orderid ;
			$orderid = "#".$orderid;
			//echo $orderid ;
		}else{
			$orderid = "#1" ; 
			$orderidint = "1" ;
			//echo $orderid ;
		}


		$sum = $sum + $row['total'];
	
	

		$orderid = $orderidint ;
			
			echo '
			<td style="text-align:center;"> '.$row['product'].' </td>
			<td style="text-align:center;"> '.$row['qount'].' </td>
			<td style="text-align:center;"> '.$row['price'].' </td>
			<td style="text-align:center;"> '.$row['total'].' </td>
			</tr>
		';


			////////////////////////new ffffffffffffaaaaaaaaaatttttttttttoooorrrrrrra

		// 		echo '
		// 	<center id="ppp"><h3> البيت السوداني :#'.$orderid;
		// 	echo " إستلام <br/> التاريخ :  ".date("Y/m/d h:i:s");
		// 	echo '</h3><hr/><table width="90%" style="color: #000;">
		// <tr>
		// 	<th> المنتج </th>
		// 	<th> الكمية </th>
		// 	<th> السعر </th>
		// 	<th> الاجمالي </th>
		// </tr><tr>
		// 	<td style="text-align:center;"> '.$row['product'].' </td>
		// 	<td style="text-align:center;"> '.$row['qount'].' </td>
		// 	<td style="text-align:center;"> '.$row['price'].'  </td>
		// 	<td style="text-align:center;"> '.$row['total'].'  </td>
		// </tr></table><table width="90%" style="color: #000;"><tr><th> </th>
		// 	<th>  </th>
		// 	<th>  </th>
		// 	<th>    </th></tr></table><hr/></center><div class="p"></div>';

		}

		$sumafterdiscount = $sum - $dis ; 

		$dis = $sum - $sumafterdiscount;

		echo'
		</table>
		
		<hr/>

		<table width="90%">
		<tr>
		<td style="text-align:center;"> المجموع :  </td>
		<td>  </td>
		<td>  </td>
		<td style="text-align:center;"> '.$sum.' </td> 
		</tr>
		<tr>
		<td style="text-align:center;"> الخصم :  </td>
		<td>  </td>
		<td>  </td>
		<td style="text-align:center;">  '.$dis.'  </td> 
		</tr>
		<tr>
		<td style="text-align:center;">المجموع بعد الخصم :  </td>
		<td>  </td>
		<td>  </td>
		<td style="text-align:center;"> '.$sumafterdiscount.'  </td> 
		</tr>
		<tr>
		<td colspan="3">
		<br/><br/>
		<center>
		النادل : '.$waiter_name.'
		</center>
		<hr/>
 
		<center>
			<b>.... شكرا لزيارتكم ....</b>
		</center>

		</td>
		</tr>
		</tr></table><table width="90%" style="color: #000;"><tr><th>  </th>
			<th>  </th>
			<th>  </th>
			<th>    </th></tr></table><hr/></center>
			
			<div class="p"></div>';

		?>


<script type="text/javascript">
window.onafterprint = function(event){

if(event){
	alert('gooo');
}else{
	alert('paddd');
}

</script>
<?php 
$sid = $_SESSION['sid'] ; 
include('config.php');
mysqli_query( $conn , "INSERT INTO orders ( order_id , product , qount , price , sumation , total , user_id , 	waiter_id , date ) SELECT '$orderid' , product , qount , price , total , '$sumafterdiscount' , $sid , $waiter ,CURRENT_TIMESTAMP FROM cart");
mysqli_query( $conn , "TRUNCATE cart");
echo '<meta http-equiv="refresh" content="0;url=home.php?sucsess=0">';
?>
<script type="text/javascript">

}
</script>

</body>
</html>
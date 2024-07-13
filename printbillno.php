

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
	<title> صفحة الطباعة فاتورة محددة </title>
</head>
<style type="text/css">
	body{height: initial; margin: 0px;padding: 0px;}
	html{height: initial; margin: 0px;padding: 0px;}
	#ppp{
		background-color: #fff;
		box-shadow: 2px 2px 5px black;
		border-radius: 0px;
		color: #000;
		margin-bottom:50px;
		margin-top:50px;
	page-break-after: always;
	/*	page-break-inside: */
		/*page-break-inside: avoid; */
	}
	#p{
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

	  ?>  
	


		<?php

		$oid = $_GET['orderid'];

		echo '
			<center id="ppp"> <h3>#'.$oid.' محل عبد الله عبيد السبيعي للدواجن <br/><hr/>
			</h3>الرقم الضريبي : 1234567890 <br/><hr/>
			<h4 style="border:solid 2px black ;"> فاتورة ضريبة مبسطة : مبيعات  </h4>
			';

			echo "</h3> التاريخ :  ".date("Y/m/d h:i:s");
		echo '<br/>جوال : 0569182212 س ت 2251497722 <hr/>
		<table width="90%" style="color: #000;">
		<tr>
			<th> المنتج </th>
			<th> الكمية </th>
			<th> السعر </th>
			<th> الاجمالي </th>
		</tr><tr>';

		$q = mysqli_query($conn,"SELECT * FROM `orders` WHERE `order_id` LIKE '$oid'");
		$sum = 0 ; 
				$sumall = 0 ; 

		while ($row = mysqli_fetch_array($q)) {

		$qo = mysqli_query($conn,"SELECT * FROM `orders` WHERE `order_id` LIKE '$oid'");
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


		$sum = $sum + $row['sumation'];
	
	

		$orderid = $orderidint ;
			
			echo '
			<td style="text-align:center;"> '.$row['product'].' </td>
			<td style="text-align:center;"> '.$row['qount'].' </td>
			<td style="text-align:center;"> '.$row['price'].' </td>
			<td style="text-align:center;"> '.$row['sumation'].' </td>
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
// $sumall = $sum - $discount;
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
		<td style="text-align:center;">  0  </td> 
		</tr>
		<tr>
		<td style="text-align:center;">المجموع بعد الخصم :  </td>
		<td>  </td>
		<td>  </td>
		<td style="text-align:center;"> '.$sum.'  </td> 
		</tr>
		<tr>
		<td>
		<img src="img/qr.jpg" style="width:100%;hight:100px;" />

		<hr/>
 
		<center>
			<b>... شكرا لزيارتكم ...</b>
		</center>

		</td>
		</tr>
		</tr></table><table width="90%" style="color: #000;"><tr><th>  </th>
			<th>  </th>
			<th>  </th>
			<th>    </th></tr></table><hr/></center><div class="p"></div>';

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
mysqli_query( $conn , "INSERT INTO orders ( order_id , product , qount , price , sumation , 	user_id , date ) SELECT '$orderid' , product , qount , price , total , $sid ,CURRENT_TIMESTAMP FROM cart");
mysqli_query( $conn , "TRUNCATE cart");
echo '<meta http-equiv="refresh" content="0;url=home.php?sucsess=0">';
?>
<script type="text/javascript">

}
</script>

</body>
</html>
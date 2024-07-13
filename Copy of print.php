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
	body{ margin: 0px;padding: 0px;}
	html{ margin: 0px;padding: 0px;zoom:70%;}
	#ppp{
		background-color: #fff;
		box-shadow: 2px 2px 5px black;
		border-radius: 0px;
		color: #000;
		page-break-after: always;
	/*	page-break-inside: */
		/*page-break-inside: avoid; */
	}
	h3{
		font-size: 20px;
	}
	th{
		font-size: 15px;
	}
</style>
<body onload="self.print();">
	<!-- <body> -->

	<?php 
	include('config.php');

	$orderid = 0;
	$orderidint = 0;

	  ?>  
	


		<?php

		$q = mysqli_query($conn,"SELECT * FROM `cart`");
		$sum = 0 ; 
		while ($row = mysqli_fetch_array($q)) {
			echo '
			<center id="ppp"><h3 style="text-decoration:underline;"> #البيت السوداني ';

	$qo = mysqli_query($conn,"SELECT * FROM `orders`");
		while ($rowo = mysqli_fetch_array($qo)) {
			$orderid = $rowo['order_id'];
			$orderidint = $rowo['order_id'];
		}
		if(isset($orderid)){
			$orderid ++ ; 
			$orderidint = $orderid ;
			$orderid = "#".$orderid;
			echo $orderid ;
		}else{
			$orderid = "#1" ; 
			$orderidint = "1" ;
			echo $orderid ;
		}

		$orderid = $orderidint ;
			echo '</h3><b style="text-decoration: underline;font-size:10px;"> التاريخ:'.date("Y/m/d").'</b>&nbsp;
			<b style="text-decoration: underline;font-size:10px;">الزمن:'.date("h:i:s").'</b>


			<table width="100%" style="color: #000;">
		<tr>
			<th> المنتج </th>
			<th> الكمية </th>
			<th> السعر </th>
			<th> الاجمالي </th>
		</tr><tr>
			<td style="text-align:center;font-size:15px;"> '.$row['product'].' </td>
			<td style="text-align:center;font-size:15px;"> '.$row['qount'].' </td>
			<td style="text-align:center;font-size:15px;"> '.$row['price'].' </td>
			<td style="text-align:center;font-size:15px;"> '.$row['total'].' </td>
		</tr></table><table width="90%" style="color: #000;"><tr><th>  </th>
			<th>  </th>
			<th>  </th>
			<th>    </th></tr></table><hr/></center>';
		}?>

	</body>
	</html>

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
<?php 
include('config.php');
session_start();
if(!isset($_SESSION['sname'])){
	echo '<meta http-equiv="refresh" content="0;url=index.php"';	
}

?>
<!DOCTYPE html>
<html dir="rtl">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title> صفحة الطباعة </title>
</head>
<style type="text/css">
	body {
	margin-bottom: 200px;
	}
	button{
		width: 150px;
		font-size: 20px;
	}
	#ppp{
		/*page-break-after: always;*/
		page-break-before: always;
		/*page-break-inside: avoid; */
	}
 	@media print {
 		html{
 			zoom:50%;
 		}
 		@page {


    size: auto;
    margin: 0;
			margin-bottom:200px;
		}

		body{
			margin-bottom:200px;
		}
    		.hidden-print,
   		 .hidden-print * {
        display: none !important;
  	  }

	}
}
</style>
<body onload="self.print();" onfocus="window.close();" >
<!-- 	<body> -->
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
			<center id="ppp" style="background-color: #fff;box-shadow: 2px 2px 5px black;padding: 5px;border-radius: 0px;color: #000;"><h3> البيت السوداني :';

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
			echo "<br/> التاريخ :  ".date("Y/m/d h:i:s");
			echo '</h3><hr/><table width="100%" style="color: #000;">
		<tr>
			<th> المنتج </th>
			<th> الكمية </th>
			<th> السعر </th>
			<th> الاجمالي </th>
		</tr><tr>
			<td style="text-align:center;"> '.$row['product'].' </td>
			<td style="text-align:center;"> '.$row['qount'].' </td>
			<td style="text-align:center;"> '.$row['price'].' </td>
			<td style="text-align:center;"> '.$row['total'].' </td>
		</tr></table><table width="90%" style="color: #000;"><tr><th>  </th>
			<th>  </th>
			<th>  </th>
			<th>    </th></tr></table><hr/></center>';


			////////////////////////new ffffffffffffaaaaaaaaaatttttttttttoooorrrrrrra

				echo '
			<center id="ppp" style="background-color: #fff;box-shadow: 2px 2px 5px black;padding: 5px;border-radius: 0px;color: #000;"><h3> البيت السوداني :#'.$orderid;
			echo " إستلام <br/> التاريخ :  ".date("Y/m/d h:i:s");
			echo '</h3><hr/><table width="100%" style="color: #000;">
		<tr>
			<th> المنتج </th>
			<th> الكمية </th>
			<th> السعر </th>
			<th> الاجمالي </th>
		</tr><tr>
			<td style="text-align:center;"> '.$row['product'].' </td>
			<td style="text-align:center;"> '.$row['qount'].' </td>
			<td style="text-align:center;"> '.$row['price'].'  </td>
			<td style="text-align:center;"> '.$row['total'].'  </td>
		</tr></table><table width="90%" style="color: #000;"><tr><th> </th>
			<th>  </th>
			<th>  </th>
			<th>    </th></tr></table><hr/></center>';

		}?>

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
//echo '<meta http-equiv="refresh" content="0;url=home.php?sucsess=0">';
?>
<script type="text/javascript">
}
</script>

</body>
</html>
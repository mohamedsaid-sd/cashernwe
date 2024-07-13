<?php
include('config.php');
session_start();
$sid = $_SESSION['sid'] ; 
$suser = $_SESSION['suser'] ; 
$sname = $_SESSION['sname'] ;
if(!isset($_SESSION['sname'])){
	echo '<meta http-equiv="refresh" content="0;url=index.php"';
}

if(isset($_GET['exit'])){
	session_unset();
	session_destroy();
		echo "<div id='alert_pad'> تم تسجيل الخروج بنجاح جاري إعادة توجيهك ... <img src='img/pass.png' width='20' height='20'></div>";
		echo '<meta http-equiv="refresh" content="2;url=index.php"';
}else{
// echo "<br/><br/><apn style='font-weight:bold;color:#000;font-size:20px;'> مرحبا بك : ".$sname."</span>";
}


if(isset($_GET['did'])){
	$id = $_GET['did'];
	$dq = mysqli_query( $conn , "DELETE FROM `cart` WHERE `cart`.`id` = $id");
	//if($dq)
	//echo "<div id='alert_good'>تمت إزالة العنصر بنجاح </div>";
}

// if(isset($_GET['countinue'])){
// $orderid = $_GET['orderid'];
// mysqli_query( $conn , "INSERT INTO orders ( order_id , product , qount , price , sumation , 	user_id , date ) SELECT '$orderid' , product , qount , price , total , $sid ,CURRENT_TIMESTAMP FROM cart");
// //echo '<meta http-equiv="refresh" content="0;url=print.php"';
// mysqli_query( $conn , "TRUNCATE cart");
// echo "<div id='alert_good'> إكتمل الطلب بنجاح <img src='img/pass.png' width='20' height='20'></div>";

// }

if(isset($_GET['cancel'])){
$orderid = $_GET['orderid'];
mysqli_query( $conn , "TRUNCATE cart");
//echo "<div id='alert_pad'> تم الغاء الطلب بنجاح <img src='img/pass.png' width='20' height='20'></div>";
}

// if(isset($_POST['btn_reorder'])){
// 	$id = $_POST['bill_no'];
	
// 	//$dq = mysqli_query( $conn , "DELETE FROM `orders` WHERE `orders`.`order_id` = $id");
// 	//if($dq)
// 	//echo "<div id='alert_good'>تمت إرجاع الفاتورة بنجاح</div>";
// }

if(isset($_GET['sucsess'])){
echo "<div id='alert_good'> إكتمل الطلب بنجاح <img src='img/pass.png' width='20' height='20'></div>";
}

if(isset($_POST['order'])){
	$name = $_POST['name'];
	$price = $_POST['price'];
	
	if($price == null || $name == null){
		echo "<div id='alert_pad'>الرجاء اختيار  عنصر <img src='img/fail.png' width='20' height='20'></div>";
	}else{
		$q = $_POST['quantity'];
		@$total = $q * $price;
		$flag = false ; 
		$edid = 0 ; 
		$qq = mysqli_query($conn,"SELECT * FROM `cart`");
		while ($qrow = mysqli_fetch_array($qq)) {
			if($qrow['product'] == $_POST['name']){
				$flag = true ;
				$edid = $qrow['id']; 
				$edqount = $qrow['qount']; 
			}
		}
	if($q == "0" || $q == ""){
		echo "<div id='alert_pad'>الرجاء إدخال الكمية المطلوبة <img src='img/fail.png' width='20' height='20'></div>";
	}elseif($name == ""){echo "<div id='alert_pad'>الرجاء إختيار الطلب <img src='img/fail.png' width='20' height='20'></div>";}else{
		if($flag == true){
			$qqount = $_POST['quantity'] + $edqount ; 
			$total = $qqount * $price ; 

			$eq = mysqli_query($conn , "UPDATE `cart` SET `qount` = '$qqount', `price` = '$price', `total` = '$total' WHERE `cart`.`id` = $edid;");
			if($eq){
 			//echo "<div id='alert_good'>تمت التعديل علي الفاتورة بنجاح <img src='img/pass.png' width='20' height='20'> </div>";
			}else{
			echo "<div id='alert_good'>خطأ في هملية اللإضافة <img src='img/pass.png' width='20' height='20'> </div>";
			}
		}else{
			$aq = mysqli_query($conn , "INSERT INTO `cart` (`id`, `product`, `qount`, `price`, `total`, `date`) VALUES (NULL, '$name', '$q', '$price', '$total', CURRENT_TIMESTAMP);");
			if($aq){
 			//echo "<div id='alert_good'>تمت اللإضافة للفاتورة بنجاح  </div>";
			}else{
			echo "<div id='alert_pad'>خطأ في عملية اللإضافة</div>";
			}
		}
	}
	}
}

?>
<!DOCTYPE html>
<html dir="rtl">
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title> الرئيسية </title>
</head>
     <script language="javascript" type="text/javascript">

      //Clock

 var timerID = null;
var timerRunning = false;
function stopclock (){
if(timerRunning)
clearTimeout(timerID);
timerRunning = false;
}
function showtime () {
var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = "" + ((hours >12) ? hours -12 :hours)
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
timeValue += (hours >= 12) ? " P.M" : " A.M"
document.clock.face.value = timeValue;
timerID = setTimeout("showtime()",1000);
timerRunning = true;
}
function startclock() {
stopclock();
showtime();
}
window.onload=startclock;

   //Clock
       
     </script>
<style type="text/css">
	input{
		
	}
	input[type=number]{
		padding: 10px;
		border-radius: 10px;
		text-align: center;
	}
	.welcome{
		font-size: 30px;
	}

</style>
<body>


<div id="casherRight">

<center style="background-color: rgb(120,77,42);color: #fff;padding: 5px;font-weight: bold;font-size: 17px;margin: 3px;">
    تصميم سمارت ديف البرمجية @ 2023 للتواصل واتس / مكالمات [ 24995712679+ ] البريد الالكترونى sudanit2015@gmail.com
</center>

<!-- *********************************Exit ****************************************************-->
	<a href="home.php?exit=0" style="float: right;"><img src="img/fail.png" width="30" height="20"><input style="color: #fff;background-color: red;font-size: 15px;" type="submit" value="خروج" /></a>


<br/>
<!-- *********************************Date ****************************************************-->
<div class="welocme" style="color: #000;">
			 <?php
			  	$Today = date('y:m:d');
                $new = date('l, F d, Y', strtotime($Today));
                echo  " التاريخ :  " .$new ;
?>
<!-- *********************************Time ****************************************************-->
	<img style="float: left;"  class="welocme" src="img/logo.jpg" width="300" height="150">

	<form class="welocme" style="color: #000;margin-right: 100px;width: 50%" name="clock" method="POST" action="#"> الساعة الآن :  <input type="submit" class="trans" name="face" value="" style="background-color: #eeeeee99;color: #000000aa; border:none"> </form>
<!-- *********************************Logo ****************************************************-->

<!-- *********************************Title ****************************************************-->
<!-- <h1 class="welocme" style="color:#000;color: #a12; text-shadow: 2px 2px 5px gray;font-size: 30px;">  الكاشير  </h1>  -->


<div id="all" style="text-align: right; float: left;" >
			

		

		<?php

if(isset($_POST['btn_reorder'])){
	echo '<div id="pr" style="background-color: #fff;box-shadow: 2px 2px 5px black;padding: 5px;border-radius: 0px;color: #000;;padding: 10px;margin: 5px;margin-top: 50px;">';
	echo "<div style='color:#000;'>";
	echo '<table width="90%" style="color: #000;">
	<tr>
	<th> الرقم </th>
	<th> المنتج </th>
	<th> الكمية </th>
	<th> السعر </th>
	<th> الاجمالي </th>
	<th> # </th>
	</tr>
	';
	$id = $_POST['bill_no'];
	$orders_count = 1 ; 
	echo "";
	$select_order = mysqli_query($conn,"SELECT * FROM `orders` WHERE `order_id` LIKE '$id' ORDER BY `id` DESC");
	while ($order_row = mysqli_fetch_array($select_order)) {
		echo "<tr>
			<th> # </th>
			<th>".$order_row['product']."</th> 
			<th>".$order_row['qount']."</th>
			<th>".$order_row['price']."</th>
			<th>".$order_row['sumation']."</th>
			<th> <a href='home.php?did=".$order_row['id']." style='text-decoration:none;'><font color='red'>X</font></a> </th>";
		$orders_count ++ ;
	}

	if($orders_count == 1){
		echo "<center> لا توجد فاتورة بهذا الرقم  </center>";
	}else{
			echo "<h4> إرتجاع الفاتورة رقم #".$id."</h4>";
	}
	echo "</table></div></div>";
	}
	?>
	<!-- <h2> الكاشير </h2> -->


<!-- 	<form style="display: inline;" action="home.php" method="post"><input type="number" name="bill_no" placeholder="أدخل رقم الفاتورة">
	<input style="background-color: red;color: #fff;border: 0px solid red;padding: 8px;" type="submit" value="مرتجع" name="btn_reorder" />
	<input type="number"  id="dis" name="dis" placeholder="ادخل الخصم">

</form> -->


	<br/>
	<?php
	include('config.php');
	
	
	
			$q2 = mysqli_query($conn,"SELECT * FROM `product` ");
			while ($row2 = mysqli_fetch_array($q2)) {
			$pid=$row2['id'];
			echo '<form style="display:inline;" action="home.php" method="post">
			
		<input hidden name="q" value="'.$row2['name'].'"/>

		<input style="background-color:rgb(120,77,42);" id="item" type="submit" value="'.$row2['name'].'" name="addtocard">

		<input hidden name="name" type="text" value="'.$row2['name'].'">
		<input  hidden name="price" style="width: 20px;text-align: center;" type="text" value="'.$row2['price'].'"></form>';
		
		}

			echo "";
		

	?>
	

</div>
</div>
</div>



<div id="casherLeft">

<form id="form" method="get" action="reorder.php">
<br/><b> في حالة إرجاع الفاتورة  </b><br/>
<input style="width: 85%;" placeholder="رقم الفاتورة" type="number" name="did" id='did'><br/>
<input style="color: #fff;background-color: rgb(192,31,47);font-size: 20px;width: 90%;" type="submit" value="مرتجع"/>  
</form>

	<?php
$buttons = [1,2,3,4,5,6,7,8,9,0,'C'];
$pressed = '';
if (isset($_POST['pressed']) && in_array($_POST['pressed'], $buttons)) {
    $pressed = $_POST['pressed'];
}
$stored = '';
if (isset($_POST['stored']) && preg_match('~^(?:[\d.]+[*/+-]?)+$~', $_POST['stored'], $out)) {
    $stored = $out[0];  
}
$display = $stored . $pressed;
//echo "$pressed & $stored & $display<br>";
if ($pressed == 'C') {
    $display = '';
} elseif ($pressed == '=' && preg_match('~^\d*\.?\d+(?:[*/+-]\d*\.?\d+)*$~', $stored)) {
    $display .= eval("return $stored;");
} 

echo '

<form id="form" method="post" action="home.php">
<br/><b>استخدام جهاز الباركود</b><br/>
<b></b> : 
<input style="padding:5px;font-size:30px;width:150px;" onload="this.focus()" type="text" name="barcode" autofocus placeholder="||||||||||||||||"  />
</form>';

if(isset($_POST['barcode'])){

	//*****************************************Scan the password

// Read The Barcode and add date to cart 
	$barcode = $_POST['barcode']; // the barcode value
	// get the detailse of spesific product 
	$counter = 1; 
	$select = mysqli_query( $conn , "SELECT * FROM `product` WHERE `barcode` LIKE '$barcode'");
	while ($row = mysqli_fetch_array($select)) {
	
	$name = $row['name'];
	$price = $row['price'];
	$flag = false ; 
	

	$edid = '0';
	$qq = mysqli_query($conn,"SELECT * FROM `cart`");
		while ($qrow = mysqli_fetch_array($qq)) {
			if($qrow['product'] == $name ){
				$flag = true ;
				$qount = $qrow['qount'];
				$edid = $qrow['id'];
			}
	}

	if($flag){
		$qount = $qount + 1 ; 
		$total = $qount * $price ; 
		$eq = mysqli_query($conn , "UPDATE `cart` SET `qount` = '$qount' , `total` = '$total' WHERE `cart`.`id` = $edid;");

	}else{

			$insert = mysqli_query( $conn , "INSERT INTO `cart` (`id`, `product`, `qount`, `price`, `total`, `date`) VALUES (NULL, '$name', '1', '$price', '$price', CURRENT_TIMESTAMP);");
	}





		$counter++;
	}
	if($counter == 1){
		echo "<div id='alert_pad'> لا يوجد منتج بهذا الرقم ! </div>";
	}
}

?>

<?php 

echo '<form id="form" method="post" action="">
<b>اضافة سريعة لمنتج غير موجود </b><br/>
<input style="width:100px;font-size:20px;" placeholder="اسم المنتج" name="name" type="text" value="" />

<input  style="width:70px;font-size:25px;" type="number" placeholder="السعر" name="price" value=""/>

<input style="width:70px;font-size:25px;" type="number" name="quantity"  placeholder="كميه" value="';
 if($display <= 999)
    {
    	echo $display;
    }else{
    	echo "0";
    }

echo '">';

	
	echo "</b>";
echo '	
<button type="submit" name="order" style="background-color:rgb(244,150,28);color;#fff;width:90%;font-size:25px;"><font color="white"> اضافه صنف  </font> </button>	
</form>';

echo '<form id="form" method="post" action="">
<b> المنتج قبل الاضافة للفاتورة </b><br/>
<input hidden  style="width:50px;" type="text" name="name" value="';
if(isset($_POST['q']) || isset($_POST['pressed'])) {
	echo $_POST['name'];
}else{
	echo "";
}
echo'"> 
<input hidden style="width:100px;" type="text" name="price" value="';
if(isset($_POST['q']) || isset($_POST['pressed'])) {
	echo $_POST['price'];
}else{
	echo "";
}
echo '">' ;
echo '<input style="width:155px;font-size:20px;" type="text" value="'.@$_POST['name'].' '.@$_POST['price'].'" disabled="true"/>
الكمية
<input style="width:50px;font-size:25px;margin-right:10px;margin-left:10px;" type="number" name="quantity"  placeholder="0" value="1';

 if($display <= 999)
    {
    	echo $display;
    }else{
    	echo "0";
    }

echo '">';

	
	echo "</b>";
echo '	
<button type="submit" name="order" style="background-color:rgb(244,150,28);color;#fff;width:90%;font-size:25px;"><font color="white"> إضافة للفاتورة </font> </button>	
</form>';

 ?>

</div>



</tr>


<center style="">



<div id="pr" style="box-shadow: 1px 1px 3px black;padding: 5px;border-radius: 0px;color: #000;width:48%;float: left;padding: 5px;margin: 5px;">

	<!-- <center><h2> إجمالي اليوم :  <?php

	$q = mysqli_query( $conn , "SELECT * FROM `orders` where user_id = $sid and DATE(date) = DATE(NOW())");
	$sum = 0;
	while ($n = mysqli_fetch_array($q)) {
		$sum = $sum + $n['sumation'];	
	}
	echo $sum ;
	 ?></h2></center> -->

<center>

	<?php

	if(!isset($_GET['exit'])){
		echo "<b>وردية : ".$sname."" ;
	}

	 ?>

	<h4> الفاتورة رقم :  <?php 

	$orderid = 0;
	$orderidint = 0;
	
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

	  ?>

 <b style="display: inline;"><?php echo " التاريخ :  ".date("Y/m/d")." الزمن : ".date("h:i:s"); ?></b></h4> <hr/>
	
<table width="90%" style="color: #000;">
		<tr>
			<th> #الرقم </th>
			<th> المنتج </th>
			<th> الكمية </th>
			<th> السعر </th>
			<th> الاجمالي </th>
			<th> حذف </th>
		</tr>


		<?php

		$q = mysqli_query($conn,"SELECT * FROM `cart`");
		$i = 1 ; 
		$sum = 0 ; 
		while ($row = mysqli_fetch_array($q)) {

			$sum = $sum + $row['total'] ; 

			echo '<tr>
			<th> '.$i.' </th>
			<th> '.$row['product'].' </th>
			<th> '.$row['qount'].' </th>
			<th> '.$row['price'].' </th>
			<th> '.$row['total'].' </th>
			<th> <a href="home.php?did='.$row['id'].'" style="text-decoration:none;"><font color="red" style="font-size:20px;">X</font></a> </th>
		</tr>';

		$i++;

		}

			?>
	</table>

	<hr/>

	<table width="90%" style="color: #000;">
		<tr>
			<th> المجموع </th>
			<th>  </th>
			<th>  </th>
			<th> <?php echo $sum."  "; ?> </th>
		</tr>
	</table>

	<hr/>

</center>

<center style="padding: 15px;font-size: 21px;width: 100%;">

	<?php 
	$q = mysqli_query($conn,"SELECT * FROM `cart`");
	$n = mysqli_num_rows($q);
	

	if($n > 0){
	?>

<form id="formbuy" method="get" action="print.php?countinue=1&&orderid=<?php echo $orderid; ?>" style="background-color: #eee;padding: 5px;font-size:30px;">
		 النادل : <select name="waiter" style="font-size:20px;font-weight: bold;padding:8px;border-radius:15px ;margin-left:50px;">
		<option value="0"> الكاشير ( انا ) </option>
		<?php
			include('../config.php');
			$q = mysqli_query($conn,"SELECT * FROM `waiter`");
			while ($row = mysqli_fetch_array($q)) {
		?>
		<option value="<?php echo $row['id']; ; ?>"> <?php echo $row['name']; ?> </option>
		<?php } ?> 
	</select>
		 خصم : <input style="width: 50px;padding: 8px;font-weight: bold;font-size: 20px;" type="number" name="dis" placeholder="0" value="0"  /> 
		<button style="background-color: green;color: #fff;padding: 15px; font-size:20px;"> شراء Buy  </button>
	
		<a href="home.php?cancel=1&&orderid=
	<?php echo $orderid; ?>" style="background-color: rgb(192,31,47);padding: 10px;text-decoration: none;color: #fff;border-radius: 10px;font-size: 20px;font-weight: bold;"> الغاء Cancel </button></a>

</form>
	
	
<?php }else{} ?>

</center>

</div>

</center>




<script type="text/javascript">


	document.onkeydown= function(){
		if(window.event.keyCode=='32'){
			document.getElementById('formbuy').submit();
		}
	}

	function printp() {
		var prtcontent = document.getElementById("pr");
		var WinPrint = window.open('','','right=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write('<!DOCTYPE html><html dir="rtl">');
		WinPrint.document.write('<h1 align="center"> ISMA3EL TAGA </h1>');
		WinPrint.document.write(prtcontent.innerHTML);
		WinPrint.document.colse();
		WinPrint.focus();
		WinPrint.print();
		window.print();
	
	}

</script>

</body>
</html>
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


if(isset($_GET['delat'])){
	$id = $_GET['delat'];
	$did = $_GET['did'];
	$sum = $_GET['sum'];

	$qu = mysqli_query( $conn , "DELETE FROM `orders` WHERE `orders`.`id` = $id");


	$dq = mysqli_query( $conn , "UPDATE orders set total = orders.total - $sum where orders.order_id = $did ; ");

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

if(isset($_GET['cancel']) && isset($_GET['orderid'])){
$id = $_GET['did'];
$result = mysqli_query( $conn , "DELETE  FROM `orders` WHERE `orders`.`order_id` = $id");
if($result)
echo "<div id='alert_pad'> تم ارجاع الفاتورة بنجاح <img src='img/pass.png' width='20' height='20'></div>";
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
	body{
		padding: 0px;
		margin: 0px;
		margin-top : 20px; 
		text-align: center;
		background-size: 100%;
		font-size: 20px;
	}
	button{
		color: #000;
		font-size: 18px;
		padding: 10px;
		box-shadow: 2px 2px 2px black;
	}
	input[type=number]{
		padding: 10px;
		border-radius: 10px;
		text-align: center;
	}
</style>
<body>
		<div class="welocme" style="float: left;color: #000;margin-left: 100px;">
			 <?php
			  	$Today = date('y:m:d');
                $new = date('l, F d, Y', strtotime($Today));
                echo  " التاريخ :  " .$new ;
			 ?>
			</div>
<img src="img/home.png" width="150" style="float: right;">
	<form style="float: right;color: #000;margin-right: 100px;" name="clock" method="POST" action="#"> الساعة الآن :  <input type="submit" class="trans" name="face" value="" style="background-color: #eeeeee99;color: #000000aa; border:none"> </form>
 
<h1 style="color:#000;color: #a12; text-shadow: 2px 2px 5px gray;font-size: 50px;">  الكاشير  </h1> 

	<center style="clear: both;">

	<div id="all" style="text-align: right; float: left;width:50%;float: right;margin-right: 20px;" >
		
			<a href="home.php?exit=0"><img src="img/fail.png" width="30" height="20"><input style="color: #fff;background-color: red;" type="submit" value="خروج" /></a>
		
			<form method="get" action="reorder.php">
			<input type="number" name="did" id='did'>
			<button style="background-color: red;color: #fff;"> مرتجع </button>
		</form>

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
			<select hidden onchange="this.form.submit();" name="q" style="color:#fff;background-color:#19a;text-align: center;padding:3px;margin:5px;font-weight: bold;border-radius:10px;font-size:20px;">
			<option value="0">'.$row2['name'].'</option>
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
			<option>6</option>
			<option>7</option>
			<option>8</option>
			<option>9</option>
			<option>10</option>
			</select>

			<input style="color:#eee;background-color:#678;text-align: center;padding:8px;margin:5px;font-weight: bold;border-radius:10px;font-size:25px;width:170px;border:2px solid black;box-shadow: 2px 2px 5px black;" type="submit" value="'.$row2['name'].'" name="addtocard">

			 <input  hidden name="name" style="width: 20px;text-align: center;" type="text" value="'.$row2['name'].'"><input  hidden name="price" style="width: 20px;text-align: center;" type="text" value="'.$row2['price'].'"></form>';
			}

			echo "";
		

	?>
	

</div>

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

echo "<div id='calculator' style='text-align:center;width:40%;float:right;border-radius:10px;background-color:#eee;padding:10px;'>";

echo "<form dir='ltr' action='' method='POST'";

echo "<input disabled='true' style='width:150px;color:#000;font-weight:bold;font-size:18px;' type='text' name='name' value='";
if(isset($_POST['q']) || isset($_POST['pressed'])) {
	echo $_POST['name'].' '.$_POST['price'];
}else{
	echo "";
}
echo "'>";

echo "<input hidden  style='width:100px;' type='text' name='name' value='";
if(isset($_POST['q']) || isset($_POST['pressed'])) {
	echo $_POST['name'];
}else{
	echo "";
}
echo "'>";

echo "<input hidden style='width:100px;' type='text' name='price' value='";
if(isset($_POST['q']) || isset($_POST['pressed'])) {
	echo $_POST['price'];
}else{
	echo "";
}
echo "'>";

        foreach (array_chunk($buttons, 3) as $chunk) {
                foreach ($chunk as $button) {
                	if($button == '0'){
                		//echo "<td",(count($chunk) != 4 ? " colspan=\"4\"" : "") , "><button style='padding:20px;font-size:20px;color:#000;' name=\"pressed\" value=\"$button\">$button</button></td>";
                	}elseif ($button == 'C'){
                		//echo "<td",(count($chunk) != 4 ? " colspan=\"4\"" : "") , "><button style='padding:20px;font-size:25px;background-color:red;color:#fff;' name=\"pressed\" value=\"$button\">$button</button>";
                	}else{
                    //echo "<td",(count($chunk) != 4 ? " colspan=\"4\"" : "") , "><button style='padding:20px;font-size:25px;color:#a12;' name=\"pressed\" value=\"$button\">$button</button></td>";
                	}
                }
            echo "";
        }

    echo "<input hidden style='width:100px;' type='text' value='".$display."'>";  

    echo "<input style='float:left;width:100px;color:#000;font-weight:bold;font-size:18px;' type='number' value='";
    if($display <= 999)
    {
    	echo $display;
    }else{
    	echo "0";
    }
    echo "' hidden='true'> <b style='color:#111;'>";

    echo "<input type='hidden' name='stored' value='$display'>";
echo "</form>";

echo '<form method="post" action="" style="margin:0px;padding:0px;">
<input hidden  style="width:100px;" type="text" name="name" value="';
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
echo'">

<input style="width:150px;font-size:20px;" type="text" value="'.$_POST['name'].'" />
الكمية
<input style="width:70px;font-size:25px;" type="number" name="quantity"  placeholder="0" value="';
 if($display <= 999)
    {
    	echo $display;
    }else{
    	echo "0";
    }

echo '">';

	
	echo "</b>";
echo '	
<button type="submit" name="order" style="background-color:#678;color;#fff;width:150px;float:left"><font color="white"> إضافة للفاتورة </font> </button>	
</form>';





?>

<?php 

echo '<form method="post" action="">
<input style="width:100px;font-size:20px;" placeholder="اسم المنتج" name="name" type="text" value="" />

<input  style="width:70px;font-size:25px;" type="number" placeholder="السعر" name="price" value=""/>;

<input style="width:70px;font-size:25px;" type="number" name="quantity"  placeholder="0" value="';
 if($display <= 999)
    {
    	echo $display;
    }else{
    	echo "0";
    }

echo '">';

	
	echo "</b>";
echo '	
<button type="submit" name="order" style="background-color:#678;color;#fff;width:150px;float:left"><font color="white"> اضافه صنف بالجرام</font> </button>	
</form></div>';




 ?>
<div id="pr" style="background-color: #fff;box-shadow: 2px 2px 5px black;padding: 5px;border-radius: 0px;color: #000;width:40%;float: right;padding: 10px;margin: 5px;margin-top: 50px;">

	<!-- <center><h2> إجمالي اليوم :  <?php

	$q = mysqli_query( $conn , "SELECT * FROM `orders` where user_id = $sid and DATE(date) = DATE(NOW())");
	$sum = 0;
	while ($n = mysqli_fetch_array($q)) {
		$sum = $sum + $n['sumation'];	
	}
	echo $sum ;
	 ?></h2></center> -->

<center >

	<?php

	if(!isset($_GET['exit'])){
		echo "وردية : ".$sname."" ;
	}

	 ?>

	<h4> الفاتورة رقم :  <?php 
		$id = $_GET['did'];
	echo "#".$id;

	$orderid = 0;
	$orderidint = 0;
	


		$orderid = $id ;

	  ?> <br/> <b style="display: inline;"><?php echo " التاريخ :  ".date("Y/m/d")." الزمن : ".date("h:i:s"); ?></b></h4> <hr/>
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
		$id = $_GET['did'];

		$q = mysqli_query($conn,"SELECT * FROM `orders` WHERE `order_id` LIKE '$id' ORDER BY `id` DESC");
		$i = 1 ; 
		$sum = 0 ; 
		$total = 0 ;
		while ($row = mysqli_fetch_array($q)) {

			$sum = $sum + $row['sumation'] ; 
			$total = $row['total'];

			echo '<tr>
			<th> '.$i.' </th>
			<th> '.$row['product'].' </th>
			<th> '.$row['qount'].' </th>
			<th> '.$row['price'].' </th>
			<th> '.$row['sumation'].' </th>
			<th> <a href="reorder.php?delat='.$row['id'].'&&did='.$id.'&&sum='.$row['sumation'].'" style="text-decoration:none;"><font color="red">X</font></a> </th>
		</tr>';

		$i++;

		}

		if($i == 1){
			echo "<tr> <th colspan='6' style='text-align:center;color:red;'> لا توجد فاتورة بهذا الرقم </th></tr>";
		}

			?>
	</table>

	<hr/>

	<table width="90%" style="color: #000;">
		<tr>
			<th> المجموع </th>
			<th> <?php echo $sum." ريال "; ?> </th>
			<th> بعد الخصم :  <?php echo $total." ريال "; ?> </th>
			<th>  الخصم :  <?php echo $sum - $total." ريال"; ?> </th>
		</tr>
	</table>

	<hr/>

</center>

	<center style="padding: 15px;font-size: 21px;">
	<?php 
	$q = mysqli_query($conn,"SELECT * FROM `orders` WHERE `order_id` LIKE '$id'");
	$n = mysqli_num_rows($q);
	

	if($n > 0){
	?>


	<a href="printbillno.php?countinue=1&&orderid=
	<?php echo $orderid; ?>"><button style="background-color: green;color: #fff;padding: 15px;"> طباعة Print </button></a>

	
		<a href="reorder.php?cancel=1&&orderid=
	<?php echo $orderid; ?>&&did=<?php echo $_GET['did'] ?>"><button style="background-color: red;color: #fff;padding: 15px;"> ارجاع </button></a>
	<?php }else{} ?>
	</center>
	
</div>

</center>



<script type="text/javascript">
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
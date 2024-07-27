<?php
session_start();
$sid = $_SESSION['sid'] ; 
if(!isset($_SESSION['sid'])){
	echo '<meta http-equiv="refresh" content="0;url=index.php"';
}

if(isset($_GET['exit'])){
	session_unset();
	session_destroy();
		echo "<div id='alert_pad'> تم تسجيل الخروج بنجاح جاري إعادة توجيهك ... <img src='../img/pass.png' width='20' height='20'>";
		echo '<meta http-equiv="refresh" content="3;url=index.php"';
}

?>
<!DOCTYPE html>
<html dir="rtl">
<head>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<title> الرئيسية </title>
</head>
<body >

<img src="../img/logo.jpg" width="500" height="500" style="margin: 50px;float: left;margin-left: 200px;">
<center style="float: left;width: 250px;margin-top: 150px;">
	<h1 style="color: #333;"> الرئيسية </h1>
	<a href="add_cat.php"><button class="btn"> الأقسام </button></a><br/>
	<a href="add_product.php"><button class="btn">  المنتجات </button></a><br/>
	<a href="add_user.php"><button class="btn">  المستخدمين </button></a><br/>
	<a href="add_waiter.php"><button class="btn"> الويتيرس </button></a><br/>
	<a href="add_present.php"><button class="btn">  النسبة </button></a><br/>
	<a href="reports.php"><button class="btn">  التقارير </button></a><br/>
	<a href="home.php?exit=0"><button class="btn"> خروج </button></a>
	<br/>
</center>

<!-- Add the page footer Copy @ right  -->
<?php include 'footer.php'; ?>

</body>
</html>
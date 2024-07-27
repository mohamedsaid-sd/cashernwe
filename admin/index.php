<?php 
include('../config.php');

if(isset($_POST['login']))
{
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	
	$q = mysqli_query($conn,"SELECT * FROM `admins` WHERE `user` = '$user' AND `pass` = '$pass'");
	$row = mysqli_fetch_array($q);
	$count = mysqli_num_rows($q);
	if($count == 1){
		echo "<div id='alert_good'> تم تسجيل الدخول بنجاح جاري إعادة توجيهك ... <img src='../img/pass.png' width='20' height='20'></div>";
		echo '<meta http-equiv="refresh" content="3;url=home.php"';
		session_start();
		$_SESSION['sid'] = "0" ;
	}else{
		echo "<div id='alert_pad'> خطأ في تسجيل الدخول <img src='../img/fail.png' width='20' height='20'></div>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<title> إدارة المطعم </title>
</head>
<body>
	<style type="text/css">
		body{
			padding: 0px;
			margin: 0px;
		}
		button{
		width: 150px;
		font-size: 25px;
	}
	input[type=text],input[type=password]{
		font-size: 25px;
	}
	</style>

<br/><br/><br/>
<br/>
<?php include 'header.php'; ?>
<center style="padding: 20px;">



	<form action="index.php" method="post" style="color : #000;">

		<h1 style="color:#000;color: #a12; text-shadow: 2px 2px 5px gray;font-size: 50px;">  إدارة المحل  </h1>

		<b> إسم المستخدم </b><br/>
		<input type="text" name="user" placeholder="إسم المستخدم" /><br/>
		<b> كلمة المرور </b><br/>
		<input type="password" name="pass" placeholder="كلمة المرور" /><br/><br/>
		<input style="background-color: green;padding: 10px;color: #fff;border: none;font-size: 25px;width: 100px;" type="submit" name="login" value="دخول" /><br/>
	</form>
</center>

<br/><br/><br/><br/>

<center >
		انتقل الي <a style="color:#a15;font-weight: bold;font-size: 20px;" href="../index.php"> الكاشير </a>
	<br/><br/>
	<br/><br/>
</center>

<?php include 'footer.php'; ?>
</body>
</html>
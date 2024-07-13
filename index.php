<?php
include('config.php');
if(isset($_POST['login'])){
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	
	$q = mysqli_query($conn,"SELECT * FROM `users` WHERE `username` = '$user' AND `pass` = '$pass'");
	$row = mysqli_fetch_array($q);
	$count = mysqli_num_rows($q);
	if($count == 1){
		echo "<div id='alert_good'> تم تسجيل الدخول بنجاح جاري إعادة توجيهك ... <img src='img/pass.png' width='20' height='20'></div>";
		echo '<meta http-equiv="refresh" content="3;url=home.php"';
		session_start();
		$_SESSION['sid'] = $row['id'] ;
		$_SESSION['suser'] = $user ;
		$_SESSION['sname'] = $row['name'];
		$_SESSION['spss'] = $pass ;

	}else{
		echo "<div id='alert_pad'> خطأ في تسجيل الدخول <img src='img/fail.png' width='20' height='20'> </div>";
	}

}

?>

<!DOCTYPE html>
<html dir="rtl">
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title> شاشة تسجيل الدخول  </title>
</head>
<style type="text/css">
	body{
		padding: 0px;
		margin: 0px;
		background-color: #fff;
	}
	button{
		width: 150px;
		font-size: 25px;
	}
	input[type=text],input[type=password]{
		font-size: 25px;
	}
</style>
<body>
<?php include('config.php'); ?>
<center>
	<h1 style="color:#000;color: #a12; text-shadow: 2px 2px 5px gray;font-size: 50px;">  نظام ادارة الكاشير Casher </h1>
	

	<img src="img/login.png" width="450" height="320" style="margin: 50px;">

	<form action="index.php" method="post" style="float: right;margin-right:300px;margin-top: 100px;">
	
		<b> إسم المستخدم </b><br/>
		<input type="text" name="user" placeholder="ادخل إسم المستخدم" /><br/>
		<b> كلمة المرور </b><br/>
		<input type="password" name="pass" placeholder="ادخل كلمة المرور" /><br/><br/>
		<input style="background-color: green;padding: 10px;color: #fff;border: none;width: 100px;font-size: 25px;" type="submit" name="login" value="دخول" />
		<input style="background-color: red;padding: 10px;color: #fff;border: none;width: 100px;border-radius: 10px;font-size: 25px;" type="reset" name="" value="الغاء">
		<br/>
	</form>
</center>
<br/><br/>

<center>

	إنتقل الي <a style="color:#a12;font-weight: bold;font-size: 20px;" href="admin/index.php"> <img src="img/manage.png" width="20" height="20"> الإدارة </a>

	<br/><br/>
	<br/><br/>
	<br/><br/>
</center>

<?php include 'admin/footer.php'; ?>

</body>
</html>
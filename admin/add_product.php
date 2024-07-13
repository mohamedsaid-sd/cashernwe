<?php
include('../config.php');
session_start();
$sid = $_SESSION['sid'] ; 
if(!isset($_SESSION['sid'])){
	echo '<meta http-equiv="refresh" content="0;url=index.php"';
}
if(isset($_POST['aproduct'])){
 $barcode = $_POST['barcode'];
 $name = $_POST['name'] ;
 $price = $_POST['price'] ;

if($name != "")
{
$aq = mysqli_query($conn , "INSERT INTO `product` (`id` , `barcode` , `name`, `price`) VALUES (NULL, '$barcode' , '$name', '$price');");
if($aq){
 	echo "<div id='alert_good'>تمت اللإضافة بنجاح</div>";
}else{
	echo "<div id='alert_pad'>خطأ في عملية اللإضافة</div>";
}
}else{
	echo "<div id='alert_pad'>الرجاء ملء الحقول اولا</div>";
}
}

// Edite the Product button click 
if(isset($_POST['eproduct'])){

	$id = $_POST['id'];
	$name = $_POST['name'];
	$price = $_POST['price'];

	$aq = mysqli_query($conn , "UPDATE `product` SET `name` = '$name', `price` = '$price' WHERE `product`.`id` = $id;");

	if($aq){
 	echo "<div id='alert_good'>تمت التعديل بنجاح</div>";
	}else{
	echo "<div id='alert_pad'>خطأ في عملية التعديل</div>";
	}
}

if(isset($_GET['did'])){
	$id = $_GET['did'];
	$result = mysqli_query($conn,"DELETE FROM `product` WHERE `product`.`id` = $id");
	if($result){
		echo "<div id='alert_good'>تمت الحذف بنجاح</div>";
	}else{
		echo "<div id='alert_pad'>خطأ في عملية الحذف</div>";
	}
}


?>
<!DOCTYPE html>
<html dir="rtl">
<head>
	
	<title> إضافة منتج </title>
	
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>

	<!-- Call Bootstrab -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<!-- Call Style File -->
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<!-- Call bootstrab-->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<!-- Call Jquery -->
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	
	<!-- Call the datatable fies -->
	<!-- Datatable style -->
	<link rel="stylesheet" type="text/css" href="css/datatable.css"/>
	<!-- Datatable Button style -->	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
	<!-- Datatable script -->
	<script type="text/javascript" src="js/datatable.js"></script>
	
</head>

<style type="text/css">
	body , button , input[type=submit] , input[type=number] {
		font-size: 25px;
	}
	input[type=number] {
		width: 210px;
		padding: 5px;
		text-align: center;
		border-radius: 10px;
		font-size: 20px;
	}
</style>
<script type="text/javascript">

$(document).ready(function() {

	var date = new Date();
	var day = date.getDate();
	var month = date.getMonth() + 1;
	var year = date.getFullYear();

	var today = day+"-"+month+"-"+year;

$('#example tfoot th').each(function () {
    var title = $(this).text();
    if ($(this)[0].className === "text_search") {
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    }
});


$('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
        {
           extend: 'csv',
           charset: 'UTF-8',
            bom: true,
            filename: 'Sarmada'+today,
        },
                'copy', 'print' ,
            {
                extend: 'colvis',
                postfixButtons: [ 'colvisRestore' ]
            }
        ],
        columnDefs: [
            {
                targets: -1,
                visible: false
            }
        ],

   initComplete: function () {
   		 var r = $('#example tfoot tr');
  		r.find('th').each(function(){
    	$(this).css('padding', 8);
  		});
  		$('#example thead').append(r);
  		$('#search_0').css('text-align', 'center');

        this.api()
            .columns()
            .every(function () {
                let column = this;
                let title = column.footer().textContent;
 
                // Create input element
                let input = document.createElement('input');
                input.placeholder = title;
                column.footer().replaceChildren(input);
 
                // Event listener for user input
                input.addEventListener('keyup', () => {
                    if (column.search() !== this.value) {
                        column.search(input.value).draw();
                    }
                });
            });
    }
    });

});

</script>
<body style="font-size: 25px;">

	<br/>

	<center id="sectionLeft">

			<table id="example" class="display" style="width:100%" style="background-color: #fff;box-shadow: 2px 2px 5px black;padding: 5px;border-radius: 0px;color: #000;" width="100%">
			<thead>
			<tr>
				<th> # </th>
				<th style="text-align: center;"> الباركود </th>
				<th style="text-align: center;"> اسم المنتج </th>
				<th style="text-align: center;"> سعر المنتج </th>
				<th style="text-align: center;"> الاجراء </th>
				<th></th>
			</tr>
			</thead>
		<?php

		$q = mysqli_query($conn,"SELECT * FROM `product`");
		$i = 1 ;
		while ($row = mysqli_fetch_array($q)) {
		
			$alert = '" هل تريد حذف المنتج  ? "';

			echo "<tr>
				<th style='text-align: center;'> ".$i." </th>
				<th style='text-align: center;'> ".$row['barcode']." </th>
				<th style='text-align: center;'> ".$row['name']." </th>
				<th style='text-align: center;'> ".$row['price']." </th>
				<th style='text-align: center;'> <a href='add_product.php?edid=".$row['id']."'> <button> تعديل </button></a> <a href='add_product.php?did=".$row['id']."'><button style='background-color:rgb(192,31,47);color:#fff;font-weight:normal;' onclick='return confirm(".$alert.")'> حذف </button></a> </th>
				<td> </td>
			</tr>
			";
			$i++;
		}
		?>
		</table>
		</center>

	<center id="sectionRight">

		<a href="home.php"><img src="../img/fail.png" width="30" height="20"><input style="color: #fff;background-color:rgb(192,31,47);" type="submit" value="رجوع" /></a>

		<?php
		if(isset($_GET['edid']))
		{
		$id = $_GET['edid'] ; 
		$q = mysqli_query($conn,"SELECT * FROM `product` where id = $id ");
		while ($row = mysqli_fetch_array($q)) {
		 ?>

		<form action="add_product.php" method="post">
		<h2><b> تعديل منتج </b></h2>
		<input hidden type="text" placeholder="إسم المنمتج" name="id" value="<?php echo $row['id'] ?>" />
		<input type="text" placeholder="إسم المنمتج" name="name" value="<?php echo $row['name'] ?>" /><br/><br/>
		<input type="number" placeholder="سعر المنتج" name="price" value="<?php echo $row['price'] ?>" /><br/><br/>
	
		<br/>


		<input style="background-color: green;color: #fff;border: none;padding: 10px;" type="submit" name="eproduct" value="تعديل" /><br/><br/>
		</form>

		<?php } }else{ ?>

		<form action="" method="post">
		<h2> إضافة منتج جديد </h2>
		<span style="color:#bbb;font-weight: bold;font-size: 15px;">* امسح رمز المنتج </span><br/>
		<input style="width: 100%" type="number" name="barcode" placeholder="الباركود"/><br/>
		<input style="width: 100%" type="text" placeholder="إسم المنمتج" name="name"/><br/>
		<input style="width: 100%" type="number" step="0.01" placeholder="سعر المنتج" name="price"/><br/><br/>
		<input style="background-color: green;color: #fff;border: none;padding: 10px;" type="submit" name="aproduct" value="إضافة" /><br/>
		</form>
		<?php } ?>
	</center>
	
	<div style="clear: both;"></div>
	<br/><br/>

<?php include 'footer.php'; ?>
</body>
</html>
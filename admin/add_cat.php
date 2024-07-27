<?php
include('../config.php');
session_start();
$sid = $_SESSION['sid'] ; 
if(!isset($_SESSION['sid'])){
	echo '<meta http-equiv="refresh" content="0;url=index.php"';
}
if(isset($_POST['insert'])){
 $name = $_POST['name'] ;
//  $phone = $_POST['phone'] ;
if($name != "")
{
$insert_quesry = mysqli_query($conn , "INSERT INTO `departments` (`id`, `department`) VALUES (NULL, '$name');");
if($insert_quesry){
 	echo "<div id='alert_good'>تمت اللإضافة بنجاح</div>";
}else{
	echo "<div id='alert_pad'>خطأ في هملية اللإضافة</div>";
}
}else{
	echo "<div id='alert_pad'>الرجاء ملء الحقول اولا</div>";
}
}

// Edite the user button click 
if(isset($_POST['edite'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$edite_query = "UPDATE `departments` SET `department` = '$name' WHERE `departments`.`id` = $id;";
	$result = mysqli_query($conn,$edite_query);
	if($result){
 	echo "<div id='alert_good'>تمت التعديل بنجاح</div>";
	}else{
	echo "<div id='alert_pad'>خطأ في عملية التعديل</div>";
	}
}

// Delete the department
if(isset($_GET['del'])){
	$id = $_GET['del'];
	$delete_query = "DELETE FROM `departments` WHERE `departments`.`id` = $id";
	$result = mysqli_query($conn , $delete_query);
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
	<title> الاقسام </title>


	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>

	<!-- Call Bootstrab -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>

	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<!-- Call Style File -->
	<link rel="stylesheet" type="text/css" href="css/style.css"/>

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
		body , button , input[type=submit]{
		font-size: 25px;
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

<body>


		<br/>

		<center id="sectionLeft">
		<h2> اقسام المطعم  </h2>

		<table id="example" class="display" style="background-color: #fff;box-shadow: 2px 2px 5px black;border-radius: 0px;color: #000;" width="100%" >
			<tr>
				<th style="font-size: 20px;text-align: center;"> #الرقم </th>
				<th style="font-size: 20px;text-align: center;"> القسم </th>
				<th style="font-size: 20px;text-align: center;"> الاجراء </th>
			</tr>
		<?php

		$q = mysqli_query($conn,"SELECT * FROM `departments`");
		$i = 1 ;
		while ($row = mysqli_fetch_array($q)) {
			$alert = '" هل تريد حذف القسم  ? "';
			echo "<tr>
				<th style='text-align: center;'> ".$i."</th>
				<th style='text-align: center;'> ".$row['department']."</th>
				<th style='text-align: center;'><a href='add_cat.php?edid=".$row['id']."'> <button> تعديل </button></a> <a href='add_cat.php?del=".$row['id']."'><button onclick='return confirm(".$alert.")' style='background-color:rgb(192,31,47);font-weight: normal;color:#fff;'> حذف </button></a> </th>
			</tr>
			";
			$i++;
		}
		?>
		</table>
	</center>

	<center id="sectionRight">

		<h2>  إضافة قسم جديد  </h2>

		<a href="home.php"><img src="../img/fail.png" width="30" height="20"><input style="color: #fff;background-color: rgb(192,31,47);" type="submit" value="رجوع" /></a>


		<?php 

		if(isset($_GET['edid']))
		{
		$id = $_GET['edid'] ; 
		$q = mysqli_query($conn,"SELECT * FROM `departments` where id = $id ");
		while ($row = mysqli_fetch_array($q)) {
		 ?>
		<form action="add_cat.php" method="post">
		<h2 style="color: #000;"> تعديل قسم  </h2>
		<input hidden type="text" placeholder="أدخل إسم التصنيف" name="id" value="<?php echo $row['id']; ?>" />
		<input type="text" placeholder=" الأسم " name="name" value="<?php echo $row['department']; ?>"/><br/>
		<input style="background-color: green;color: #fff;border: none;padding: 10px;" type="submit" name="edite" value="تعديل" /><br/><br/>
		</form>
		<?php }} else { ?>
		<form action="add_cat.php" method="post">
		
		<br/>
		<input type="text" placeholder=" الإسم " name="name"/><br/>
		<input style="background-color: green;color: #fff;border: none;padding: 10px;" type="submit" name="insert" value="إضافة" /><br/>
		</form>

		<?php } ?>

	</center>


<?php include 'footer.php'; ?>
</body>
</html>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<form  method="post">
<input type="date"  name="day">
<input type="submit" name="date">
</form>

<?php 
	if(isset($_POST['date'])){
		$day=$_POST['day'];
		$day= strtotime($day).'<br>';
	 	$today=date("Y-m-d");
		$today= strtotime($today).'<br>';
		$remin=$day-$today;
		$numberDays = $remin/86400;
		echo 'remine '.$numberDays;
	}
?>
<body>
</body>
</html>
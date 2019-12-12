<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Документ без названия</title>
<style type="text/css">
.menu {
display: inline; 
color:#006080; 
font-size: 14px; 
font-weight: bold; 
padding: 5px;
} 
</style>
</head>
<body>
<?php 
 $Subject =  $_POST['Subject'];
 $Message =  $_POST['Message'];
 
   if(mail("trubayev@gmail.com", $Subject, $Message)){
	 echo"Message sent"; }
	 else{
		 echo"Message not sent";}
		 

?>
<br><br>
<a href="email.php" class="menu">Back</a>
</body>
</html>
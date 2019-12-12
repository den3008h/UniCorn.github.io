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
<hr>
<a href="blog.php" class="menu">Home</a>
<hr>


<form action="fornewcoment.php" name="newcoment" method="post">
author
<input type="text" name="author"  size="20" maxlength="20" required />
<br><br>
comment
<textarea name="comment" cols="55" rows="10"  required>  </textarea>
<br><br>
<input type="hidden" name = "created" 
value ="<?php echo date("Y-m-d");?>"/>
<input type="hidden" name = "art_id" 
value ="<?php $art_id = $_GET['note']; echo $art_id; ?>"/>
<input type="submit" name="submit" id="submit" value="submit" />

</form>


</body>
</html>
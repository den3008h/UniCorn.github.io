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
 require_once ("Connections/MySiteDB.php"); 
$link = mysqli_connect ('localhost', 'admin', 'admin', 'mySiteDB');
//Выбор БД
if (!$link) {
      die("Connection failed: " . mysqli_connect_error());
}
 $query1 ="SELECT id FROM comments ";
 
$select_note = mysqli_query($link, $query1);
while ($note = mysqli_fetch_array($select_note)){ $note_id= $note['id']+1;
}
echo $note_id;
echo "Connected successfully  ";
$art_id=$_POST['art_id'];
  $author = $_POST['author'];
$created = $_POST['created'];
$comment = $_POST['comment'];
echo $art_id;
$query = "INSERT INTO comments (id, created, author, comment, art_id) VALUES ('$note_id', '$created', '$author', '$comment', '$art_id')";
if (mysqli_query($link, $query)) {
      echo "New record created successfully";
} else {
      echo "Error: " . $query . "<br>" . mysqli_error($link);
}
mysqli_close($link);

?>
<br><br>
<a href="newcoment.php?note=<?php echo $art_id; ?>" class="menu">Back</a>
</body>
</html>
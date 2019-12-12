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
<?php require_once ("Connections/MySiteDB.php"); 
$link = mysqli_connect ('localhost', 'admin', 'admin');
//Выбор БД
$db = "mySiteDB";
$select = mysqli_select_db($link, $db);
if ($select){
echo "......", "<br>";
} else {
echo "...";
}
$note_id = $_GET['note'];
$query = "SELECT * FROM notes WHERE id = $note_id";
$select_note = mysqli_query($link, $query);
while ($note = mysqli_fetch_array($select_note)){
echo $note ['id'], "<br>";
echo $note ['created'], "<br>";
echo $note ['title'], "<br>";
echo $note ['article'], "<br>";
}

?>
<br><br>
<a href="editnote.php?note=<?php echo $note_id; ?>">
<?php echo 'change note', "<br>";?></a>

<br><br>
<a href="deletenote.php?note=<?php echo $note_id; ?>">
<?php echo 'delete note', "<br>";?></a>

<br><br>
<a href="newcoment.php?note=<?php echo $note_id; ?>">
<?php echo 'new comment', "<br>";?></a>

<br><br>
<a href="deletecom.php?note=<?php echo $note_id; ?>">
<?php echo 'delete comment', "<br>";?></a>

<br><br>
<?php
$query_comments = "SELECT * FROM comments WHERE art_id =$note_id";
$select_com = mysqli_query($link, $query_comments);
$rows = mysqli_num_rows($select_com);
if($rows!=0){
while ($comment = mysqli_fetch_array($select_com)){
echo $comment ['id'], "<br>";
echo $comment ['created'], "<br>";
echo $comment ['author'], "<br>";
echo $comment ['comment'], "<br>";}}
else{echo 'pusto';}
?>

</body>
</html>
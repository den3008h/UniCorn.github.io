<?php
require_once ("Connections/MySiteDB.php"); 
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


?>

<html>
<head>
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
<p>DELETE comment? </p>

<form id="deletecom" name="deletecom" method="post" >
<?php
$query = "SELECT * FROM comments WHERE art_id = $note_id";
$result = mysqli_query ($link, $query);

 while ($edit_note = mysqli_fetch_array ($result)){ 
 ?>

<label for="id"><?php echo $edit_note['id'], "<br>";?></label>
<label for="author"><?php echo $edit_note['author'];?></label>
<label for="comment"><?php echo $edit_note['comment'], "<br>", "<br>";}?></label>
<input type="hidden" name = "note" id = "note"
value="<?php echo $edit_note['id']?>" />
<input type="text" name="id"  size="20" maxlength="20" required />
<input type="submit" name="submit" id="submit" value="delete" />
</form>
<a href="comments.php?note=<?php echo $note_id; ?>" class="menu">Back</a>
</body>
</html>
<?php
$id = $_POST['id'];

$query = "SELECT * FROM comments WHERE art_id = $note_id";
$result = mysqli_query ($link, $query);

 while ($edit_note = mysqli_fetch_array ($result)){
	  if ($id==$edit_note['id']){
		  $update_query = "DELETE FROM comments 
WHERE id = $id";
$delete_result = mysqli_query ($link, $update_query);
		  }
	  }



?>
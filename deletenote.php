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

$query = "SELECT * FROM notes WHERE id = $note_id";
$result = mysqli_query ($link, $query);
$edit_note = mysqli_fetch_array ($result);
?>
<html>
<body>
<p>DELETE NOTE? </p>
<form id="deletenote" name="deletenote" method="post" >
<label for="title"><?php echo $edit_note['title'];?></label>
<input type="hidden" name = "note" id = "note"
value="<?php echo $edit_note['id']?>" />
<input type="submit" name="submit" id="submit" value="delete" />
</form>
<a href="blog.php">Home</a>
</body>
</html>
<?php
$title = $_POST['title'];
$article = $_POST['article'];
$update_query = "DELETE FROM notes 
WHERE id = $note_id";
$delete_result = mysqli_query ($link, $update_query);

?>
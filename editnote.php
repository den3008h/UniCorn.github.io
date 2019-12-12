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
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
<style type="text/css">
.menu {
display: inline; 
color:#006080; 
font-size: 14px; 
font-weight: bold; 
padding: 5px;
} 
h2 {
padding: 5px; 
color: #800080; 
font-size:16px;
}
</style>
</head>
<body>
<hr>

<a href="blog.php" class="menu">Home</a>

<hr>
<p>Edit note</p>
<form id="editnote" name="editnote" method="post" >
<label for="title">Title</label>
<input type="text" name="title" id="title"
value = "<?php echo $edit_note['title'];?>" />
<label for=" article">Article </label>
<textarea name=" article" id=" article">
<?php echo $edit_note['article'];?></textarea>
<input type="hidden" name = "note" id = "note"
value="<?php echo $edit_note['id']?>" />
<input type="submit" name="submit" id="submit" value="Изменить" />
</form>

</body>
</html>
<?php
$title = $_POST['title'];
$article = $_POST['article'];
$update_query = "UPDATE notes SET title = '$title', article = '$article'
WHERE id = $note_id";
$update_result = mysqli_query ($link, $update_query);
?>
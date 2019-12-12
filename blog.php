<!doctype html>
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

<a href="#" class="menu">Enter</a>
<a href="newnote.php" class="menu">New entry</a>
<a href="email.php" class="menu">send a message</a>
<a href="photo.php" class="menu">Photo</a>
<a href="file.php" class="menu">Files</a>
<a href="info.php" class="menu">Information</a>
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
$query ="SELECT * FROM notes ORDER BY id DESC";
 
$select_note = mysqli_query($link, $query);

while ($note = mysqli_fetch_array($select_note)){ echo $note['id'],
"<br>";
?>
<a href="comments.php?note=<?php echo $note['id']; ?>">
<?php echo $note ['title'], "<br>";?></a>
<?php
echo $note ['created'], "<br>"; echo $note ['content'], "<br>";
}

?>
<form id="blog" name="blog" method="post" >
<input type="text" name="search"  size="20" maxlength="20" required />
<input type="submit" name="submit" id="submit" value="search" />
</form>

<?php

$user_search = $_POST['search'];

$where_list = array();
$query_usersearch = "SELECT * FROM notes";
//Извлечение критериев поиска в массив
//Замена запятых на пробелы
$clean_search = str_replace(',', ' ', $user_search);
$search_words = explode(' ', $user_search);
//Создаем еще один массив с окончательными результатами
$final_search_words = array();
//Проходим в цикле по каждому элементу массива $search_words.
//Каждый непустой элемент добавляем в массив $final_search_words
if (count($search_words) > 0)
{
foreach($search_words as $word)
{
if (!empty($word))
{
$final_search_words[] = $word;
}
}
}
//работа с использованием массива $final_search_words
foreach ($final_search_words as $word)
{
$where_list[] = " article LIKE '%$word%'";
}
$where_clause = implode (' OR ', $where_list);
if (!empty($where_clause))
{
$query_usersearch .=" WHERE $where_clause";
}
$res_query = mysqli_query($link, $query_usersearch);
if($word!=NULL){
while ($res_array = mysqli_fetch_array($res_query))
{
	
echo $res_array['id'], "<br>";
echo $res_array['article'], "<br>", "<hr>", "<br>";
}}
?>

</body>
</html>

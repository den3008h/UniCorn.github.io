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
//Вычисление количества заметок
$query_allnotes = "SELECT COUNT(id) AS allnotes FROM notes";
$allnotes = mysqli_query ($link, $query_allnotes) or die (mysqli_error());
//mysqli_error()возвращает строку ошибки последней операции с MySQL
$row_allnotes = mysqli_fetch_assoc ($allnotes);
$allnotes_num = $row_allnotes['allnotes'];
mysqli_free_result ($allnotes);
//mysqli_free_result() освобождает память от результата запроса
echo "number of notes: ";
echo $allnotes_num, "<br>" ;

//Вычисление количества заметок
$query_allcom = "SELECT COUNT(id) AS allcom FROM comments";
$allcom = mysqli_query ($link, $query_allcom) or die (mysqli_error());
//mysqli_error()возвращает строку ошибки последней операции с MySQL
$row_allcom = mysqli_fetch_assoc ($allcom);
$allcom_num = $row_allcom['allcom'];
mysqli_free_result ($allcom);
//mysqli_free_result() освобождает память от результата запроса
echo "number of comments: ";
echo $allcom_num, "<br>" ;


$date_array = getdate();
$begin_date = date ("Y-m-d", mktime(0,0,0, $date_array['mon'],1, $date_array['year']));
$end_date = date ("Y-m-d", mktime(0,0,0, $date_array['mon'] + 1,0, $date_array['year']));
$query_lmnotes = "SELECT COUNT(id) AS lmnotes FROM notes
WHERE created>='$begin_date' AND created<='$end_date'";
$lmnotes = mysqli_query ($link, $query_lmnotes)or die (mysqli_error());
$row_lmnotes = mysqli_fetch_assoc ($lmnotes);
$lmnotes_num = $row_lmnotes['lmnotes'];
mysqli_free_result ($lmnotes);
//$begin_date – первое число месяца,
//$end_date – последнее число месяца.
echo "number of notes in the last month: ", $lmnotes_num, "<br>";

$query_lmcom = "SELECT COUNT(id) AS lmcom FROM comments
WHERE created>='$begin_date' AND created<='$end_date'";
$lmcom = mysqli_query ($link, $query_lmcom)or die (mysqli_error());
$row_lmcom = mysqli_fetch_assoc ($lmcom);
$lmcom_num = $row_lmcom['lmcom'];
mysqli_free_result ($lmcom);
//$begin_date – первое число месяца,
//$end_date – последнее число месяца.
echo "number of comments in the last month: ";
echo $lmcom_num, "<br>";

$query_last_note = "SELECT id, title FROM notes ORDER BY created DESC LIMIT 0,1";
$lastnote = mysqli_query ($link, $query_last_note) or die (mysqli_error());
$row_lastnote = mysqli_fetch_assoc ($lastnote);
mysqli_free_result ($lastnote);
echo "last note: ", $row_lastnote['title'], "<br>";

$query_mcnote = "SELECT notes.id, notes.title FROM comments, notes WHERE comments.art_id=notes.id GROUP BY notes.id ORDER BY COUNT(comments.id) DESC LIMIT 0,1";
$comtnote = mysqli_query ($link, $query_mcnote) or die (mysqli_error());
$row_comtnote = mysqli_fetch_assoc ($comtnote);
mysqli_free_result ($comtnote);
echo "popular note: ", $row_comtnote['title'], "<br>";

?>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Документ без названия</title>
</head>

<body>
<?php 
$user_search = $_GET['usersearch'];

$where_list = array();
$query_usersearch = "SELECT * FROM notes";
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
while ($res_array = mysqli_fetch_array($res_query))
{
echo $res_array['id'], "<br>";
echo $res_array['article'], "<br>", "<hr>", "<br>";
}
?>
</body>
</html>
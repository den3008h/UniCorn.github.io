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
<?php
//Получаем полный путь к папке, где хранятся графические файлы
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . "/photo";

//Запускаем просмотр папки. Функция opendir() возвращает идентификатор
//папки
$image_dir_id = opendir($image_dir_path);
//$array_files - массив, в который будут помещаться все найденные файлы
$array_files = null;
//Служебная переменная, используемая для вычисления индекса следующего
//элемента массива $array_files
$i = 0;
//Запускаем цикл просмотра
while(($path_to_file = readdir($image_dir_id)) !== false)
//Функция readdir() возвращает полный путь к очередному файлу, хранящемуся
//в папке, идентификатор которой был возвращен функцией opendir() и передан
//в качестве параметра.
//$path_to_file получает полный путь к файлу для дальнейшей обработки. Если в папке нет непросмотренных файлов - возвращается логическое значение false
{
if(($path_to_file !=".") && ($path_to_file !=".."))
//Точки обозначают вложенные файлы: одна точка - текущая папка, две точки
// - папка, в которую вложена текущая папка.
{
$array_files[$i] = basename($path_to_file);
$i++;
//Помещаем имя найденного файла в массив $array_files. Функция basename()
//позволяет получить имя файла из полного пути к нему.
}
}
closedir($image_dir_id);
//closedir() удаляет из памяти переданный ей идентификатор папки, таким
//образом завершая просмотр.

?>




<?php
//Получаем количество элементов массива $array_files, т.е. количество
//найденных файлов.
$array_files_count = count($array_files);
if ($array_files_count)
{?>


<hr /><?php
sort($array_files);
for ($i=0; $i<$array_files_count; $i++)
{
//Выводим мена хранящихся в массиве файлов на страницу
?>
<p><a href="/photo/<?php echo $array_files[$i]; ?>"
target="_blank" class="menu">
<?php echo $array_files[$i]; ?></a></p>
<?php

}

}
?>
<hr />

<form name = "file_upload" action="photo.php" enctype="multipart/form-data" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="999999" />
<input type="file" name="file_upload"  />
<input type="submit" name="submit" value="Add" />
</form>
<?php
//Сценарий отправки файла на сервер
//Проверяем, была ли выполнена отправка файла. Далее реализуем сценарий.
if (isset($_POST["MAX_FILE_SIZE"]))
{
$tmp_file_name = $_FILES["file_upload"]["tmp_name"];
$dest_file_name = $_SERVER['DOCUMENT_ROOT']."/photo/".$_FILES["file_upload"]["name"];
move_uploaded_file($tmp_file_name, $dest_file_name);
}
?>
<br><br>
<!-- Форма для удаления файла с сервера -->
<form name="file_delete" action="photo.php" method="post" enctype="application/x-www-form-urlencoded">
file <select name = "file_delete" size="1">
<?php for ($i=0; $i<$array_files_count; $i++) { ?>
<option><?php echo $array_files[$i]; ?></option>
<?php } ?></select>
<input type="submit" name="submit" value="delete" />
</form>
<?php
//Сценарий удаления файла
//Сначала проверяем, было ли запущено удаление файла
if (isset($_POST["file_delete"]))
{
//Формируем полное имя файла
$file_name = $_SERVER['DOCUMENT_ROOT'] . "/photo/".
$_POST["file_delete"];
//Функция unlink() удаляет файл
unlink($file_name);
}
?>
<br>
<a href="photo.php" class="menu">reload</a>
</body>
</html>
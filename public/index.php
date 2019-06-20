<?php
include "../config/config.php";

if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'index';
}

$params = prepareVariables($page);

// $params = [];

// switch ($page) {
//     case 'index':
//     break;
//     case 'gallery':

//     $link = mysqli_connect('localhost','root','','geekbrains') or die("не могу соединиться с БД");
//     $result = mysqli_query($link, "SELECT * FROM geekbrains.gallery ORDER BY pop DESC");
//     while($row = mysqli_fetch_assoc($result)) {
//         $pictures[]  = $row;
//     }
    
//     $params = [
//         'pictures' => $pictures
//     ];
//     break;
//     case 'catalog':
//     $params = [
//         'catalog' => ["Чай", "Печенье", "Вафли"]
//     ];
// }

if(isset($_POST['load'])) {
    $link = mysqli_connect('localhost','root','','geekbrains') or die("не могу соединиться с БД");
    $name = $_FILES['myfile']['name'];
    $path = "gallery_img/big/" . $name;
    $save = "gallery_img/small/" . $name;
    if(move_uploaded_file($_FILES['myfile']['tmp_name'], $path)) {
        create_thumbnail($path, $save);
        $query = "INSERT INTO `gallery` (`href`, `size`, `pop`, `otch`) VALUES ('$name', '10', '1', NULL)";
        
        mysqli_query($link, $query);
        
        header("Location: /?page=gallery");
    
    } else {
        echo "Ошибка загрузки!<br>";
    }
}

echo render($page, $params);

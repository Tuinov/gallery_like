<?php
include "../config/config.php";
$link = getDb();

$id = (int)$_GET['id'];
mysqli_query($link, "UPDATE geekbrains.gallery SET pop = pop+ 1 WHERE id={$id}");
$result = mysqli_query($link, "SELECT * FROM geekbrains.gallery WHERE id={$id}");

$row = mysqli_fetch_assoc($result);
echo '<h1>Single page</h1><a href="/?page=gallery">Галерея</a>';
echo '<h2>Просмотров: ' . $row['pop'] . '</h2>';
echo '<img src="gallery_img/big/' . $row['href'] . '">';
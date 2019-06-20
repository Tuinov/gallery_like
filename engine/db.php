<?php
function getDb() {
    static $link = null;

    if(is_null($link)) {
        $link = mysqli_connect(HOST, USER, PASS, DB) or 
die("не могу соединиться с БД");
    }
    return $link;
}
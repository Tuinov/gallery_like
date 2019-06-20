<?php

function prepareVariables($page) {
    $params = [];

    switch ($page) {
        case 'index':
        break;
        case 'gallery':

        $link = getDb();
        $result = mysqli_query($link, "SELECT * FROM geekbrains.gallery ORDER BY pop DESC");
        while($row = mysqli_fetch_assoc($result)) {
            $pictures[]  = $row;
        }
        
        $params = [
            'pictures' => $pictures
        ];
        break;
        case 'catalog':
        $params = [
            'catalog' => ["Чай", "Печенье", "Вафли"]
        ];
    }
    return $params;
}

function render($page, $params = []) {
    $content = renderTemplate(LAYOUTS_DIR . 'main', [
        'content' => renderTemplate($page, $params)
        ]);
    return $content;
}

function renderTemplate($page, $params = []) {
    
    
  ob_start();
  if(!is_null($params)) {
    extract($params);
}

   $fileName = TEMPLATES_DIR . $page . ".php";
   if(file_exists($fileName)) {
    include $fileName;
   } else {
       exit("страница {$fileName} не существует!!");
   }
   
  return ob_get_clean();
}
// создаёт уменьшенную копию и загружает его в $save
function create_thumbnail($path, $save) {
    $info = getimagesize($path);

    $width = $info[0];
    $height = $info[1];

    $percent = 0.5;

    $newWidth = $width * $percent;
    $newHeight = $height * $percent;
   
    //imagecreatetruecolor — Создание нового полноцветного изображения
    $thumb = imagecreatetruecolor($newWidth, $newHeight);
    //imagecreatefromjpeg — Создает новое изображение из файла или URL

    //В зависимости от расширения картинки вызываем соответствующую функцию
	if ($info['mime'] == 'image/png') {
		$src = imagecreatefrompng($path); //создаём новое изображение из файла
	} else if ($info['mime'] == 'image/jpeg') {
		$src = imagecreatefromjpeg($path);
	} else if ($info['mime'] == 'image/gif') {
 		$src = imagecreatefromgif($path);
	} else {
		return false;
    }
    
    //imagecopyresized — Копирование и изменение размера части изображения
    imagecopyresampled($thumb, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    imagejpeg($thumb, $save);
};
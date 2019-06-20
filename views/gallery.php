

<h2>Gallery</h2>
        <?php foreach($pictures as $value):?>
        
            <a href="single.php?id=<?=$value['id']?>">
                <img src="gallery_img/small/<?=$value['href']?>" alt="photo">
            </a><?=$value['pop']?> &#10084 
          
        <?php endforeach; ?>

<h3>Загрузить изображение</h3> 
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="myfile">
        <input type="submit" name="load" value="Загрузить">
    </form> 
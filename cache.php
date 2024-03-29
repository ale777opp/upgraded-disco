<?php
define ('IMG_CACHE', $_SERVER['DOCUMENT_ROOT'].'/img_cache/');
//для корректной работы filemtime
clearstatcache();
//______________________________________________________

$width = isset($_GET['width']) ? (int) $_GET['width'] : 0;
$height = isset($_GET['height']) ? (int) $_GET['height'] : 0;
//$max_size = isset($_GET['max_size']) ? (int) $_GET['max_size'] : 0;
//$file_name = $_GET['file'];

$max_size =200;
$file_name = '/images/636737330_65579-54_2.jpg';

//путь к файлу от корневой директории
$file_name = str_replace('..', '', $file_name);
$file_name = $_SERVER['DOCUMENT_ROOT'] . $file_name;

if (!is_file($file_name)) {
    echo 'Ошибка: файл не найден';
    exit();
}

function make_thumbnail($file_name, $thumb_width, $thumb_height,
    $max_size) {

$image_info = getimagesize($file_name); //Для начала получим информацию об исходном изображении

switch ($image_info['mime']) { //свои функцию для открытия и загрузки изображения
        case 'image/gif':
            if (imagetypes() & IMG_GIF) {
                $image = imagecreatefromGIF($file_name);
            }
            else {
                $err_str = 'GD не поддерживает GIF';
            }
            break;
        case 'image/jpeg':
            if (imagetypes() & IMG_JPG) {
                $image = imagecreatefromJPEG($file_name);
            }
            else {
                $err_str = 'GD не поддерживает JPEG';
            }
            break;
        case 'image/png':
            if (imagetypes() & IMG_PNG) {
                $image = imagecreatefromPNG($file_name);
            }
            else {
                $err_str = 'GD не поддерживает PNG';
            }
            break;
        default:
           $err_str = 'GD не поддерживает ' . $image_info['mime'];
    }

    if (isset($err_str)) {
        return $err_str;
    }
//Теперь нужно определить размеры миниатюры, если они не заданы явно.
$image_width = imagesx($image);
    $image_height = imagesy($image);

    //задано ограничение на высоту и ширину:
    if ($max_size) {
        if ($image_width < $image_height) {
            $thumb_height = $max_size;
            $thumb_width =
                round($max_size * $image_width / $image_height);
        }
        else {
            $thumb_width = $max_size;
            $thumb_height =
                round($max_size * $image_height / $image_width);
        }
    }

    //задана только ширина
    elseif ($thumb_width && !$thumb_height) {
        $thumb_height =
            round($thumb_width * $image_height / $image_width);
    }

    //задана только высота
    elseif (!$thumb_width && $thumb_height) {
        $thumb_width =
            round($thumb_height * $image_width / $image_height);
    }

    //не задан ни один из размеров
    else {
        $thumb_width = $image_width;
        $thumb_height = $image_height;
    }
//создает полноцветное изображение указанного в параметрах размера и возвращает его идентификатор
$thumb = imagecreatetruecolor($thumb_width, $thumb_height);
    imagealphablending($thumb, false);
    imagesavealpha($thumb, true);
//копирует прямоугольную область из первого изображения во второе.
imagecopyresampled($thumb, $image, 0, 0, 0, 0,
        $thumb_width, $thumb_height, $image_width, $image_height);
//imagePNG выводит в браузер изображение с указанным идентификатором

imagePNG($thumb);
    //освобождаем память
    imagedestroy($image);
    imagedestroy($thumb);

}//Рассмотрим функцию, которая будет выполнять основную задачу скрипта.



//имя файла с кешем
$cache_file_name = md5($file_name);
//Определим время изменения файла с кешем, если он существует.

$cache_mtime = 0;
if (is_file(IMG_CACHE . $cache_file_name)) {
    $cache_mtime = filemtime(IMG_CACHE . $cache_file_name);
}
if ($cache_mtime < filemtime($file_name)) {

    //буферизация вывода
    ob_start();
    $result = make_thumbnail($file_name, $width, $height, $max_size);
    $thumbnail = ob_get_contents();
    $thumb_size = ob_get_length();
    ob_end_clean();
    if ($result) {
        echo 'Ошибка: ' . $result;
        exit();
    }

    //кеширование миниатюры
    $fd = fopen(IMG_CACHE . $cache_file_name, "wb");
    fwrite($fd, $thumbnail);
    fclose($fd);

    $cache_mtime = filemtime(IMG_CACHE . $cache_file_name);
}
else {
    //загрузка миниатюры из кеша
    $fd = fopen(IMG_CACHE . $cache_file_name, "rb");
    $thumb_size = filesize(IMG_CACHE . $cache_file_name);
    $thumbnail = fread ($fd, $thumb_size);
    fclose ($fd);
}
//Осталось установить заголовки и отправить миниатюру браузеру.

header('Content-Type: image/png');
//время создания миниатюры
header('Last-Modified: '.gmdate('D, d M Y H:i:s', $cache_mtime).' GMT');
header('Content-Length: '.$thumb_size);

//вывод миниатюры в браузер
echo $thumbnail;
?>
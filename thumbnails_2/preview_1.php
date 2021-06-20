<?php
//Исходный файл и размеры конечной картинки будем передавать через URL:
$width = isset($_GET['width']) ? (int) $_GET['width'] : 0;
$height = isset($_GET['height']) ? (int) $_GET['height'] : 0;
//$max_size = isset($_GET['max_size']) ? (int) $_GET['max_size'] : 0;
//$file_name = $_GET['file'];

$max_size =200;
$file_name = '\images\P6216407_1.jpg';
$dir =__DIR__;
//путь к файлу от корневой директории
$file_name = str_replace('..', '', $file_name);
//echo "имя файла $file_name <br>";
//$file_name = $_SERVER['DOCUMENT_ROOT'] . $file_name;
$file_name = __DIR__. $file_name;
//echo "document root {$_SERVER['DOCUMENT_ROOT']}<br>";
//echo "_DIR_ $dir <br>";
//echo "имя файла $file_name <br>";
if (!is_file($file_name)) {
    echo 'Ошибка: файл не найден';
    exit();
}
//Рассмотрим функцию, которая будет выполнять основную задачу скрипта.

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

//промежуточный вариант!
header('Content-Type: image/png');
$result = make_thumbnail($file_name, $width, $height, $max_size);
?>
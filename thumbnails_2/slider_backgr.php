<!doctype html>
<html lang="ru">
  <head>
    <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>цикл</title>
<style>
body {
/*background-image: url(/slider/3.jpg); */
background-position: center center;
background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover;
width: 100%;
height: 100%;
}
</style>

</head>
<body>

<script>

  let image=document.getElementsByTagName('body');
  let name_image="";
  let i=1;
<?php $files = glob('slider/*');
foreach($files as $file) {
?>
    timerId = setInterval(() => {
    name_image="url(<?php echo $file?>)";
    console.log(name_image);
    image[0].style.backgroundImage=name_image;
    /*
    i++;
    if (i>4) {clearInterval(timerId);
      i=1;
    }
    */
  }, 2000);

<?php
}
?>

</script>
</body>
</html>
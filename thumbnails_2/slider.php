<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <!-- <link rel='stylesheet' href='site_components/style/style.css'> -->
    <title>php+old Javascript</title>
</head>
<style>
 .carousel-item {
  float: none;
  height: 100vh;
  width: 100rem;
  margin-left: auto;
  margin-right: auto;
 }
</style>
<body>
<div class="container-fluid">
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

<?php
$files = glob('slider/*');
$flag=true;
foreach($files as $file) {
//echo $file.'<br/>';
if(is_file($file)) {
  if ($flag){
    echo '<div class="carousel-item active" style="background:url('.$file.') no-repeat center; background-size:auto 100% ;"></div>';
     $flag=False;
  }else{
    echo '<div class="carousel-item" style="background:url('.$file.') no-repeat center; background-size:auto 100%;"></div>';
  }
//echo $file.'<br>';
} else {
echo $file.' что же это может быть?<br> ';
}
}
?>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="text-white">Предыдущий</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="text-white">Следующий</span>
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
      </a>
</div>
</div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  </body>
  </html>
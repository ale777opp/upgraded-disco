<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <!-- link rel="stylesheet" href="/css/page.css"> -->
    <script src="/js/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel='stylesheet' href='site_components/style/style.css'> -->
    <title>new slider</title>

<style>
*
{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  list-style: none;
  text-decoration: none;
}
.item {
  height: 100vh;
  width: 100rem;
  margin-left: auto;
  margin-right: auto;
}
.img {
    /*width: calc(var(--dim-box)*0.75px); */
    height: 100vh;
    background-size: auto 100%;
    background-position: center;
    background-repeat: no-repeat;
    margin-left: auto;
    margin-right: auto;
}
.button {
    outline: none;
    color: #000 !important;
    background-color: #c6c6c6 !important;
    padding: 16px 16px;
    cursor: pointer;
    opacity: 0.5;
}
.button:hover {
    background-color: #ebe8e8 !important;
    color: #000 !important;
}
.left, .right {
    position: absolute;
    top: 44%;
    z-index: 1000;
}
.left {
    left: 10%;
}
.right {
    right: 10%;
}
</style>
</head>
<body>
<div class="container">
    <div class="content">

<?php
$files = glob('slider/*.*');//glob('/slider/*.*/');{png,jpg}
foreach($files as $file) {

if(is_file($file)) {
//  print_r(gettype($file).'<br>');
//     echo '<div class="item" style="background:url('.$file.') no-repeat center; background-size:auto 100% ;"></div>';
} else {
echo $file.' что же это может быть?<br> ';
 }
}
?>

            <div class="images">
                <div class="loading"></div>
            <!--    <div class="mySlides">  -->
                <div id="btn" class="img"></div></div>
                <button class="button left" onclick="next(-1)">&#10094</button>
                <button class="button right" onclick="next(1)">&#10095</button>
            <!-- </div> -->


</div>
</div>

 <script>
  let imglist = <?php echo json_encode($files) ?>;
  let index = 1;
  let pause_in_scrolling = 5;
  let user_no_active = 0;
  let flag = true;

let timerId = setInterval(() => {
user_no_active++;
document.onmousemove = () => user_no_active = 0;
if (user_no_active >= pause_in_scrolling) {
    console.log("Пользователь не активен");
    if (user_no_active%3 ==0) next(1);
  }
}, 1000); // обновление каждую секунду timerId

  function next(n) {
    showImages(index += n);
  }
        function showImages(n) {
          var i;
            if ( n > imglist.length ) index = 1;
            if ( n < 1 ) index = imglist.length;
            $(".loading").show();

            img = new Image();

            $(img).attr('src', imglist[index-1]);

            $(img).on("load", function(){
                $('.img').css('background-image', 'url(' + imglist[index-1] + ')');
                $('.loading').hide();
            });
        }
/*
        let buttons = document.getElementsByClassName('button');
        if (imglist.length <=1) {for(but of buttons) { but.style.display = 'none'}};

    let modal = $('#my_modal')[0];
    let span =  $('.close_modal_window')[0];
    let btn = $('#btn')[0];

    btn.onclick = function () {
      modal.style.display = "block";
      $('.img_modal').attr('style', 'background-image: url('+imglist[index-1]+')');
     }
    span.onclick = function () {
      modal.style.display = "none";
     }
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
     }
*/
showImages(index);



</script>
</body>
</html>
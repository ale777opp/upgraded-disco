<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/style.css" rel="stylesheet">
   <!-- <link rel="shortcut icon" href="img/beacon.png" type="image/png">
   <link rel="icon" href="img/beacon.png" type="image/png"> -->
<title>стартовая страница слайдера</title>
<style>
      body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        overflow: visible;

    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;
       }
      #container {
        display: flex;
        height: 100%;
        width: 100%;
        position: absolute;
       }
     .content {
        display: flex;
        flex-wrap:wrap;
        max-width: 950px;
        margin: 0 auto;
        padding:0 15px;
      }
      .row {
        display: flex;
        border: 2px solid #dee2e6;
        width: 100%;
        flex-wrap: nowrap;
        height: 50px;
      }
      .col {
        display: flex;
        width: 50%;
        margin-left: 15px;
        margin-right: 15px;
     /*   margin-top: 5px;
        margin-bottom: 5px; */
      }
.down_menu {
    display: block;
    position:absolute;
    border: 2px solid #000;
    border-radius: 10%;
    left:1150px;
    width:150px;
    background-color:#f4f4f4;
    padding: 10px;
    text-align: left;
    }
h2 {
    font-face:Arial;
    font-weight:500;
    font-size:1.75rem;"
    }

a {
    font-size: 20px;
    text-decoration: none;
    color: #000;
    }
a.disabled {
    pointer-events: none;
    cursor: default;
    color: #fa8e47;
    font-family:cursive;
}
.down-item{
    padding:10px;
}
th,td  {
    border-bottom: 1px solid #dee2e6;
    padding:10px;
    color: #495057;
}
table {
    border-collapse: collapse;
   }
tbody tr:hover {
    background: #eaf4ff;
   }
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.6);
    z-index: 1000;
}
.modal .modal_content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 10px;
    border: 1px solid #888;
    width: 50%;
    z-index: 99999;
}
.modal .modal_content .close_modal_window {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}
.table{
    display:grid;
    grid-template-rows: 200px 200px 200px 200px; /* 4 строки */
    /*grid-template-columns: 25% 25% 25% 25%; /* 4 столбца */
    grid-template-columns: repeat(auto-fit, 25%);
    justify-content: center;
    /* max-width: 400px; */
}
/*
.grid_container {
    display: grid;
    grid-template-columns: repeat(auto-fit, 475px);
    justify-content: center;
    max-width: calc(var(--dim-box)*0.85px);
    margin-bottom: 50px;
    margin-left: auto;
    margin-right: auto;
}

.gallery_one {
    display: inline-table;
    /*padding: 18px;
    text-align: center;
    height: 100%;
    border: 1px solid var(--main-color);
    margin: 10px;
}

.grid-image {
    background-size: contain;
    background-color: var(--main-color);
    background-position: center;
    background-repeat: no-repeat;
    height: 260px;
}

.gallery-page {
    padding: 10px;
    text-align: center;
}
 */
</style>
</head>
<?php
    $max_size =200;
    define ('IMG_PATH', __DIR__.'\images\\');
     try {
    $dir_content = scandir(IMG_PATH);
    //echo "<pre>";print_r($dir_content);echo "</pre>";
    }
            catch(Exception $e){
            echo "Нераспознанная ошибка: $e";
            }
            finally{}
?>
<body>
<div id="container">
  <div class="content" style="align-items:center">
    <div class="row">
      <div class="col" style="justify-content: flex-start; align-items:center;">
        <h2>Содержание директории:</h2>
      </div>
      <div class="col" style="justify-content: flex-end; align-items:center;">
        <h2><?=IMG_PATH;?></h2>
      </div>
    </div>

<div class="table" style="width: 100%">

<?php
foreach ($dir_content as $file_name) {
    if (!is_dir($file_name)) {
//echo "Нераспознанная ошибка:$file_name";
    $file_name = str_replace('..', '', $file_name);
    $file_name = IMG_PATH.$file_name;
    if (!is_file($file_name)) {
     echo 'Ошибка: файл не найден';
    exit();
    }
        echo "<div align=center>";
        echo "<img src='preview.php?src=${file_name}' class='photo_main' alt='webcam_5629.png'>";
        //echo "<img src='webcam_5629.png' class='photo_main' alt='webcam_5629.png'>";
        echo "<p>$file_name</p>";
         echo "</div>";
    }

}

?>

</div> <!-- table-->
</div> <!-- content -->
</div> <!-- container -->

<script>
/*
    let item_col=0;
    let button = document.getElementsByClassName("strdir");
    for(let i=0;i<button.length;i++){
        button[i].addEventListener("click",itemClick);
  }


let item = event.currentTarget.offsetTop;
let item1 = event.currentTarget.innerText;
let item2 = event.currentTarget.rowIndex;
let item3 = event.currentTarget.sectionRowIndex;


function itemClick(event) {
//let items_sel = [];
    let item_sel=event.currentTarget;
        if (item_sel.style.backgroundColor == ''){
            item_sel.style.backgroundColor = 'rgb(170, 213, 255)';
            item_col++;
            coordY = item_sel.offsetTop;
            coordY = coordY+'px';
            if(item_col==1){
                let div = document.createElement('div');
                div.innerHTML = `<div class="down-item"><a id="btn_modal_window" href="#" onclick="editor()">Просмотреть</a></div>
                <div class="down-item"><a href="#">Скачать</a></div><hr>
                      <div class="down-item"><a>Выбрано: <span id="col_sel"></span></a></div>`;
                div.className="down_menu";
                div.id='menu'
                document.body.append(div);
            }
            menu.style.top= coordY;
            document.getElementById('col_sel').innerHTML=item_col;
            if(item_col>=2){menu.children[0].children[0].className='disabled';}
        } else {
            item_sel.style.backgroundColor = '';
            item_col--;
            coordY = item_sel.offsetTop;
            coordY = coordY+'px';
            menu.style.top= coordY;
            if (item_col==1){menu.children[0].children[0].className='';}
            if (item_col==0){menu.remove();
            }else{document.getElementById('col_sel').innerHTML=item_col;}
        }
}
function editor(event){
let edit = document.createElement('div');
    edit.innerHTML = `<div>
    <div class="modal_content">
    <p align="center" style="font-size: 28px;">Редактирование/просмотр <span class="close_modal_window">×</span></p>
    <hr>
<br>
<iframe id="iframe_redactor" width='100%' height='100%' scrolling='yes' frameborder='yes' src='#' ></iframe>
</div></div>`;
    edit.className="modal";
    edit.id='my_modal'
 document.body.append(edit);

var modal = document.getElementById("my_modal");
var btn = document.getElementById("btn_modal_window");
var span = document.getElementsByClassName("close_modal_window")[0];

 btn.onclick = function () {
    modal.style.display = "block";
    Init();
 }

 span.onclick = function () {
    modal.style.display = "none";
 }

 window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function Init()
    {
    //  document.getElementById("iframe_redactor").contentWindow.document.designMode = "On";

    let isframe = document.getElementById("iframe_redactor");
    let isWindow = isframe.contentWindow;
    let isDocument = isframe.contentDocument;
    iHTML = "<html><head></head><body style='background-color: yellow;font-size: 20px;'><span>Lorem ipsum dolor sitt,..</span></body></html>";
    isDocument.open();
    isDocument.write(iHTML);
    isDocument.close();
    isDocument.designMode = "on";
}
function save() {
      document.getElementById("content").value = isDocument.body.innerHTML;
      alert(iDoc.body.innerHTML);
      iHTML_content=isDocument.body.innerHTML;
      return true;
    }

}
*/
</script>
</body>
</html>
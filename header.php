<?php
  include "config.php";
  $page = basename($_SERVER['PHP_SELF']);
  switch($page){
    case "single.php":
      if(isset($_GET['id'])){
        $sql_title = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
        $result_title = mysqli_query($conn,$sql_title) or die("Запит не виконано");
        $row_title = mysqli_fetch_assoc($result_title);
        $page_title = $row_title['title'];
      }else{
        $page_title = "Пости не знайдено";
      }
      break;
    case "category.php":
      if(isset($_GET['cid'])){
        $sql_title = "SELECT * FROM category WHERE category_id = {$_GET['cid']}";
        $result_title = mysqli_query($conn,$sql_title) or die("Запит не виконано");
        $row_title = mysqli_fetch_assoc($result_title);
        $page_title = $row_title['category_name'] . " Новини";
      }else{
        $page_title = "Пости не знайдено";
      }
      break;
    case "author.php":
      if(isset($_GET['aid'])){
        $sql_title = "SELECT * FROM user WHERE user_id = {$_GET['aid']}";
        $result_title = mysqli_query($conn,$sql_title) or die("Tile Query Failed");
        $row_title = mysqli_fetch_assoc($result_title);
        $page_title = "News By " .$row_title['first_name'] . " " . $row_title['last_name'];
      }else{
        $page_title = "Пости не знайдено";
      }
      break;
    case "search.php":
      if(isset($_GET['search'])){

        $page_title = $_GET['search'];
      }else{
        $page_title = "Не має результатів пошуку";
      }
      break;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Go IT</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <style>
        #dLabel{
            padding: 10px 20px;
            display: block;
            text-transform: uppercase;
            color: #f1f1f1;
            font-size: 15px;
            font-weight:600;
            transition:all 0.5s ease 0s;
        }
        #dLabel:hover,
        #dLabel:active{
            background:#fff;
            color:#0B172A;
        }
        #list > li{
            padding: 10px 20px;
            display: block;
            text-transform: uppercase;
            color: #f1f1f1;
            font-size: 15px;
            font-weight:600;
            transition:all 0.5s ease 0s;
            background: #fff;
        }
        #list > li:hover{
            background: #fff;
        }
        #list > li:active{
            background: #f1f1f1;
        }
        #reg{
            color: #ffc107;
        }
    </style>
</head>
<body>
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                include "config.php";
                if(isset($_GET['cid'])){
                    $cat_id = $_GET['cid'];
                }
                $sql = "SELECT * FROM category WHERE post > 0";
                $result = mysqli_query($conn, $sql) or die("Query Failed. : Category");
                if(mysqli_num_rows($result) > 0){
                    $active = "";
                    ?>
                    <ul class='menu'>
                        <li><a href="first.php" id="icon"><img src="images/icon_first.jpg" style="width: 120px"></a></li>
                        <li><a href="second.php">Про нас</a></li>
                        <li><a href="index.php">Курси</a></li>
                        <li>
                            <div class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown" id="dLabel">Категорії</a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel" id="list">
                                    <?php while($row = mysqli_fetch_assoc($result)) {
                                        if(isset($_GET['cid'])){
                                            if($row['category_id'] == $cat_id){
                                                $active = "active";
                                            }else{
                                                $active = "";
                                            }
                                        }
                                        echo "<li><a class='{$active}' href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
                                    } ?>
                                </ul>
                            </div>
                        </li>
                        <li><a href="second.php#scrollspyHeading1">Наша команда</a></li>
                        <li><a href="second.php#scrollspyHeading2">Контакти</a></li>
                        <li class="btn-group-vertical py-1">
                            <a href="admin/index.php" id="reg" class="mb-1" style="border-radius: 1rem; background: #f1f1f1">Увійти</a>
                            <a href="admin/add-user.php" style="border-radius: 1rem; background: #ffc107">Зареєструватися</a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
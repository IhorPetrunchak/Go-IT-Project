<?php
include "config.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN-панель</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div id="header-admin" style="background: #0B172A; text-align: center; padding: 15px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <img class="logo" style="display: inline-block; width: 80%;" src="images/news.jpg">
                    </div>
                    <div class="col-md-offset-9  col-md-1">
                        <a href="logout.php" class="admin-logout" >Вихід</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="admin-menubar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                       <ul class="admin-menu">
                            <li>
                                <a href="post.php">Пости</a>
                            </li>
                            <li>
                                <a href="category.php">Категорії</a>
                            </li>
                            <li>
                                <a href="users.php">Користувачі</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
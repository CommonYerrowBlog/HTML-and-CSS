<?php
include_once 'connections.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title><?=$title?></title>
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript" src="scripts/jquery.js"></script>
</head>
<body>
<div class="wrapper">
    <div class="second-wrapper">
        <header>
            <div class="title-image"><img src="resources/title.png"></div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="register.php">Blog</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li>
                        <div>
                            <form method="post" action="result.php">
                                <input name="search" placeholder="Search..." type="search">
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="picture"><img src="resources/angel.jpg"></div>
        </header>
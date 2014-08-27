<?php
function add_post($connection, $title, $text, $category ){

    $title = mysqli_real_escape_string($connection, $title);
    $title = htmlentities($title);
    $text  = mysqli_real_escape_string($connection, $text);
    $text = htmlentities($text);
    $category  = (int)$category;

    $queryPost = "INSERT INTO posts (post_name,post_text,post_date,cat_id)
    VALUES ('$title','$text', NOW(),'$category')";

    $postResult = mysqli_query($connection, $queryPost)
                    or die(mysqli_error($connection));
}

function add_category($connection, $name){
    $name = mysqli_real_escape_string($connection, $name);
    $name = htmlentities($name);

    $queryCategories = "INSERT INTO `categories` SET `cat_name` = '{$name}'";

    $categoriesResult = mysqli_query($connection, $queryCategories )
    or die(mysqli_error($connection));
}

function add_comment($connection, $commentName, $commentText, $post){
    $commentName = mysqli_real_escape_string($connection, $commentName);
    $commentName = htmlentities($commentName);
    $commentText  = mysqli_real_escape_string($connection, $commentText);
    $commentText = htmlentities($commentText);
    $post  = (int)$post;

    $queryComment = "INSERT INTO `comments`
                  SET
                    `post_id`          = {$post},
                    `comment_name`     = '{$commentName }',
                    `comment_text`     = '{$commentText}',
                    `comment_date`     = NOW()";
    $commentResult = mysqli_query($connection, $queryComment) or die(mysqli_error($connection));
}

function register_user($connection,$firstname, $secondname, $username, $password){
    $firstname = mysqli_real_escape_string($connection, $firstname);
    $firstname = htmlentities($firstname);
    $secondname = mysqli_real_escape_string($connection, $secondname);
    $secondname = htmlentities($secondname);
    $username = mysqli_real_escape_string($connection, $username);
    $username = htmlentities($username);
    $password = mysqli_real_escape_string($connection, $password);
    $password = htmlentities($password);
    $password = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);

    $queryRegister = "INSERT INTO `users` SET
             `first_name`  = '{$firstname}',
              `last_name`  = '{$secondname}',
              `username`   = '{$username}',
              `password`  = '{$password}' ";
    $registerResult = mysqli_query($connection, $queryRegister)
                                    or die(mysqli_error($connection));
}


?>
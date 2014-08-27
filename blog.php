<?php

function add_post($title, $contents, $category){

    $title     = mysql_real_escape_string($title);
    $contents  = mysql_real_escape_string($contents);
    $category  = (int)$category;

    mysql_query("INSERT INTO `posts` SET
                    `cat_id`       = {$category},
                    `title`        = '{$title }',
                    `contents`     = '{$contents}',
                    `date_posted`  = NOW()");
}

// New one
function add_comment($title, $contents, $post){
    $title     = mysql_real_escape_string($title);
    $contents  = mysql_real_escape_string($contents);
    $post  = (int)$post;

    mysql_query("INSERT INTO `comments`
                  SET
                    `post_id`          = {$post},
                    `comment_name`     = '{$title }',
                    `comment_text`     = '{$contents}' ");
}

// New one
function get_comments($post_id){

    $post_id = (int)$post_id;
    $comments = array();
    $query = "SELECT `comment_name`, `comment_text`
              FROM   `comments`
              INNER JOIN `posts` WHERE `comments`.`post_id` = {$post_id} AND `posts`.`id` = {$post_id}";

    $query = mysql_query($query);

    while($row = mysql_fetch_assoc($query)){
        $comments[] = $row;
    }

    return $comments;
}

function edit_post($id, $title, $contents, $category){
    $id        = (int)$id;
    $title     = mysql_real_escape_string($title);
    $contents  = mysql_real_escape_string($contents);
    $category  = (int)$category;

    mysql_query("UPDATE `posts` SET
                    `cat_id`       = {$category},
                    `title`        = '{$title }',
                    `contents`     = '{$contents}',
      WHERE `id` = {$id}");
}

function add_category($name){
    $name = mysql_real_escape_string($name);
    mysql_query("INSERT INTO `categories` SET `name` = '{$name}'");
}

function delete($table,$id){

    $table = mysql_real_escape_string($table);
    $id = (int)$id;

    mysql_query("DELETE FROM `{$table}` WHERE  `id` = {$id}");
    echo mysql_error();
}

function get_post($id=null, $cat_id = null){

    $posts = array();
    $query = "SELECT `posts`.`id` AS `post_id`, `categories`.`id` AS `category_id`,
                     `title`,`contents`,`date_posted`,`categories`.`name`
              FROM `posts`
              INNER JOIN `categories` ON `categories`.`id` = `posts`.`cat_id`";

    if(isset($id)){
        $id = (int)$id;
        $query.=" WHERE `posts`.`id` = {$id}";
    }

    if(isset($cat_id)){
        $cat_id = (int)$cat_id;
        $query.=" WHERE `cat_id` = {$cat_id}";
    }

    $query.= " ORDER BY `posts`.`id` DESC ";

    $query = mysql_query($query);

    while($row = mysql_fetch_assoc($query)){
        $posts[] = $row;
    }

    return $posts;
}

function get_categories($id=null){

    $categories = array();
    $query = mysql_query("SELECT `id`,`name` FROM `categories`");

    while($row = mysql_fetch_assoc($query)){
        $categories[] = $row;
    }

    return $categories;
}

function category_exists($field, $value){

    $field = mysql_real_escape_string($field);
    $value = mysql_real_escape_string($value);

    $query = mysql_query("SELECT COUNT(1) FROM `categories` WHERE `{$field}` = '{$value}'");

    echo mysql_error();

    return (mysql_result($query,0) == '0')? false:true;
}

// Find if the user is logged in
function is_user_loggedin($username, $password){

    $user = mysql_real_escape_string($username);
    $pass = mysql_real_escape_string($password);
    $pass = md5(md5("adadasd".$pass."adsadasd"));

    $query  =mysql_query("SELECT * FROM `users` WHERE `username`='{$user}' AND `password`='{$pass}'");

    echo mysql_error();

    $numrows = mysql_num_rows($query);

    return $numrows;
}

function get_user_id($username, $password){

    $user = mysql_real_escape_string($username);
    $pass = mysql_real_escape_string($password);
    $pass = md5(md5("adadasd".$pass."adsadasd"));

    $users = array();

    $query = mysql_query("SELECT `id` FROM `users` WHERE `username`='{$user}' AND `password`='{$pass}'");

    while($row = mysql_fetch_assoc($query)){
        $users[] = $row;
    }

    return $users;
}

function same_name_user($username, $password){
    $user = mysql_real_escape_string($username);
    $pass = mysql_real_escape_string($password);
    $pass = md5(md5("adadasd".$pass."adsadasd"));

    $query  =mysql_query("SELECT COUNT(1) FROM `users` WHERE `username`='{$user}' AND `password`='{$pass}'");

    echo mysql_error();

    return (mysql_result($query,0) == '0')? false:true;
}

function register_user($firstname, $secondname, $username, $password){

    $firstname = mysql_real_escape_string($firstname);
    $secondname = mysql_real_escape_string($secondname);
    $username = mysql_real_escape_string($username);
    $password = mysql_real_escape_string($password);
    $password = md5(md5("adadasd".$password."adsadasd"));

    mysql_query("INSERT INTO `users` SET
                                         `first_name`  = '{$firstname}',
                                          `last_name`  = '{$secondname}',
                                          `username`   = '{$username}',
                                          `password`  = '{$password}' ")or die(mysql_error());

}
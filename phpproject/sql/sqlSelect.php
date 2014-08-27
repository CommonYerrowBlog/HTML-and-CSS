<?php
function is_user_loggedin($connection, $username, $password){

    $user = mysqli_real_escape_string($connection, $username);
    $user = htmlentities($user);
    $pass = mysqli_real_escape_string($connection, $password);
    $pass = htmlentities($pass);
    $pass = md5(md5("adadasd".$pass."adsadasd"));


    $query  ="SELECT * FROM `users` WHERE
    `username`='{$user}' AND `password`='{$pass}'";

    $result = mysqli_query($connection, $query);

    echo mysqli_error($connection);

    $numrows = mysqli_data_seek($result, -1);

    return $numrows;
}

function get_user_id($connection, $username, $password){

    $user = mysqli_real_escape_string($connection, $username);
    $user = htmlentities($user);
    $pass = mysqli_real_escape_string($connection, $password);
    $pass = htmlentities($pass);
    $pass = md5(md5("adadasd".$pass."adsadasd"));

    $users = array();

    $query = "SELECT `user_id` FROM `users`
              WHERE `username`='{$user}'
              AND `password`='{$pass}'";

    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($result)){
        $users[] = $row;
    }

    return $users;
}

function same_name_user($connection, $username){
    $user = mysqli_real_escape_string($connection, $username);
    $user = htmlentities($user);

    $query  = "SELECT COUNT(1) FROM `users`
    WHERE `username`='{$user}'";

    $result = mysqli_query($connection, $query);

    echo mysqli_error($connection);

    return (mysqli_data_seek($result,0) == '0')? false:true;

}

function category_exists($connection, $field, $value){
    $value = mysqli_real_escape_string($connection, $value);
    $value = htmlentities($value);
    $query = "SELECT * FROM categories WHERE ".$field." = ".$value;
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    $num = mysqli_num_rows($result);
    if($num > 0){
        return true;
    }
     return false;
}

function get_post($connection,$id=null, $cat_id = null){

    $posts = array();
    $query = "SELECT `post_id`,`categories`.`cat_id`,`post_name`,`post_text`,`post_date`,`categories`.`cat_name`
              FROM `posts`
              INNER JOIN `categories` ON `categories`.`cat_id` = `posts`.`cat_id`";

    if(isset($id)){
        $id = (int)$id;
        $query.=" WHERE `posts`.`post_id` = {$id}";
    }

    if(isset($cat_id)){
        $cat_id = (int)$cat_id;
        $query.=" WHERE `posts`.`cat_id` = {$cat_id}";
    }

    $query.= " ORDER BY `posts`.`post_id` DESC ";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    while($row = mysqli_fetch_assoc($result)){
        $posts[] = $row;
    }

    return $posts;
}

function get_categories($connection, $id=null){

    $categories = array();
    $query = "SELECT `cat_id`,`cat_name` FROM `categories`";
    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($result)){
        $categories[] = $row;
    }

    return $categories;
}

function get_categories_by_name($connection, $name=null){

    $name = mysqli_real_escape_string($connection, $name);
    $name = htmlentities($name);
    $categories = array();
    $query = "SELECT `cat_id`,`cat_name` FROM `categories` WHERE `cat_name` = '{$name}'";
    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($result)){
        $categories[] = $row;
    }

    return $categories;
}

function get_comments($connection,$post_id){

    $post_id = (int)$post_id;
    $comments = array();
    $query = "SELECT `comment_name`, `comment_text`, `comment_date`
              FROM   `comments`
              INNER JOIN `posts`
              WHERE `comments`.`post_id` = {$post_id}
              AND `posts`.`post_id` = {$post_id}";

    $result = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($result)){
        $comments[] = $row;
    }

    return $comments;
}


?>
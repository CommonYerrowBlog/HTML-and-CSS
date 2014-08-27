<?php
$title = "Comments";
include_once 'html/include/heather.php';
$posts = get_post($connection,$_GET['id']);

if(isset($_POST['Add']) ){
    $errors = array();

    $user = trim($_POST['username']);
    $user = htmlentities($user);
    $content = trim($_POST['content']);
    $content = htmlentities($content);

    if(empty($user)){
        $errors[]='You need to supply a username';
    }

    if(empty($content)){
        $errors[]='You need to supply some content';
    }

    if(strlen($user)>50){
        $errors[]='Username cannot be longer than 11 characters.';
    }

    if(empty($errors)){

        add_comment($connection,$user, $content, $_GET['id']);

        header("Location: index_post.php?id={$posts[0]['post_id']}");
        die();
    }
}

if(isset($errors) && ! empty($errors)){
    echo '<ul><li>',implode('</li><li>',$errors),'</li></ul>';
}
?>
    <form method="post" class="form">
        <input class="input" placeholder="Username" type="text" name="username" pattern="[A-Za-z0-9]{2,20}" required="true"><br>
        <textarea class="text" name="content" placeholder="Add your comment.." ></textarea><br>
        <input type="submit" class="submit" name="Add" value="Comment">

    </form>
<?php
include_once 'html/include/footer.php';
?>
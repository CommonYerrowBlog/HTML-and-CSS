<?php
include_once 'html/include/heather.php';

if(!isset($_GET['id'])){

    header("Location: index_post.php");
    die();
}
delete($connection,'posts',$_GET['id']);
header("Location: index_post.php");
die();
include_once 'html/include/footer.php';
?>
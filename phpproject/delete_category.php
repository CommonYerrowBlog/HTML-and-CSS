<?php
include_once 'html/include/heather.php';

//if(!isset($_GET['cat_id'])){
//
//    header("Location: index_post.php");
//    die();
//}

delete($connection,'categories',$_GET['id']);
header("Location: category_list.php");
die();

include_once 'html/include/footer.php';
?>
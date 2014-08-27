<?php
$title = "Posts";
include_once 'html/include/heather.php';
$posts = (isset($_GET['post_id']))? get_post($connection, $_GET['post_id']):get_post($connection);
?>
    <nav class="second-navigate">
        <ul>
            <li><a href="index_post.php">Index</a></li>
            <li><a href="add_post.php">Add a post</a></li>
            <li><a href="add_category.php">Add a Category</a></li>
            <li><a href="category_list.php">Category List</a></li>
        </ul>
    </nav>
    <?php
    foreach ($posts as $post) {
        if( ! category_exists($connection,'cat_id',$post['cat_id'])){
            $post['cat_name'] = 'Uncategorised';
        }
    ?>
            <div id="post_div">
                    <div id="post_title_div">
                    <p> <a href="index_post.php?id=<?= $post['post_id'];?>" id="post_title"><?= $post['post_name']; ?></a> </p>
                </div>
                <div id="post_text_div">
                    <p id="post_text"> <?= nl2br($post['post_text'])?>  </p>
                    <p id="post_date">Posted on: <?= date("d-m-Y h:i:S",strtotime($post['post_date']));?></p>
                    <div id="post_nav">
                        <a href="comments.php?id=<?= $post['post_id'];?>" id="comment_link">Comment</a>
                        <a href="delete_post.php?id=<?= $post['post_id'];?>" id="delete_link">Delete Post</a>
                        <a href="edit_post.php?id=<?= $post['post_id'];?>" id="edit_link">Edit Post</a>
                    </div>
                </div>
            </div>
            <?php
            foreach (get_comments($connection,$post['post_id']) as $comment) { ?>
                <div id="comment_div">
                    <div id="comment_left">
                        <img src="resources/avatar.png" class="avatar">
                        <p id="comment_name"> <?= $comment['comment_name']; ?> </p>
                    </div>
                    <div id="comment_right">
                        <p id="comment_text"> <?= $comment['comment_text']; ?> </p>
                        <p id="comment_date"> Commented on: <?=$comment['comment_date'];?></p>
                    </div>
                </div>
            <?php
            }
            ?>
<?php
}
include_once 'html/include/footer.php';
?>
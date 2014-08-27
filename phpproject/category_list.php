<?php
$title = "Category list";
include_once 'html/include/heather.php';

foreach (get_categories($connection) as $category) {
    ?>
    <span ><a href="category.php?id=<?= $category['cat_id']; ?>" class="tags"><?= $category['cat_name']; ?>-</a> </span>
    <span ><a href="delete_category.php?id=<?= $category['cat_id']; ?>" class="del-tag">Delete</a></span> <br/>

<?php
}
include_once 'html/include/footer.php';
?>
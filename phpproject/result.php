<?php
$title = "Result";
include_once 'html/include/heather.php';
$search = $_POST['search'];
?>
<?php
    foreach (get_categories_by_name($connection, $search) as $category) {
    ?>
    <span ><a href="category.php?id=<?= $category['cat_id']; ?>" class="tags"><?= $category['cat_name']; ?></a> </span>
<?php
    }
include_once 'html/include/footer.php';
?>
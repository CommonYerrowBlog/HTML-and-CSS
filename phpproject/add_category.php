<?php
$title = "Add Category";
include_once 'html/include/heather.php';

if(isset($_POST['addCat'])){
    $name = trim($_POST['name']);
    $name = htmlentities($name);

    if(empty($name)){
        $error = 'Add category name';
    }
    elseif(strlen($name)>24){
        $error = 'Category name can be no more than 24 characters';
    }

if(!strlen($error) > 0){
    add_category($connection,$name);

    header("Location: add_post.php");
    die();
}
}
?>
    <?php
    if(isset($error)){
        echo "<p>{$error}</p>";
    }
    ?>
    <form method="post" class="form">
        <h2>Add a Category!</h2>
            <input type="text" placeholder="Add Name.." class="input" name="name" required="true" pattern="[A-Za-z0-9]{2,20}">
            <input type="submit" class="submit" name="addCat" value="Add Category">
    </form>
<?php
include_once 'html/include/footer.php';
?>
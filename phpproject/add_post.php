<?php
$title = "Add Post";
include_once 'html/include/heather.php';

if(isset($_POST['postname'])&& isset($_POST['posttext'])&& isset($_POST['category'])){
    $errors = array();
    $added = array();

    $title = trim($_POST['postname']);
    $contents = trim($_POST['posttext']);

    if(empty($title)){
        $errors[]='You need to supply a title';
    }

    if(empty($contents)){
        $errors[]='You need to supply some text';
    }

    if(!category_exists($connection,'cat_id',$_POST['category'])){
        $errors[]='That category does not exists.';
    }

    if(strlen($title)>255){
        $errors[]='The title cannot be longer than 255 characters.';
    }

    if(empty($errors)){
        add_post($connection, $title, $contents, $_POST['category']);
        $added[]="Category added";

        $id = mysqli_insert_id($connection);
        header("Location: index_post.php?id={$id}");
        die();
    }
}
if(isset($added) && ! empty($added)){
    echo '<ul><li>',implode('</li><li>',$added),'</li></ul>';
}
?>
<form method="post" class="form">
        <input type="text" placeholder="Title" name="postname" class="input" required="true" pattern="[A-Za-z0-9А-Яа-я ]+" value="<?php if(isset($_POST['post_name'])) echo $_POST['post_name']; ?>" > <br/>
        <textarea class="text" name="posttext" placeholder="Add text.." rows="15" cols="50" required="true"><?php if(isset($_POST['post_text'])) echo $_POST['post_text']; ?></textarea> <br/>
        <label class="category" for="category"> Category </label>  <br/>
        <select name="category" class="select">
            <?php
            foreach (get_categories($connection) as $category) {
                ?>
                <option value="<?= $category['cat_id']; ?>"><?= $category['cat_name']; ?></option>
            <?php
            }
            ?>
        </select>  <br/>
        <input class="submit" name="submit"  type="submit" value="Add Post">
</form>
<?php
include_once 'html/include/footer.php';
?>
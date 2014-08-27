<?php
$title = "Login";
include_once 'html/include/heather.php';

if(isset($_POST['login'])){
    $errors = array();
    $added = array();

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(empty($username)){
        $errors[]='You need to supply a username';
    }

    if(empty($password)){
        $errors[]='You need to supply some text';
    }

    if(strlen($username)>50){
        $errors[]='Username cannot be longer than 50 characters.';
    }

    if(strlen($password)>50){
        $errors[]='Password cannot be longer than 50 characters.';
    }

    if(empty($errors) && same_name_user($connection,$username) != 0
        && is_user_loggedin($connection, $username, $password) == 0){

        $id = get_user_id($connection,$username, $password);
        header("Location: add_post.php?id={$id[0]['id']}");
        die();
    }
    else{
        header("Location: register.php?");
        die();
    }
}

    if(isset($errors) && ! empty($errors)){
        echo '<ul><li>',implode('</li><li>',$errors),'</li></ul>';
    }
    ?>
    <form method="post" class="form">
        <input type="text" class="input" name="username" placeholder="UserName" required="true" pattern="[A-Za-z]{2,20}"><br>
        <input type="password" class="text" name="password" placeholder="Password.." required="true" pattern="[A-Za-z0-9]{4,50}">
        <input type="submit" class="submit" name="login" value="Login">
    </form>
<?php
include_once 'html/include/footer.php';
?>
<?php
$title = "Register";
include_once 'html/include/heather.php';

if(isset($_POST['register'])){
    $errors = array();
    $added = array();

    $firstname = trim($_POST['firstname']);
    $secondname = trim($_POST['secondname']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

if(empty($firstname)){
    $errors[]='You need to supply a firstname';
}

if(empty($secondname)){
    $errors[]='You need to supply a second name';
}

if(empty($username)){
    $errors[]='You need to supply a username';
}

if(empty($password)){
    $errors[]='You need to supply some text';
}

if(strlen($firstname)>50){
    $errors[]='Firstname cannot be longer than 50 characters.';
}

if(strlen($secondname)>50){
    $errors[]='Second cannot be longer than 50 characters.';
}

if(strlen($username)>50){
    $errors[]='Username cannot be longer than 50 characters.';
}

if(strlen($password)>50){
    $errors[]='Password cannot be longer than 50 characters.';
}
//
//if(empty($errors) && same_name_user($connection,$username) != 0){
//
//    $id = get_user_id($connection,$username, $password);
//    header("Location: register.php?id={$id[0]['id']}");
//    die();
//}

if(empty($errors)){

    register_user($connection,$firstname, $secondname, $username, $password);
    header("Location: index_post.php?");
    die();
}
}
?>

    <form method="post" action="" class="form">
        <input class="input" placeholder="First Name" id="firstname" type="text" name="firstname" pattern="[A-Za-z]{2,20}" required="true"><br>
        <input class="input" placeholder="Last Name" id="secondname" type="text" name="secondname" pattern="[A-Za-z]{2,20}" required="true"><br>
        <input class="input" placeholder="UserName" id="username" type="text" name="username" pattern="[A-Za-z0-9]{2,20}" required="true"><br>
        <input class="input" placeholder="Password" id="password" type="password" name="password" pattern="[A-Za-z0-9]{2,20}" required="true"><br>
        <input class="submit" type="submit" name="register" value="Register">
    </form>

<?php
include_once 'html/include/footer.php';
?>
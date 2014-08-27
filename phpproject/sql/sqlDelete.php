<?php

function delete($connection,$table,$id){

    $table = mysqli_real_escape_string($connection,$table);
    $id = (int)$id;
    var_dump($table);
    var_dump(id);
    $query = "DELETE FROM `{$table}` WHERE  `cat_id` = {$id}";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
}

?>
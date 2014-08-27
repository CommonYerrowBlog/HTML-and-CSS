<?php
$connection = mysqli_connect('localhost', 'zontak', 'qwerty', 'phpprojectdatabase');
if(!$connection){
    echo "no database";
}
mysqli_set_charset($connection, 'utf8');

include_once 'sql/sqlDelete.php';
include_once 'sql/sqlInsert.php';
include_once 'sql/sqlSelect.php';
include_once 'sql/sqlUpdate.php';

?>
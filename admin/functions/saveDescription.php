<?php 
include '../../functions/sql_conn.php';

if(isset($_POST['checksum'])) {
    $data = $_POST['description'];
    $sql = "UPDATE `user_info` SET `value`='$data' WHERE `description` = 'description'";
    $query = mysqli_query($mysqli, $sql);
}
?>
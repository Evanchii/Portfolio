<?php 
include '../../functions/sql_conn.php';

if(isset($_POST['checksum'])) {
    $data = $_POST['overview'];
    $sql = "UPDATE `user_info` SET `value`='$data' WHERE `description` = 'overview'";
    $query = mysqli_query($mysqli, $sql);
}
?>
<?php 
include '../../functions/sql_conn.php';

if($_POST['id']) {
    $id = $_POST['id'];

    $sql = "UPDATE `visitor_query` SET `status`='1' WHERE `id` = $id";

    mysqli_query($mysqli, $sql);
}
?>
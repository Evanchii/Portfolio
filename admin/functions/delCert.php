<?php
include '../../functions/sql_conn.php';

if($_POST['id']) {
    $id = $_POST['id'];

    $sql = "DELETE FROM `certificates` WHERE `id` = $id";
    $q = mysqli_query($mysqli, $sql);

    unlink("../../assets/certificates/$id.png");
}
?>
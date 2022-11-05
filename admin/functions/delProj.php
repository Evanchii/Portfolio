<?php
include '../../functions/sql_conn.php';

if($_POST['id']) {
    $id = $_POST['id'];

    $sql = "SELECT `preview` FROM `projects` WHERE `id` = $id";
    $q = mysqli_query($mysqli, $sql);
    $prev = json_decode(mysqli_fetch_all($q)[0][0], true);

    $sql = "DELETE FROM `projects` WHERE `id` = $id";
    $q = mysqli_query($mysqli, $sql);

    //del all files
    unlink("../../assets/projects/$id.png");
    var_dump($prev);
    foreach($prev as $k => $v) {
        unlink("../../assets/projects/$v");
    }
}
?>
<?php
include "../../functions/sql_conn.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $title = $_POST['platformName'];
    $icon = str_replace('"', '\\"', $_POST['platformIcon']);
    $url = $_POST['platformURL'];

    $sql = "SELECT `additional_value` FROM `user_info` WHERE `description` = 'platforms'";
    $query = mysqli_query($mysqli, $sql);
    $data = mysqli_fetch_all($query);

    $platforms = json_decode($data[0][0], true);

    if(isset($platforms[$id])) {
        $platforms[$id] = [
            "title" => $title,
            "url" => $url,
            "fa" => $icon
        ];
    } else {
        $platforms[array_key_last($platforms)+1] = [
            "title" => $title,
            "url" => $url,
            "fa" => $icon
        ];
    }

    $sql = "UPDATE
            `user_info`
        SET
            `additional_value` = '".json_encode($platforms)."'
        WHERE
            `description` = 'platforms'";

    mysqli_query($mysqli, $sql);
}
?>

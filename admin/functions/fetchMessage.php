<?php
include '../../functions/sql_conn.php';

if($_POST['id']) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM `visitor_query` WHERE `id` = $id";

    $q = mysqli_query($mysqli, $sql);

    if(mysqli_num_rows($q)) {
        $d = mysqli_fetch_all($q)[0];
        echo <<<HTML
        <h5>Name:</h5>
        <p>{$d[1]}</p>
        <h6>Email:</h6>
        <a href="mailto:{$d[2]}">{$d[2]}</a>
        <br>
        <br>
        <h6>Message:</h6>
        <p>{$d[3]}</p>
        HTML;
    }
}
?>
<?php
include '../functions/sql_conn.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = hash_hmac('sha512', 'salt' . $_POST['pass'], 'thisIsAVeryRandomKeyUwU');

    $sql = "SELECT `value` FROM user_info WHERE `description` = 'email' OR `description` = 'password'";
    $result = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_all($result);
        var_dump($data);
        if ($data[0][0] == $email) {
            if ($data[1][0] == $password) {
                $_SESSION['logged_in'] = true;
                $_SESSION['email'] = $email;
                header('location: ../admin/dashboard.php');
            } else {
                echo "<script>alert('Password incorrect'); window.location.replace('../admin/');</script>";
            }
        } else {
            echo "<script>alert('Email incorrect'); window.location.replace('../admin/');</script>";
        }
    }
}

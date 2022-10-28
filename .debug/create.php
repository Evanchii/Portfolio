<?php 
    include '../functions/sql_conn.php';
    var_dump($_GET);
    $email = $_GET['email'];
    $pass = hash_hmac('sha512', 'salt' . $_GET['password'], 'thisIsAVeryRandomKeyUwU');

    $sql = "INSERT INTO `user_info`(`description`, `value`) VALUES ('email','$email')";
    var_dump(mysqli_query($mysqli, $sql));
    $sql = "INSERT INTO `user_info`(`description`, `value`) VALUES ('email','$pass')";
    var_dump(mysqli_query($mysqli, $sql));
?>
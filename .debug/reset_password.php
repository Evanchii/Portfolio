<?php 
    include '../functions/sql_conn.php';
    var_dump($_POST);
    $pass = hash_hmac('sha512', 'salt' . $_POST['password'], 'thisIsAVeryRandomKeyUwU');
    
    $sql = "UPDATE `user_info` SET `value`='$pass' WHERE `description` = 'password'";
    var_dump(mysqli_query($mysqli, $sql));
?>
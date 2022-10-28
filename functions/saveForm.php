<style>
    * {
        background: black;
    }
</style>
<?php 
include "sql_conn.php";

if(isset($_POST['saveForm'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO `visitor_query`(
        `name`,
        `email`,
        `message`
    )
    VALUES(
        '$name',
        '$email',
        '$message'
    )";

    $response = mysqli_query($mysqli, $sql);
    if($response) {
        echo "
            <script>
                alert('Form successfully submitted!');
                window.location.href = '../';
            </script>
        ";
    }
}
?>
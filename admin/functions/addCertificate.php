<?php
include '../../functions/sql_conn.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $file = $_FILES['certFile'];
    $title = mysqli_real_escape_string($mysqli, $_POST['certTitle']);
    $description = mysqli_real_escape_string($mysqli, $_POST['certDescription']);
    $date = mysqli_real_escape_string($mysqli, strtotime($_POST['certDate']));

    if($id == -1 && $file['name'] == "") {
        echo <<<HTML
        <script>
            alert("For new projects, Project logos are required");
            history.back();
        </script>
        HTML;
    } else {
        if($id == -1) {
            $sql = "INSERT INTO `certificates`(`title`, `description`, `date`) VALUES ('$title','$description','$date')";
        } else {
            $sql = "UPDATE `certificates` SET `title`='$title',`description`='$description',`date`='$date' WHERE `id` = '$id'";
        }
        echo $sql;
        $query = mysqli_query($mysqli, $sql);

        if($query) {
            if($id == -1) {
                $sql = "SELECT LAST_INSERT_ID()";
                $id = mysqli_fetch_all(mysqli_query($mysqli, $sql))[0];
            }

            if($file['name'] != "") {
                $url = "../../assets/certificates/".$id[0].".png";
                if(file_exists($url)) unlink($url);
                move_uploaded_file($file['tmp_name'], $url); 
            }

            echo <<<HTML
            <script>
                alert("Successfully uploaded");
                history.back();
            </script>
            HTML;

        } else {
            echo <<<HTML
            <script>
                alert("An error has occured!");
                // history.back();
            </script>
            HTML;
        }
    }
}
?>
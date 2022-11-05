<?php
include '../../functions/sql_conn.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $logo = $_FILES['projLogo'];
    $name = $_POST['projName'];
    $desc = $_POST['projDesc'];
    $date = strtotime($_POST['projDate']);
    $lead = $_POST['projLead'];
    $member = $_POST['projMember'];

    // var_dump($_FILES);
    // var_dump($_POST);

    if($id == -1 && $logo['name'] == "") {
        echo <<<HTML
        <script>
            alert("For new projects, Project logos are required");
            history.back();
        </script>
        HTML;
    } else {
        //convert member array to json;
        $memberJson = "{";
        if(gettype($member) == "array") {
            $i = 0;
            foreach($member as $k => $v) {
                if($v != "") {
                    $memberJson.="\"$i\" : \"$v\",";
                    $i++;
                }
            }
            $memberJson = rtrim($memberJson,',');
            $memberJson.="}";
        } else {
            if($member != "") {
                $memberJson.="\"0\" : \"$member\"}";
            } else {
                $memberJson.="}";
            }
        }

        if($id == -1) {
            $sql = "INSERT INTO `projects`(`title`, `description`, `createdAt`, `members`, `leader`) VALUES ('$name','$desc','$date','$memberJson','$lead')";
        } else {
            $sql = "UPDATE `projects` SET `title`='$name',`description`='$desc',`members`='$memberJson',`createdAt`='$date',`leader`='$lead' WHERE id = '$id'";
        }

        $query = mysqli_query($mysqli, $sql);

        // var_dump($query);

        if($query) {
            if($id == -1) {
                $sql = "SELECT LAST_INSERT_ID()";
                $id = mysqli_fetch_all(mysqli_query($mysqli, $sql))[0];
            }

            if($logo['name'] != "") {
                $url = "../../assets/projects/".$id[0].".png";
                if(file_exists($url)) unlink($url);
                move_uploaded_file($logo['tmp_name'], $url); 
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
                history.back();
            </script>
            HTML;
        }
    }
}
?>
<?php 
include "../../functions/sql_conn.php";

if(isset($_POST['projectID'])) {
    $ts = time();
    $fileID = $_POST['id'];
    $id = $_POST['projectID'];
    $file = $_FILES['ss'];

    echo "d";
    if($fileID == -1 && $file['name'] == ""){
        echo "<script>alert('File cannot be empty.');history.back();</script>";
        exit;
    }
    echo "e";

    $sql = "SELECT `preview` FROM `projects` WHERE `id` = '$id'";

    $query = mysqli_query($mysqli, $sql);
    echo "$sql";

    if(mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_all($query)[0][0];

        echo "c";
        if($file['name'] == "") {
            echo "A";
            $arr = json_decode($data);
            $del = $arr->$id;
            $arr->$id = "";
            $i = 0;
            $data1 = "{";
            foreach($arr as $k => $v) {
                if($v=="") continue;
                $data1.="\"$i\":\"$v\",";
                $i++;
            }
            $data1 = rtrim($data1, ",") . "}";

            $sql = "UPDATE `projects` SET `preview` = '$data1' WHERE `id` = '$id'";
            echo $sql;
            mysqli_query($mysqli, $sql);
            
            $url = "../../assets/projects/$del.png";
            if(file_exists($url)) unlink($url);
        } else {
            echo "B";
            if($fileID == -1) {
                $data1 = $data!="" ? rtrim($data, "}") : "{";
                $i = $data!="" ? count(json_decode($data, true)) : "0";
                $data1 .= ",\"".$i."\": \"$id-$ts.png\"}";

                if($data == "") $data1 = str_replace(",","",$data1);
            } else $data1 = $data;

            $url = "../../assets/projects/$id-$ts.png";
            if(file_exists($url)) unlink($url);
            move_uploaded_file($file['tmp_name'], $url);

            $sql = "UPDATE `projects` SET `preview` = '$data1' WHERE `id` = '$id'";

            echo $sql;

            mysqli_query($mysqli, $sql);
            echo <<<HTML
            <script>
                alert("Successfully Uploaded!");
                // history.back();
            </script>
            HTML;
        }
    }
}
?>
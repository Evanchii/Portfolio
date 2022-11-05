<?php 

if(isset($_FILES['cv'])) {
    $uploads_dir = "../../assets";
    foreach($_FILES["pictures"]["error"] as $key => $error) {
        if($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["cv"]["tmp_name"][$key];
            $name = "CV.pdf";
            if(file_exists("$uploads_dir/$name"))
                unlink("$uploads_dir/$name");
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
        }
    }
}
?>
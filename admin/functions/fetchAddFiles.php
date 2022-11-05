<?php
include '../../functions/sql_conn.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    echo '<input type="hidden" name="id" value="'.$id.'" id="id_addFiles">';

    $sql = "SELECT `preview` FROM `projects` WHERE `id` = $id";

    $query = mysqli_query($mysqli, $sql);

    if(mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_all($query)[0][0];
        if($data != "") {
            $jsonData = json_decode($data);

            foreach($jsonData as $k => $v) {
                echo <<<HTML
                <tr scope="row">
                    <td>
                        {$k}
                    </td>
                    <td><a href="../assets/projects/{$v}">Link</a></td>
                    <td>
                        <button type="button" onclick="editFile({$k}, {$id});" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa-solid fa-pen"></i></button>
                    </td>
                </tr>
                <tr class="spacer">
                    <td colspan="100"></td>
                </tr>
                HTML;
            }
        } else {
            echo "<tr><td colspan=\"3\">No data found</td></tr>";
        }
    }
}
?>
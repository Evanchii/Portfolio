<?php 
include '../../functions/sql_conn.php';

$sql = "SELECT `additional_value` FROM `user_info` WHERE `description` = 'platforms'";
$query = mysqli_query($mysqli, $sql);
$data = mysqli_fetch_all($query);

$platforms = json_decode($data[0][0], true);
// var_dump($platforms);
foreach($platforms as $k => $v) {
    echo <<<HTML
    <tr scope="row">
        <td>
        {$k}
        </td>
        <td>{$v["title"]}</td>
        <td><a href="{$v['url']}" target="_blank">{$v['url']}</a></td>
        <td>
        <button type="button" class="btn btn-outline-dark" title="Edit" data-bs-toggle="modal" data-bs-target="#updatePlatform" onclick="updatePlatform('{$k}');"><i class="fa-solid fa-pen"></i></button>
        </td>
    </tr>
    <tr class="spacer">
        <td colspan="100"></td>
    </tr>
    HTML;
}
?>
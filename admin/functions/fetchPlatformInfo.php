<?php 
include '../../functions/sql_conn.php';

$id = $_POST['id'];

$sql = "SELECT `additional_value` FROM `user_info` WHERE `description` = 'platforms'";
$query = mysqli_query($mysqli, $sql);
$data = mysqli_fetch_all($query);

$platforms = json_decode($data[0][0], true);

echo <<<HTML
    <form id="platformForm">
        <input type="hidden" name="id" value="{$id}">
        <div class="mb-3">
            <label for="platformName" class="form-label">Platform</label>
            <input type="text" class="form-control" id="platformName" name="platformName" placeholder="Platform" value="{$platforms[$id]['title']}">
        </div>
        <div class="mb-3">
            <label for="platformIcon" class="form-label">FontAwesome Icon</label>
            <input type="text" class="form-control" id="platformIcon" name="platformIcon" placeholder="<i>" value="{$platforms[$id]['fa']}">
        </div>
        <div class="mb-3">
            <label for="platformURL" class="form-label">URL</label>
            <input type="text" class="form-control" id="platformURL" name="platformURL" placeholder="example.com" value="{$platforms[$id]['url']}">
        </div>
    </form>
HTML;
?>
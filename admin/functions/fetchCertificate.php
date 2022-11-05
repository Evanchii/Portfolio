<?php
include '../../functions/sql_conn.php';

if($_POST['id']) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM `certificates` WHERE `id` = $id";
    $q = mysqli_query($mysqli, $sql);
    $d = mysqli_fetch_all($q)[0];
    $date = date("m/d/Y", $d[3]);

    echo <<<HTML
    <input type="hidden" name="id" value="{$id}">
    <div class="mb-3">
        <label for="formFile" class="form-label">Upload your Certificate here</label>
        <input class="form-control" type="file" id="certFile" name="certFile">
    </div>
    <div class="mb-3">
        <label for="certTitle" class="form-label">Title</label>
        <input type="text" class="form-control" id="certTitle" name="certTitle" placeholder="Best in Memes" value="{$d[1]}">
    </div>
    <div class="mb-3">
        <label for="certDescription" class="form-label">Description</label>
        <textarea type="text" class="form-control" id="certDescription" name="certDescription" placeholder="Lorem Ipsum">{$d[2]}</textarea>
    </div>
    <div class="mb-3">
        <label for="certDate" class="form-label">Date</label>
        <input type="text" class="form-control" id="certDate" name="certDate" placeholder="MM/DD/YYYY" value="{$date}">
    </div>
    HTML;
}

/*
<input type="hidden" name="id" value="-1">
<div class="mb-3">
    <label for="formFile" class="form-label">Upload your Certificate here</label>
    <input class="form-control" type="file" id="certFile" name="certFile">
</div>
<div class="mb-3">
    <label for="certTitle" class="form-label">Title</label>
    <input type="text" class="form-control" id="certTitle" name="certTitle" placeholder="Best in Memes">
</div>
<div class="mb-3">
    <label for="certDescription" class="form-label">Description</label>
    <input type="text" class="form-control" id="certDescription" name="certDescription" placeholder="Lorem Ipsum">
</div>
<div class="mb-3">
    <label for="certDate" class="form-label">Date</label>
    <input type="text" class="form-control" id="certDate" name="certDate" placeholder="MM/DD/YYYY">
</div>
*/
?>
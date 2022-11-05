<?php
include "../../functions/sql_conn.php";

if(isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM `projects` WHERE id = '$id'";

    $query = mysqli_query($mysqli, $sql);

    if(mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_all($query);

        echo <<<HTML
        <input type="hidden" name="id" value="{$id}">
        <div class="mb-3">
            <label for="projLogo" class="form-label">Upload Project Logo here</label>
            <p class="fs-6">Leave blank if doesn't need to be updated. (For updates)</p>
            <input class="form-control" type="file" name="projLogo" id="projLogo">
        </div>
        <div class="mb-3">
            <label for="projName" class="form-label">Title</label>
            <input type="text" class="form-control" id="projName" name="projName" placeholder="Best in Memes" value="{$data[0][1]}">
        </div>
        <div class="mb-3">
            <label for="projDesc" class="form-label">Description</label>
            <input type="text" class="form-control" id="projDesc" name="projDesc" placeholder="Lorem Ipsum" value="{$data[0][2]}">
        </div>
        <div class="mb-3">
            <label for="projDate" class="form-label">Date</label>
            <input type="text" class="form-control" id="projDate" name="projDate" placeholder="MM/DD/YYYY" value="{$data[0][3]}">
        </div>
        <div class="mb-3">
            <label for="projLead" class="form-label">Lead</label>
            <input type="text" class="form-control" id="projLead" name="projLead" placeholder="Juan Dela Cruz" value="{$data[0][5]}">
        </div>
        <div class="mb-3" id="membersInput">
            <label for="projMember" class="form-label">Member(s)</label>
            <p class="fs-6">If to be removed, leave the field blank</p>
        HTML;

        $memberJson = json_decode($data[0][4]);
        foreach($memberJson as $k => $v) {
            echo '<input type="text" class="form-control" name="projMember[]" placeholder="Member" value="'.$v.'">';
        }

        echo <<<HTML
        </div>
        <button type="button" class="btn btn-secondary" onclick="addMember();">Add Member Field</button>
        HTML;
    }
}
?>
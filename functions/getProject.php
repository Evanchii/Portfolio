<?php
include 'sql_conn.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM `projects` WHERE `id` = $id";
    $q = mysqli_query($mysqli, $sql);
    if(mysqli_num_rows($q) > 0) {
        $dta = mysqli_fetch_all($q)[0];
        // $date = date("F d, Y", $dta[3]);
        echo <<<HTML
        <div class="d-flex flex-row">
            <img src="assets/projects/1.png" class="w-10 mh-10" alt="">
            <div class="align-self-center">
                <h5>Title</h5>
                <small class="text-muted">Date</small>
            </div>
        </div>
        <p>Description</p>
        <h6>Team Name:</h6>
        <ul>
            <li>Leader</li>
            <li>Member 1</li>
            <li>Member 2</li>
            <li>Member 3</li>
        </ul>
        <h6>Screenshots:</h6>
        HTML;
    }
}
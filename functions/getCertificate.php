<?php
include 'sql_conn.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM `certificates` WHERE `id` = $id";
    $q = mysqli_query($mysqli, $sql);
    if(mysqli_num_rows($q) > 0) {
        $dta = mysqli_fetch_all($q)[0];
        $date = date("F d, Y", $dta[3]);
        echo <<<HTML
        <div>
            <img src="assets/certificates/{$dta[0]}.png" class="w-100" alt="">
            <div class="px-4 pt-3">
                <h4>{$dta[1]}</h4>
                <small class="text-muted">{$date}</small>
                <p class="pt-3">{$dta[2]}</p>
            </div>
        </div>
        HTML;
    }
}
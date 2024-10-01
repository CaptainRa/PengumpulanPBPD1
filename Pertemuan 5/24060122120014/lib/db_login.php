<!-- 
    Nama File   : db_login.php
    Deskripsi   : koneksi ke database
    Pembuat     : Rachmad Rifa'i / 24060122120014
    Tanggal     : 18 September 2024
-->

<?php
$db_host='localhost';
$db_database='bookdb';
$db_username='root';
$db_password='';

//connect database
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno) {
    die('Could not connect to the database: <br />'. $db->connect_error);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
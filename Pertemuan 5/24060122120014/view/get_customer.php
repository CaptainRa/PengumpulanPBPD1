<!-- 
    Nama File   : get_customer.php
    Deskripsi   : mengambil data customer
    Pembuat     : Rachmad Rifa'i / 24060122120014
    Tanggal     : 25 September 2024
-->

<?php
require_once('../lib/db_login.php');
$customerid = $_GET['id'];

// Assign a query
$query = " SELECT * FROM customers WHERE customerid=" .$customerid;
$result = $db->query($query);

if (!$result) {
    die("Could not query the database: <br />".$db->error);
}

// Fetch and display the results
while ($row = $result->fetch_object()) {
    echo 'Name: '.$row->name.'<br />';
    echo 'Address: '.$row->address.'<br />';
    echo 'City: '.$row->city.'<br />';
}

$result->free();
$db->close();
?>

<!-- 
File      : add_customer_get.php
Deskripsi : menampilkan data scustomer
Nama      : Qun Alfadrian Setyowahyu Putro
NIM       : 24060122130072
-->

<?php 
  require_once('../lib/db_login.php');
  $name = $db->real_escape_string($_GET['name']);
  $address = $db->real_escape_string($_GET['address']);
  $city = $db->real_escape_string($_GET['city']);

  // assign query
  $query = "INSERT INTO customers (name, address, city) VALUES('".$name."','"
            .$address."','".$city."')";
  $result = $db->query($query);
  if (!$result) {
    echo  '<div class="aler alert-danger alert-dismissible">
            <strong>Error!</strong> Could not query the database <br>'
            .$db->error
            .'<br>query = '.$query
          .'</div>';
  } else {
    echo  '<div class="alert alert-success alert-dismissible">
            <strong>Success!</strong> Data has been added. <br>
            Name: '.$name.'<br>
            Address: '.$address.'<br>
            City: '.$city.'<br>
          </div>';
  }

  // close db connection
  $db->close();
?>
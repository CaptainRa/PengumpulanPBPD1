<!--Nama : Muhammad Naufal -->
<!--NIM : 24060120140157 -->
<!--Tanggal Pengerjaan : 24-09-2024 -->
<?php
    session_start();
    if(isset($_SESSION['cart'])){
        unset($_SESSION['cart']);
    }

    header('Location: show_cart.php');
?>
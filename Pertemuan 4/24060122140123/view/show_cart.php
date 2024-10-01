<!-- 
Nama                   : Alya Safina
NIM                    : 24060122140123
Tanggal pengerjaan     : 25 September 2024 
-->

<?php
// Memulai sesi
session_start();

// Menambahkan barang ke keranjang
if (isset($_GET['id']) && $_GET['id'] != "") {
    $id = $_GET['id'];
    // Barang pertama dimasukkan ke keranjang
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    // Jika ingin menambah jumlah barang yang sama di keranjang
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}
?>

<!-- Tampilan untuk menampilkan buku yang ada di cart -->
<?php include('./header.php'); ?>
<br>
<div class="card">
    <div class="card-header">Show Cart</div>
    <div class="card-body">
    <br>
        <table class="table table-striped">
            <tr>
                <th>ISBN</th>
                <th>Author</th>
                <th>Title</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Price * Qty</th>
            </tr>
            <?php
                require_once('../lib/db_login.php');
                $sum_qty = 0;   
                $sum_price = 0; 

                if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $id => $qty) {
                        $query = "SELECT * FROM books WHERE isbn = '".$id."'";
                        $result = $db->query($query);
                        if (!$result) {
                            die ("Could not query the database: <br>" . $db->error . "<br>Query: " . $query);
                        }

                        while ($row = $result->fetch_object()) {
                            $price_qty = $row->price * $qty; 
                            echo '<tr>';
                            echo '<td>'.$row->isbn.'</td>';  
                            echo '<td>'.$row->author.'</td>'; 
                            echo '<td>'.$row->title.'</td>';  
                            echo '<td>$'.$row->price.'</td>'; 
                            echo '<td>'.$qty.'</td>'; 
                            echo '<td>$'.$price_qty.'</td>'; 
                            echo '</tr>';

                            $sum_qty += $qty; 
                            $sum_price += $price_qty;
                        }
                    }

                    echo '<tr><td></td><td></td><td></td><td></td><td>'.$sum_qty.'</td><td>$'.$sum_price.'</td></tr>';
                    $result->free();
                    $db->close();
                } 
                else {
                    echo '<tr><td colspan="6" align="center">There is no item in the shopping cart</td></tr>';
                }
            ?>
        </table>
        Total items = <?php echo $sum_qty; ?> <br><br>
        <a class="btn btn-primary" href="view_books.php">Continue Shopping</a>
        <a class="btn btn-danger" href="delete_cart.php">Empty Cart</a><br><br />
    </div>
</div>
<?php include('./footer.php'); ?>

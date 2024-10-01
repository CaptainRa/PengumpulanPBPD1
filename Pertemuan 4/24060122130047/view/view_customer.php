<!-- 
 Nama: Tirza Aurellia Wijaya
 NIM: 24060122130047
 Tanggal Pengerjaan: 24 Sept 2024 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <?php
        session_start();    //inisialisasi session
        if (!isset($_SESSION['username'])) {
            header('Location: login.php');
        }

        include('../header.php');
    ?>
    <div class="card">
        <div class="card-header">Customer Data</div>
        <div class="card-body">
            <a href="add_customer.php" class="btn btn-primary">+ Add Customer Data</a><br /><br />
            <table class="table table-striped">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
                <?php
                    // Include login information
                    require_once('../lib/db_login.php');

                    // Execute the query
                    $query = "SELECT * FROM customers ORDER BY customerid";
                    $result = $db->query($query);
                    if (!$result) {
                        die("Could not query the database: <br />" . $db->error . "<br>Query: " . $query);
                    }

                    // Fetch and display the result
                    $i = 1;
                    while ($row = $result->fetch_object()) {
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$row->name.'</td>';
                        echo '<td>'.$row->address.'</td>';
                        echo '<td>'.$row->city.'</td>';
                        echo '<td>
                                <a class="btn btn-warning btn-sm" href="edit_customer.php?id='.$row->customerid.'">Edit</a>&nbsp;&nbsp;
                                <a class="btn btn-danger btn-sm" href="confirm_delete_customer.php?id='.$row->customerid.'">Delete</a>
                              </td>';
                        echo '</tr>';
                        $i++;
                    }
                ?>
            </table>
            <br />
            <?php
                echo 'Total Rows = ' . $result->num_rows;
                $result->free();
                $db->close();
            ?>
            <br>
            <div class = "d-flex justify-content-end">
            <a class="btn btn-danger" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>

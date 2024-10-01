<!--
Nama         : Qun Alfadrian
NIM          : 24060122130072
Tanggal      : 30/09/2024
File         : show_customer.php
Deskripsi    : untuk menampilkan form customer
-->

<?php require_once('./header.php') ?>
<div class="row w-50 mx-auto mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header">Show Customer Data</div>
            <div class="card-body">
                <select name="customer" id="customer" class="form-select" onchange="showCustomer(this.value)">
                    <option value="">-- Select a Customer --</option>
                    <?php
                    require_once('./lib/db_login.php');

                    $query = " SELECT * FROM customers ORDER BY customerid ";
                    $result = $db->query($query);

                    if (!$result) {
                        die("Could not query the database: <br>".$db->error);
                    }

                    while ($row = $result->fetch_object()) {
                        echo '<option value="'.$row->customerid.'">'.$row->name.'</option>';
                    }

                    $result->free();
                    $db->close();
                    ?>
                </select>
                <br>
                <div id="detail_customer"></div>
            </div>
        </div>
    </div>
</div>
<?php require_once('./footer.php'); ?>
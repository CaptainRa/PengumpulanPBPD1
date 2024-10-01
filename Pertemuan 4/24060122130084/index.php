<?php
// Nama/NIM Pembuat  : Nashwan Adenaya / 24060122130084
// Tanggal Pembuatan : 20 September 2024
// File              : index.php (login.php)
// Deskripsi         : tampilan awal untuk melakukan login

session_start();

if(isset($_SESSION['username'])){
    header('Location: admin.php');
}

require_once 'lib/db_login.php';

 if (isset($_POST["submit"])) {
    $valid = true;
    
    $email = test_input($_POST['email']);
    if ($email == '') {
        $error_email = "Email is required";
        $valid = FALSE;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Invalid email format";
        $valid = FALSE;
    }

    $password = test_input($_POST['password']);
    if ($password == '') {
        $error_password = "Password is required";
        $valid = FALSE;
    }

    if ($valid) {
        $query = " SELECT * FROM admin WHERE email='" . $email . "' AND password='" . $password . "' ";
        // echo '$password';
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br/>" . $db->error);
        } else {
            if ($result->num_rows > 0) {
                $_SESSION['username'] = $email;
                header('Location: admin.php');
                exit;
            } else {
                echo '<span class="error">Combination of username and password are not correct.</span>';
            }
        }
        $ceke = $_POST["email"];
        $cekp = $_POST['password'];

        $db->close();
    }
}

?>
<?php include('./header.html') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Login Form</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($email)) echo $email; ?>">
                <div class="error"><?php if (isset($error_email)) echo $error_email ?></div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="">
                <div class="error"><?php if (isset($error_password)) echo $error_password ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
        </form>
    </div>
</div>
<?php include('./footer.html') ?>
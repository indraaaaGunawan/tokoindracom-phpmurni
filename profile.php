<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id ='" . $_SESSION['a_global']->admin_id . "' ");
$d = mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || TOKO INDRA COM</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dasboard.php">TOKO INDRA COM</a></h1>
            <ul>
                <li><a href="dasboard.php">Dashboard</a></li>
                <li><a href="profile.php">Profil</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="keluar.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Profile</h3>
            <div class="class box">
                <form action="" method="post">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $_SESSION['a_global']->admin_name ?>" required>
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $_SESSION['a_global']->username ?>" required>
                    <input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo $_SESSION['a_global']->admin_telp ?>" required>
                    <input type="text" name="email" placeholder="Email" class="input-control" value="<?php echo $_SESSION['a_global']->admin_email ?>" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $_SESSION['a_global']->admin_address ?>" required>
                    <input type="submit" name="submit" value="Ubah Profile" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) {

                    $name   = ucwords($_POST['nama']);
                    $user   = $_POST['user'];
                    $hp     = $_POST['hp'];
                    $email  = $_POST['email'];
                    $alamat = ucwords($_POST['alamat']);

                    $update = mysqli_query($conn, "UPDATE tb_admin SET
                                        admin_name = '" . $name . "',
                                        username = '" . $user . "',
                                        admin_telp = '" . $hp . "',
                                        admin_email = '" . $email . "',
                                        admin_address = '" . $alamat . "'
                                        WHERE admin_id = '" . $d->admin_id . "' ");
                    if ($update) {
                        echo '<script>alert("Ubah data berhasil")</script>';
                        echo '<script>window.location="profile.php"</script>';
                    } else {
                        echo 'gagal' . mysqli_error($conn);
                    }
                }
                ?>
            </div>
            <h3>Ubah Password</h3>
            <div class="class box">
                <form action="" method="post">
                    <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                    <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
                    <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
                </form>
                <?php
                if (isset($_POST['ubah_password'])) {

                    $pass1   = $_POST['pass1'];
                    $pass2   = $_POST['pass2'];

                    if ($pass2 != $pass1) {
                        echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
                    } else {
                        $u_pass = mysqli_query($conn, "UPDATE tb_admin SET
                                        password = '" . md5($pass1) . "'
                                        WHERE admin_id = '" . $d->admin_id . "' ");
                        if ($u_pass) {
                            echo '<script>alert("Ubah Password berhasil")</script>';
                            echo '<script>window.location="profile.php"</script>';
                        } else {
                            echo 'gagal' . mysqli_error($conn);
                        }
                    }
                }
                ?>
            </div>

        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy;2023- INDRA COM</small>
        </div>
    </footer>
</body>

</html>
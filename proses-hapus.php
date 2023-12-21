<?php
include 'db.php';

if (isset($_GET['idk'])) {
    $delete = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '" . $_GET['idk'] . "' ");
    if ($delete) {
        echo '<script>alert("Delete Category Success")</script>';
        echo '<script>window.location="data-kategori.php"</script>';
    } else {
        echo 'Failed' . mysqli_error($conn);
    }
}
if (isset($_GET['idp'])) {
    $produk = mysqli_query($conn, "SELECT product_image FROM tb_product WHERE product_id = '" . $_GET['idp'] . "' ");
    $p = mysqli_fetch_object($produk);

    // hapus file gambar yang ada di folder produk
    unlink('./produk/' . $p->product_image);

    $delete = mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = '" . $_GET['idp'] . "' ");
    if ($delete) {
        echo '<script>alert("Delete Product Success")</script>';
        echo '<script>window.location="data-produk.php"</script>';
    } else {
        echo 'Failed' . mysqli_error($conn);
    }
}

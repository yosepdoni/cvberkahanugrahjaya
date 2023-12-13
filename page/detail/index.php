<?php
if (isset($_GET['slug'])) {
    $slug = $_GET["slug"];

    $query  = "SELECT * FROM produk WHERE slug='$slug'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($koneksi));
    }

    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan pada database');window.location='index.php';</script>";
    }
} else {
    echo "<script>alert('Masukkan data slug.');window.location='index.php';</script>";
}

if ($_SESSION['level'] != '2') {
    header('Location: login.php');
    exit;
}

?>
<!-- Content -->
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12 mt-3">
            <h3>
                Detail Produk
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img class="card-img card-img-left" src="admin/assets/img/produk/<?= $data['gambar'] ?>" alt="<?= $data['nama'] ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $data['nama'] ?></h5>
                            <p class="card-text"><small class="text-muted"><?= $data['keterangan'] ?></small></p>
                            <p class="card-text fs-5"><b>Rp <?= number_format($data['harga'], 0, ',', '.') ?></b></p>
                            <p class="card-text">Berat <b><?= $data['berat'] ?></b> Gram</p>
                            <p class="card-text">Stok <b><?= $data['stok'] ?></b></p>
                            <form action="" method="post">
                                <button type="submit" name="tambah-keranjang" class="btn btn-primary">Tambahkan ke Keranjang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['tambah-keranjang'])) {
    $idUser = $_SESSION['id'];
    $idProduk = $data['id'];

    // Periksa apakah produk sudah ada di keranjang
    $query  = "SELECT * FROM keranjang WHERE id_user = '$idUser' AND id_produk = '$idProduk'";
    $result = mysqli_query($koneksi, $query);
    if (mysqli_num_rows($result) > 0) {
        // Jika produk sudah ada, lakukan pembaruan qty
        $updateQuery = "UPDATE keranjang SET qty = qty + 1 WHERE id_user = '$idUser' AND id_produk = '$idProduk'";
        $updateResult = mysqli_query($koneksi, $updateQuery);
        if (!$updateResult) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        } else {
            echo "<script>alert('Jumlah produk dalam keranjang telah diperbarui.');window.location='index.php?page=detail&slug=" . $data['slug'] . "';</script>";
        }
    } else {
        // Jika produk belum ada, lakukan penambahan
        $insertQuery = "INSERT INTO keranjang (id_user, id_produk, qty) VALUES ('$idUser', '$idProduk', 1)";
        $insertResult = mysqli_query($koneksi, $insertQuery);
        if (!$insertResult) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        } else {
            echo "<script>alert('Produk telah ditambahkan ke keranjang belanja.');window.location='index.php?page=detail&slug=" . $data['slug'] . "';</script>";
        }
    }
}
?>


<!-- / Content -->
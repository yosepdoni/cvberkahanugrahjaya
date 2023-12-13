<?php
if ($_SESSION['level'] != '2') {
    header('Location: login.php');
    exit;
}

?>
<!-- Content -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mt-3">
            <h3 class="text-dark">
                Keranjang Belanja
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 mt-3">
            <?php
            $idUser = $_SESSION['id'];
            $query = "SELECT keranjang.*, produk.nama as nama_produk, produk.harga as harga_produk, produk.gambar as gambar_produk
                    FROM keranjang
                    JOIN produk ON keranjang.id_produk = produk.id
                    WHERE keranjang.id_user = '$idUser';
                    ";
            $result = mysqli_query($koneksi, $query);

            // Mendapatkan total qty & harga
            $totalQtyHargaQuery = "SELECT keranjang.*, produk.harga as harga_produk
                                    FROM keranjang
                                    JOIN produk ON keranjang.id_produk = produk.id
                                    WHERE keranjang.id_user = '$idUser'";
            $totalQtyHargaResult = mysqli_query($koneksi, $totalQtyHargaQuery);

            $totalQty = 0;
            $totalHarga = 0;

            while ($data = mysqli_fetch_assoc($totalQtyHargaResult)) {
                $qty = $data['qty'];
                $harga = $data['harga_produk'];

                $totalQty += $qty;
                $totalHarga += ($qty * $harga);
            }

            if (!$result) {
                die("Query failed: " . mysqli_error($koneksi));
            }

            while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img class="card-img card-img-left" src="admin/assets/img/produk/<?= $row['gambar_produk'] ?>" alt="<?= $data['nama'] ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['nama_produk'] ?></h5>
                                <p class="card-text"><small class="text-muted"><?= $row['keterangan'] ?></small></p>
                                <p class="card-text fs-5"><b>Rp <?= number_format($row['harga_produk'], 0, ',', '.') ?></b></p>
                                <a href="?page=keranjang&aksi=kurang&id=<?= $row['id'] ?>" class="mr-3">
                                    <i class='bx bx-minus'></i>
                                </a>
                                <span class="font-weight-bold mr-3"><?= $row['qty'] ?></span>
                                <a href="?page=keranjang&aksi=tambah&id=<?= $row['id'] ?>" class="mr-3">
                                    <i class='bx bx-plus'></i>
                                </a>
                                <a href="?page=keranjang&aksi=hapus&id=<?= $row['id'] ?>" class="text-danger mt-2 d-block">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Rincian Belanja</h5>
                    <p class="card-text"><span class="float-end fw-bold"><?= $totalQty ?></span>Total Barang</p>
                    <p class="card-text"><span class="float-end fw-bold">Rp <?= number_format($totalHarga, 0, ',', '.') ?></span>Total Harga</p>
                    <a href="?page=checkout" class="btn btn-success">Checkout</a>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- / Content -->
<?php
if ($_SESSION['level'] != '2') {
    header('Location: login.php');
    exit;
}

if (isset($_GET['no'])) {
    $no = $_GET["no"];

    $queryPesanan  = "SELECT * FROM pesanan WHERE no_pesanan='$no'";
    $resultPesanan = mysqli_query($koneksi, $queryPesanan);

    if (!$resultPesanan) {
        die("Query failed: " . mysqli_error($koneksi));
    }

    $dataPesanan = mysqli_fetch_assoc($resultPesanan);

    if (!$dataPesanan) {
        echo "<script>alert('Data tidak ditemukan pada database');window.location='?page=pesanan';</script>";
    }
} else {
    echo "<script>alert('Masukkan nomor pesanan.');window.location='?page=pesanan';</script>";
}

?>
<!-- Content -->
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12 mt-3">
            <h3>
                Detail Pesanan :</span> <?= $no; ?>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card shadow-none border border-primary mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-1">
                            <p class="card-text">
                                Nama
                            </p>
                        </div>
                        <div class="col-lg-11">
                            <b>
                                : <?= $dataPesanan['nama'] ?>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            <p class="card-text">
                                No HP
                            </p>
                        </div>
                        <div class="col-lg-11">
                            <b>
                                : <?= $dataPesanan['no_hp'] ?>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            <p class="card-text">
                                Alamat
                            </p>
                        </div>
                        <div class="col-lg-11">
                            <b>
                                : <?= $dataPesanan['alamat'] ?>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            <p class="card-text">
                                No Resi
                            </p>
                        </div>
                        <div class="col-lg-11">
                            <b>
                                : <?= $dataPesanan['no_resi'] ?>
                            </b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="page/pesanan/cetak_detail.php?no=<?= $no; ?>" target="_blank" class="btn rounded-pill btn-success">Cetak</a>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap mt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>QTY</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                $no = 1;
                                $id = $dataPesanan['id'];
                                // $query = "SELECT * FROM detail_pesanan WHERE id_pesanan = '$id'";
                                $queryDetailPesanan = "SELECT detail_pesanan.*, produk.nama as nama_produk, produk.harga as harga_produk
                                            FROM detail_pesanan
                                            JOIN produk ON detail_pesanan.id_produk = produk.id
                                            WHERE detail_pesanan.id_pesanan = '$id';
                                        ";
                                $resultDetailPesanan = mysqli_query($koneksi, $queryDetailPesanan);


                                if (!$resultDetailPesanan) {
                                    die("Query failed: " . mysqli_error($koneksi));
                                }

                                while ($rowDetailPesanan = mysqli_fetch_assoc($resultDetailPesanan)) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $rowDetailPesanan['nama_produk']; ?></td>
                                        <td><?= number_format($rowDetailPesanan['harga_produk'], 0, ',', '.'); ?></td>
                                        <td><?= $rowDetailPesanan['qty']; ?></td>
                                        <td align="right"><?= number_format($rowDetailPesanan['harga_produk'] * $rowDetailPesanan['qty'], 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                                <tr>
                                    <th colspan="4">Total Harga</th>
                                    <td align="right"><b><?= number_format($dataPesanan['total_harga'], 0, ',', '.'); ?></b></td>
                                </tr>
                                <tr>
                                    <th colspan="4">Biaya Ongkir</th>
                                    <td align="right"><b><?= number_format($dataPesanan['ongkos_kirim'], 0, ',', '.'); ?></b></td>
                                </tr>
                                <tr>
                                    <th colspan="4">Total Bayar</th>
                                    <td align="right"><b><?= number_format($dataPesanan['total_bayar'], 0, ',', '.'); ?></b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <form action="" method="POST">
                                            <input name="id_user" type="hidden" class="form-control" value="<?= $dataPesanan['id_user'] ?>">
                                            <input name="id" type="hidden" class="form-control" value="<?= $dataPesanan['id']; ?>">
                                            <!-- <button name="diterima" type="submit" class="btn  <?= $dataPesanan['info'] == 'Paket diterima' ? 'btn-success disabled' : 'btn-warning'; ?>" id="btn-pilih-pembayaran"><?= $dataPesanan['info'] ?></button> -->
                                            <button name="diterima" type="submit" class="btn  <?= $dataPesanan['info'] == 'Paket diterima' ? 'btn-success disabled' : 'btn-warning'; ?>" id="btn-pilih-pembayaran"><?php if ($dataPesanan['info'] == 'Dalam Pengiriman') { $statusPengiriman = 'Konfirmasi Penerimaan'; } else { $statusPengiriman = $dataPesanan['info']; } ?> <?= $statusPengiriman ?> </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once './koneksi.php';
if (isset($_POST['diterima'])) {
    // Menangkap data yang dikirim dari form
    $id_user = $_POST['id_user'];
    $id = $_POST['id'];
    $statusinfo = 'Paket diterima';

    // Menghindari SQL Injection dengan menggunakan prepared statement
    $query = "UPDATE pesanan SET info=? WHERE id_user=? AND id=?";
    $stmt = mysqli_prepare($koneksi, $query);

    // Bind parameter ke prepared statement
    mysqli_stmt_bind_param($stmt, "sii", $statusinfo, $id_user, $id);

    // Eksekusi prepared statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "<script>alert('Terima kasih telah mengkonfirmasi penerimaan produk');</script>";
        echo "<script>window.location.href='?page=pesanan'</script>";
    } else {
        echo "Terjadi kesalahan saat memperbarui data: " . mysqli_error($koneksi);
    }

    // Tutup prepared statement
    mysqli_stmt_close($stmt);
}
?>
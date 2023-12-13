<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Data Master /</span> Produk
    </h4>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="?page=produk&aksi=tambah" class="btn rounded-pill btn-success">Tambah</a>
                            <a href="page/produk/cetak.php" target="_blank" class="btn rounded-pill btn-success">Cetak</a>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap mt-3">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Supplier</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Berat</th>
                                    <th>Keterangan</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                $no = 1;
                                $query = "SELECT produk.*, kategori.nama as nama_kategori, supplier.nama as nama_supplier
                                        FROM produk
                                        JOIN kategori ON produk.id_kategori = kategori.id
                                        JOIN supplier ON produk.id_supplier = supplier.id;
                                        ";
                                $result = mysqli_query($koneksi, $query);


                                if (!$result) {
                                    die("Query failed: " . mysqli_error($koneksi));
                                }

                                while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama_kategori']; ?></td>
                                        <td><?= $row['nama_supplier']; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= number_format($row['harga'], 0, ',', '.') ?></td>
                                        <td><?= $row['stok']; ?></td>
                                        <td><?= $row['berat']; ?></td>
                                        <td><?= substr($row['keterangan'], 0, 20) . '...'; ?></td>
                                        <td>
                                            <a href="assets/img/produk/<?= $row['gambar']; ?>" target="_blank">
                                                <img src="assets/img/produk/<?= $row['gambar']; ?>" alt="" srcset="" width="80">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="?page=produk&aksi=edit&id=<?= $row['id']; ?>" class="btn rounded-pill btn-info"><i class='bx bx-pencil'></i></a>
                                            <a href="?page=produk&aksi=hapus&id=<?= $row['id']; ?>" class="btn rounded-pill btn-danger" onclick="return confirm('Anda yakin akan menghapus data tersebut?')"><i class='bx bx-trash'></i></a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(function() {
        $('#table').DataTable();
    });
</script>
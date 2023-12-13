<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Data Master /</span> Produk
    </h4>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <h5 class="card-header">Tambah Produk</h5>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="id_kategori">Kategori *</label>
                            <div class="col-sm-10">
                                <select name="id_kategori" id="id_kategori" class="form-select">
                                    <?php
                                    $query = "SELECT * from kategori";
                                    $result = mysqli_query($koneksi, $query);
                                    if (!$result) {
                                        die("Query failed: " . mysqli_error($koneksi));
                                    }

                                    while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="id_supplier">Supplier *</label>
                            <div class="col-sm-10">
                                <select name="id_supplier" id="id_supplier" class="form-select">
                                    <?php
                                    $query = "SELECT * from supplier";
                                    $result = mysqli_query($koneksi, $query);
                                    if (!$result) {
                                        die("Query failed: " . mysqli_error($koneksi));
                                    }

                                    while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="nama">Nama *</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="harga">Harga *</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="harga" name="harga" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="stok">Stok *</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="stok" name="stok" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="berat">Berat *</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="berat" name="berat" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="keterangan">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="gambar">Gambar  *</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="gambar" name="gambar" required>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $id_kategori = $_POST['id_kategori'];
    $id_supplier = $_POST['id_supplier'];
    $nama = $_POST['nama'];
    $slug = str_replace(' ', '-', $nama);
    $slug = strtolower($slug);
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $berat = $_POST['berat'];
    $keterangan = $_POST['keterangan'];
    $gambar = $_FILES['gambar']['name'];

    $allowed_types = array('png', 'jpg');
    $x = explode('.', $gambar);
    $extension = strtolower(end($x));
    $file_temp = $_FILES['gambar']['tmp_name'];
    $random_number = rand(1, 999);
    $file_name = $random_number . '-' . $gambar;

    // Periksa apakah nama produk sudah ada di database
    $query_check = "SELECT COUNT(*) FROM produk WHERE nama = '$nama'";
    $result_check = mysqli_query($koneksi, $query_check);
    $row = mysqli_fetch_array($result_check);
    $product_count = $row[0];

    if ($product_count > 0) {
        echo "<script>alert('Nama produk sudah ada di database. Gagal menambahkan data produk.');window.location='?page=produk&aksi=tambah';</script>";
    } elseif (in_array($extension, $allowed_types)) {
        move_uploaded_file($file_temp, 'assets/img/produk/' . $file_name);

        $query  = "INSERT INTO produk (id_kategori, id_supplier, nama, slug, harga, stok, berat, keterangan, gambar) VALUES ('$id_kategori', '$id_supplier', '$nama', '$slug', '$harga', '$stok', '$berat', '$keterangan', '$file_name')";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        } else {
            echo "<script>alert('Data berhasil ditambah.');window.location='?page=produk';</script>";
        }
    } else {
        echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='?page=produk&aksi=tambah';</script>";
    }
}

?>
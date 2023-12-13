<?php
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
                Pesanan
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive text-nowrap mt-3">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nomor</th>
                                    <th>Tanggal</th>
                                    <th>Pembayaran</th>
                                    <th>Status Bayar</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                $no = 1;
                                $idUser = $_SESSION['id'];
                                $query = "SELECT * FROM pesanan WHERE id_user = '$idUser' ";
                                $result = mysqli_query($koneksi, $query);

                                if (!$result) {
                                    die("Query failed: " . mysqli_error($koneksi));
                                }

                                while ($row = mysqli_fetch_assoc($result)) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><a class="text-danger" href="?page=pesanan&aksi=detail&no=<?= $row['no_pesanan']; ?>"><?= $row['no_pesanan']; ?></a></td>
                                        <td><?= date('j M Y', strtotime($row['tanggal'])); ?></td>
                                        <td>Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?></td>
                                        <td><span class="badge rounded-pill <?= $row['status'] == 'Belum Bayar' ? 'bg-warning' : 'bg-success'; ?>"><?= $row['status'] ?></span></td>
                                        <td>
                                            <!-- <button type="button" class="btn btn-primary" id="pilih-pembayaran" <?= $row['status'] == 'Belum Bayar' ? '' : 'disabled'; ?> data-snaptoken="<?= $row['snap_token'] ?>">Pilih Pembayaran</button> -->
                                            <?php if ($row['status'] === 'Belum Bayar') : ?>
                                                <button type="button" class="btn btn-info" data-snaptoken="<?= $row['snap_token'] ?>" id="btn-pilih-pembayaran">Pilih Pembayaran</button>
                                            <?php else : ?>
                                                <button type="button" class="btn btn-info" id="btn-pilih-pembayaran" disabled>Pilih Pembayaran</button>
                                            <?php endif; ?>
                                            
                                        </td>
                                        <td>

                                        <span class="badge rounded-pill p-2 <?= $row['info'] == 'Paket diterima' ? 'bg-success' : 'bg-warning' ; ?>" ><?= $row['info'] ?></span>
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

<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    // var payButton = document.getElementById('pilih-pembayaran');
    // payButton.addEventListener('click', function() {
    //     console.log('OK')
    // });

    // const nodes = element.getElementsByTagName("p");
</script>

<script>
    $(document).on('click', '#btn-pilih-pembayaran', function() {
        const snapToken = $(this).data('snaptoken');
        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                /* You may add your own implementation here */
                // alert("payment success!");
                // console.log(result);
                window.location = '?page=pesanan'
            },
            onPending: function(result) {
                /* You may add your own implementation here */
                alert("wating your payment!");
                // console.log(result);
            },
            onError: function(result) {
                /* You may add your own implementation here */
                alert("payment failed!");
                // console.log(result);
            },
            onClose: function() {
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
            }
        });
    });
</script>
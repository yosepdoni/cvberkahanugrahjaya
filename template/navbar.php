<nav class="navbar navbar-example navbar-expand-lg bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">CV Berkat Anugrah Jaya</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ex-3">
            <div class="navbar-nav me-auto">
                <span class="nav-item nav-link" href="javascript:void(0)"></span>
            </div>

            <?php if ($_SESSION['level'] == '2') : ?>
                <a class="nav-item nav-link text-white" href="?page=keranjang">Keranjang</a>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['nama']; ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=pesanan">Pesanan</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            <?php else : ?>
                <a class="btn btn-dark" href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
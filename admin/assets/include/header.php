<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <h1 class="sitename">Mizan Amanah</h1><span>.</span>
        </a>
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index.php" class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>">Beranda</a></li>
                <li><a href="about.php" class="<?= ($currentPage == 'about.php') ? 'active' : '' ?>">Tentang</a></li>
                <li><a href="berita.php" class="<?= ($currentPage == 'berita.php') ? 'active' : '' ?>">Berita</a></li>
                <li><a href="donete.php" class="<?= ($currentPage == 'donete.php') ? 'active' : '' ?>">Donasi</a>
                </li>
                <li><a href="grografis.php" class="<?= ($currentPage == 'grografis.php') ? 'active' : '' ?>">Kontak</a>
                </li>
                <li class="nav-item d-flex align-items-center gap-3">
                    <?php if (isset($_SESSION['user'])): ?>
                    <!-- Link ke profil -->
                    <a class="nav-link d-flex align-items-center gap-2" href="profile.php">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['user']['username']) ?>&background=random&color=fff"
                            alt="Avatar" class="rounded-circle" width="32" height="32">
                        <span
                            class="d-none d-md-inline"><?= htmlspecialchars($_SESSION['user']['username'] ?? '-') ?></span>
                    </a>
                    <a href="logout.php" onclick="return confirm('Yakin ingin logout?')" title="Logout"
                        class="logout-icon d-flex align-items-center">
                        <i class="bi bi-box-arrow-right fs-5 text-danger"></i>
                    </a>
                    <?php else: ?>
                    <!-- Jika belum login -->
                    <a href="login.php"
                        class="btn btn-sm btn-outline-success d-flex align-items-center gap-1 <?= ($currentPage == 'login.php') ? 'active' : '' ?>">
                        <i class="bi bi-person-circle"></i> SignIn / SignUp
                    </a>
                    <?php endif; ?>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>
<nav class="navbar navbar-expand-lg my-nav">
  <div class="container d-flex align-items-center">

    <!-- Tombol Back -->
    <button class="back-btn" onclick="history.back()">
        <i class="bi bi-arrow-left-circle"></i>
    </button>

    <!-- Brand -->
    <a class="navbar-brand d-flex align-items-center" href="index.php">
        <img src="assets/logo-umj.png" class="logo-umj">
        <span class="brand-text">UMJ Dashboard</span>
    </a>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler custom-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarku">
      <i class="bi bi-list" style="font-size:26px; color:white;"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarku">
      <ul class="navbar-nav ms-auto nav-links">

        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['PHP_SELF'])=='index.php') echo 'active'; ?>" href="index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php if(basename($_SERVER['PHP_SELF'])=='mahasiswa.php') echo 'active'; ?>" href="mahasiswa.php">Data Mahasiswa</a>
        </li>

      </ul>
    </div>

  </div>
</nav>

<style>
/* NAVBAR WRAPPER */
.my-nav {
    background: rgba(255,255,255,0.03) !important;
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(0,255,255,0.18);
    box-shadow: 0 0 15px rgba(0,255,255,0.05);
}

/* LOGO */
.logo-umj {
    height: 42px;
    margin-right: 12px;
    filter: drop-shadow(0 0 6px #00eaff);
}

/* BRAND TEXT */
.brand-text {
    font-weight: 600;
    color: #00eaff;
    font-size: 20px;
    text-shadow: 0 0 10px rgba(0,255,255,0.4);
}

/* BACK BUTTON */
.back-btn {
    background: none;
    border: none;
    margin-right: 12px;
    font-size: 28px;
    color: #00eaff;
    cursor: pointer;
    transition: 0.25s;
}
.back-btn:hover {
    text-shadow: 0 0 12px #00eaff;
    transform: translateX(-3px);
}

/* NAV LINKS */
.nav-links .nav-link {
    color: #e6e6e6;
    margin-left: 18px;
    font-weight: 500;
    transition: 0.25s;
    padding-bottom: 4px;
    border-bottom: 2px solid transparent;
}
.nav-links .nav-link:hover {
    color: #00eaff;
    text-shadow: 0 0 8px #00eaff;
    border-bottom: 2px solid #00eaff;
}
.nav-links .active {
    color: #00eaff !important;
    border-bottom: 2px solid #00eaff !important;
    text-shadow: 0 0 10px #00eaff;
}

/* Mobile Button */
.custom-toggle {
    border: none;
    background: rgba(0, 0, 0, 0.25);
    padding: 6px 10px;
    border-radius: 8px;
    backdrop-filter: blur(5px);
}
</style>

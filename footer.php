<footer class="footer-clean">
    <div class="container text-center py-3">
        <div class="footer-title">Muhammad Rayyan Ghifari</div>
        <p class="footer-copy">© <?= date('Y'); ?> • All Rights Reserved</p>
    </div>
</footer>

<style>
footer.footer-clean {
    width: 100%;
    padding: 20px 0;
    background: rgba(255,255,255,0.03);
    border-top: 1px solid rgba(0,255,255,0.15);
    backdrop-filter: blur(10px);
    margin-top: auto;
}

.footer-title {
    font-size: 18px;
    font-weight: 600;
    color: #00eaff;
    text-shadow: 0 0 10px rgba(0,255,255,0.5);
}

.footer-copy {
    font-size: 13px;
    color: #bcbcbc;
}

/* PEMBENERAN POSISI FOOTER */
html, body {
    height: 100%;
}
body {
    display: flex;
    flex-direction: column;
}
</style>

<!DOCTYPE html>
<html>
<head>
    <title>Home - Dashboard UMJ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">

<style>
body {
    background: #0d1117;
    color: white;
    font-family: 'Poppins', sans-serif;
    opacity: 0;
    transition: opacity 0.5s ease;
}
body.fade-in { opacity: 1; }

.hero {
    margin-top: 90px;
    text-align: center;
}

.bismillah {
    font-size: 32px;
    font-weight: 600;
    margin-bottom: 25px;
    color: #00eaff;
    font-family: 'Amiri', serif;
    text-shadow: 0 0 12px rgba(0,255,255,0.4);
}

.hero h1 {
    font-size: 42px;
    font-weight: 600;
    color: #00eaff;
    text-shadow: 0 0 15px rgba(0,255,255,0.5);
}

.hero p {
    font-size: 18px;
    color: #cccccc;
    margin-top: 15px;
}

.btn-start {
    margin-top: 25px;
    padding: 12px 25px;
    background: #00eaff;
    border-radius: 8px;
    font-weight: 600;
    color: black;
    transition: .3s;
}
.btn-start:hover {
    box-shadow: 0 0 15px #00eaff;
    transform: translateY(-2px);
}
</style>
</head>

<body>

<?php include("navbar.php"); ?>

<div class="container hero">

    <div class="bismillah">
        بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ
    </div>

    <h1>Selamat Datang di Dashboard Administrasi Data Mahasiswa UMJ</h1>
    <p>"Mengelola data mahasiswa dengan mudah insyaallah".</p>

    <a href="mahasiswa.php" class="btn btn-start">Masuk sebagai Admin →</a>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    document.body.classList.add("fade-in");
});

document.querySelectorAll("a").forEach(a=>{
    a.addEventListener("click",function(e){
        const target = this.getAttribute("href");
        if(!target.startsWith("#")){
            e.preventDefault();
            document.body.style.opacity=0;
            setTimeout(()=>location.href=target,300);
        }
    });
});
</script>

<?php include("footer.php"); ?>
<script>
// Perbaikan BACK button agar tidak blank
window.addEventListener("pageshow", function(event) {
    if (event.persisted) {
        document.body.style.opacity = 1;
    }
});
</script>

</body>
</html>

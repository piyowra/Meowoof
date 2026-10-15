<?php  
session_start();
$koneksi = new mysqli("localhost","root","","petshop_db");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Registrasi Pelanggan Meowoof Petshop</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Meowoof Petshop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">   
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="keranjang.php">Keranjang</a></li>
                        <?php if(isset($_SESSION["pelanggan"])):?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                        <?php else:?>
                            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <?php endif?>
                        <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
<section class="py-5">
 <div class="container px-3 px-lg-4 mt-4">
    <div class="row g-5">
        <div class="col-md-6 mx-auto">
             <div class="card">
                <div class="card-header">
                  <h3 class="mb-0">Registrasi Pelanggan</h3>
             </div>
             <div class="card-body">
                    <form method="post">
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="mb-3">
                        <label>No.Telepon</label>
                        <input type="number" class="form-control" name="telepon">
                    </div>
                
                    <button class="btn btn-primary" name="save">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
    </section>

<?php
if (isset($_POST['save'])) 
{
    
    $koneksi->query("INSERT INTO pelanggan
    (email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan)
    VALUES('$_POST[email]','$_POST[password]','$_POST[nama]','$_POST[telepon]')");

    echo "<div class='alert alert-info'>Data Tersimpan</div>";
    echo "<script>location='login.php';</script>";
}
?>
       <!-- Footer-->
       <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Meowoof Petshop 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
</body>
</html>
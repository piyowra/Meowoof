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
        <title>Meowoof Petshop</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
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
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Meowoof Petshop</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Menyediakan Kebutuhan Kucing dan Anjing</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-3 px-lg-4 mt-4">
                
                <div class="row g-5">
                <h3>Produk Untuk Kucing</h3>
                        
                            <div class="card h-100">
                                <?php $ambil=$koneksi->query("SELECT * FROM produk where nama_produk like '%kucing%'");?>
                                <?php while($perproduk=$ambil->fetch_assoc()){?>
                                <div class="col-md-3">
                                    <div class="thumbnail">
                                        <img class="card-img-top"  src="foto_produk/<?php echo $perproduk['foto_produk'];?>" width="100">
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <h5 class="fw-bolder"><?php echo $perproduk['nama_produk'];?></h5>
                                                <h5>Rp. <?php echo number_format($perproduk['harga_produk']);?></h5>
                                            </div>
                                        </div>
                                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="beli.php?id=<?php echo $perproduk['id_produk'];?>">Masukkan Keranjang</a></div>
                                    </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                       
                <h3>Produk Untuk Anjing</h3>
                    <div class="col mb-5">
                            <div class="card h-100">
                                <?php $ambil=$koneksi->query("SELECT * FROM produk where nama_produk like '%Anjing%'");?>
                                <?php while($perproduk=$ambil->fetch_assoc()){?>
                                <div class="col-md-3">
                                    <div class="thumbnail">
                                        <img class="card-img-top"  src="foto_produk/<?php echo $perproduk['foto_produk'];?>" width="100">
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <h5 class="fw-bolder"><?php echo $perproduk['nama_produk'];?></h5>
                                                <h5>Rp. <?php echo number_format($perproduk['harga_produk']);?></h5>
                                            </div>
                                        </div>
                                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="beli.php?id=<?php echo $perproduk['id_produk'];?>">Masukkan Keranjang</a></div>
                                    </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                </div>
            </div>
        </section>
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
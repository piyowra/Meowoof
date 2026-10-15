<?php 
session_start();

$koneksi = new mysqli ("localhost","root","","petshop_db");

if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
    echo "<script>alert('Keranjang kosong, silahkan belanja dulu');</script>";
    echo "<script>location='index.php';</script>";

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Keranjang Anda</title>
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
        <h1>Keranjang Belanja</h1>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subharga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor=1; ?>
                <?php foreach($_SESSION["keranjang"] as $id_produk => $jumlah):?>
                <?php 
                $ambil = $koneksi->query("SELECT * FROM  produk WHERE id_produk='$id_produk'");
                $pecah = $ambil->fetch_assoc();
                $subharga = $pecah["harga_produk"]*$jumlah;  
                ?>
                <tr>
                    <td><?php echo $nomor;?></td>
                    <td><?php echo $pecah["nama_produk"];?></td>
                    <td>Rp. <?php echo number_format($pecah["harga_produk"]);?></td>
                    <td><?php echo $jumlah;?></td>
                    <td>Rp. <?php echo number_format($subharga);?></td>
                    <td><a href="hapuskeranjang.php?id=<?php echo $id_produk ;?>" class="btn btn-danger btn-xs">Hapus</a></td>
                </tr>
                <?php $nomor++; ?>
                <?php endforeach ?>
            </tbody>
        </table>

        <a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
        <a href="checkout.php" class="btn btn-primary">Checkout</a>

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
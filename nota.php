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
        <title>Nota Anda</title>
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

        <h2>Detail Pembelian</h2>
            <?php 
            $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan 
            WHERE pembelian.id_pembelian='$_GET[id]'");

            $detail = $ambil->fetch_assoc()
            ?>

            <strong><?php echo $detail['nama_pelanggan'];?></strong> <br>
            <p>
                <?php echo $detail['telepon_pelanggan'];?> <br>
                <?php echo $detail['email_pelanggan'];?> 
            </p>
            <p>
                Tanggal : <?php echo $detail['tanggal_pembelian'];?> <br>
                Total   : Rp.  <?php echo number_format($detail['total_pembelian']);?> 
            </p>

            <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor=1; ?>
                        <?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk 
                        WHERE pembelian_produk.id_pembelian='$_GET[id]'");?>
                        <?php while($pecah=$ambil->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo $nomor;?></td>
                            <td><?php echo $pecah ['nama_produk'];?></td>
                            <td>Rp. <?php echo number_format($pecah ['harga_produk']);?></td>
                            <td><?php echo $pecah ['jumlah'];?></td>
                            <td>Rp. 
                                <?php echo number_format($pecah ['harga_produk']*$pecah['jumlah']);?>
                            </td>
                        </tr>
                        <?php $nomor++;?>
                        <?php } ?>
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-7">
                        <div class="alert alert-info">
                            <p>
                                Silakan melakukan pembayaran sebesar Rp. <?php echo number_format($detail['total_pembelian']);?> ke <br>
                                <strong>BANK BRI 001-101-000-111-101 AN. Meowoof Petshop</strong>
                            </p>
                        </div>
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
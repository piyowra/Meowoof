<?php  
session_start();
$koneksi = new mysqli("localhost","root","","petshop_db");

if(!isset($_SESSION["pelanggan"])){
    echo "<script>alert('Silakan login')</script>";
    echo "<script>location='login.php'</script>";

}
?>

<!DOCTYPE html>
<html lang="en">
<head>

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Checkout Meowoof Petshop</title>
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
                </tr>
            </thead>
            <tbody>
                <?php $nomor=1; ?>
                <?php $totalbelanja=0;?>
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
                </tr>
                <?php $nomor++; ?>
                <?php $totalbelanja+=$subharga?>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan='4'>Total Belanja</th>
                    <th>Rp. <?php echo number_format($totalbelanja)?> </th>
                </tr>
            </tfoot>
        </table>

        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]["nama_pelanggan"]?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]["telepon_pelanggan"]?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="id_ongkir">
                        <option value="">Pilih Ongkos Kirim</option>
                        <?php
                        $ambil=$koneksi->query("SELECT * FROM ongkir");
                        while($perongkir=$ambil->fetch_assoc()){
                        ?>
                        <option value="<?php echo $perongkir["id_ongkir"]?>">
                            <?php echo $perongkir['nama_kota'] ?> -- Rp. <?php echo number_format($perongkir['tarif'])?>
                        </option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary" name="checkout">Checkout</button>
        </form>
        
        <?php 
        
        if(isset($_POST["checkout"])){

            $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
            $id_ongkir = $_POST["id_ongkir"];
            $tanggal_pembelian = date("Y-m-d");

            $ambil=$koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
            $arrayongkir=$ambil->fetch_assoc();
            $tarif=$arrayongkir['tarif'];

            $total_pembelian = $totalbelanja+$tarif;
        
        $koneksi->query("INSERT INTO pembelian (
            id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian) 
            VALUES ('$id_pelanggan', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian')"
             );


        $id_pembelian_barusan= $koneksi->insert_id;
           foreach($_SESSION["keranjang"] as $id_produk=>$jumlah)
           {
               $koneksi->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, jumlah) VALUES ('$id_pembelian_barusan', '$id_produk', '$jumlah') ");

            }

            unset($_SESSION["keranjang"]);


            echo "<script>alert('Pembelian Berhasil!');</script>";
            echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";

        }
        ?>


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
<?php
session_start ();
if(!isset($_SESSION['user'])){
  ?>
  <script type="text/javascript">
    alert('login dulu');window.location='index.php';
  </script>
  <?php
}else{
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>E-Libarary LP3I COLLEGE KUPANG</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/one-page-wonder.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">E-library</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <?php 
                  $koneksi = mysqli_connect("localhost","root","","perpus"); 
                  $menu=mysqli_query($koneksi,"select * from kategori where kode_kategori = 3");
                  while($data= $menu->fetch_assoc()){
                  echo $data['nama']; }
              ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ic.php">
              <?php 
                  $koneksi = mysqli_connect("localhost","root","","perpus"); 
                  $menu=mysqli_query($koneksi,"select * from kategori where kode_kategori = 4");
                  while($data= $menu->fetch_assoc()){
                  echo $data['nama']; }
              ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ba.php">
              <?php 
                  $koneksi = mysqli_connect("localhost","root","","perpus"); 
                  $menu=mysqli_query($koneksi,"select * from kategori where kode_kategori = 5");
                  while($data= $menu->fetch_assoc()){
                  echo $data['nama']; }
              ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ca.php">
              <?php 
                  $koneksi = mysqli_connect("localhost","root","","perpus"); 
                  $menu=mysqli_query($koneksi,"select * from kategori where kode_kategori = 6");
                  while($data= $menu->fetch_assoc()){
                  echo $data['nama']; }
              ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Log OUT</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="masthead text-center text-white">
    <div class="masthead-content">
      <div class="container">
        <h1 class="masthead-heading mb-0">E-Library </h1>
        <h2 class="masthead-subheading mb-0">Read for your success</h2>
      </div>
    </div>
    <div class="bg-circle-1 bg-circle"></div>
    <div class="bg-circle-2 bg-circle"></div>
    <div class="bg-circle-3 bg-circle"></div>
    <div class="bg-circle-4 bg-circle"></div>
  </header>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
          <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label>Siswa</label>
                        <select name= "nim" id="nim" class="form-control" type="text">
                            <option>Siswa</option>
                                                                
                                    <?php
                                       $koneksi= mysqli_connect("localhost","root","","perpus");
                                        $data = mysqli_query($koneksi,"SELECT * FROM siswa ");
                                        while ($sql = mysqli_fetch_array($data)) 
                                            { ?>
                                                <option value='<?php echo $sql['nim'] ?>'><?php echo $sql ['nim'] ?> | <?php echo $sql['nama'] ?></option>
                                            <?php } ?>
                                </select>
                  </div>
                  <div class="form-group">
                    <label>Buku</label>
                        <select name= "SIBN" id="SIBN" class="form-control" type="text">
                            <option>Buku</option>
                                                                
                                    <?php
                                       $koneksi= mysqli_connect("localhost","root","","perpus");
                                        $data = mysqli_query($koneksi,"SELECT * FROM buku ");
                                        while ($sql = mysqli_fetch_array($data)) 
                                            { ?>
                                                <option value='<?php echo $sql['SIBN'] ?>'><?php echo $sql ['nama_buku'] ?> | <?php echo $sql['stock'] ?></option>
                                            <?php } ?>
                                </select>
                  </div>
                  <div class="form-group">
                    <label> Tanggal Pinjam </label>
                    <input class = "form-control" type="text" name="tgl_mulai" id="tgl" value="<?php echo $tgl_pinjam;?>" readonly />
                  </div>
                  <div class="form-group">
                  <label>Limit Tanggal Pengembalian </label>
                  <input class = "form-control" type="text" name="tgl_end" id="tgl" value="<?php echo $kembali;?>" readonly />
                </div>
                <div class="form-group">
                  <label>Jumlah Buku</label>
                      <input class="form-control" type ="number" name="stock" min="1" max="3" value= "1" required/>
                    </select>
                </div>
                  <div class="form-group">
                    <div class="card-footer">
                    <button type="submit" name='simpan' value='simpan' class="btn btn-success mr-2">Save</button>
                    </div>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Footer -->
  <footer class="py-5 bg-black">
    <div class="container">
      <p class="m-0 text-center text-white small">Copyright &copy; LP3I COLLEGE LP3I</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php
}?>

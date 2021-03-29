<?php
session_start ();
include "header.php";
include "function.php";
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php $sql = mysqli_query($kon,"SELECT count(nim) AS jumlah FROM siswa");
		 								 while($data= $sql->fetch_assoc()){
											 echo $data['jumlah'];
										 }?></h3>

                <p>Data Siswa</p>
              </div>
              <a href="siswa.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <h3><?php $sql = mysqli_query($kon,"SELECT count(SIBN) AS jumlah FROM buku");
		 								 while($data= $sql->fetch_assoc()){
											 echo $data['jumlah'];
										 }?></h3>
                <p>Data Buku</p>
              </div>
              <a href="buku.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <h3><?php $sql = mysqli_query($kon,"SELECT count(id_pinjam) AS jumlah FROM pinjaman");
		 								 while($data= $sql->fetch_assoc()){
											 echo $data['jumlah'];
										 }?></h3>

                <p>Data pinjam buku</p>
              </div>
              <a href="pinjam.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php
    include "footer.php";
  ?><!-- /.content-wrapper -->
  
</body>
</html>

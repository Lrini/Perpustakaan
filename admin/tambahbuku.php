<?php
session_start ();
include "function.php";
include "header.php";
?>
       <?php if(isset($_GET['r'])): ?>
                    <?php
                        $r = $_GET['r'];
                        if($r=='sukses'){
                            $class='success';
                        }else if($r=='updated'){
                            $class='info';   
                        }else if($r=='gagal'){
                            $class='danger';   
                        }else if($r=='added an account'){
                            $class='success';   
                        }else{
                            $class='hide';
                        }
                    ?>
                   <div role="alert" class="alert alert-<?php  echo $class?> ">
                        
                        <strong> <?php echo $r; ?>!</strong>    
                    </div>
                <?php endif; ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Input Buku</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
                $koneksi = new mysqli("localhost", "root", "", "perpus");
                $id = $_GET['SIBN'];
                $data = mysqli_query($koneksi,"select * from buku where SIBN='$id'");
                while($d = mysqli_fetch_array($data)){
            ?>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label>ISBN</label>
                    <label>No ISBN jangan diganti</label>
                    <input type="text" class="form-control" name="SIBN" value="<?php echo $d ['SIBN'] ?>" required='required'/>
                  </div>
                  <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" class="form-control" name="nama_buku" value="<?php echo $d ['nama_buku'] ?>" required='required'/>
                  </div>
                  <div class="form-group">
                    <label>Kategori</label>
                        <select name= "kategori" id="kategori" class="form-control" type="text">
                            <option>Kategori</option>
                                                                
                                    <?php
                                       $koneksi= mysqli_connect("localhost","root","","perpus");
                                        $data = mysqli_query($koneksi,"SELECT * FROM kategori ");
                                        while ($sql = mysqli_fetch_array($data)) 
                                            { ?>
                                                <option value='<?php echo $sql['kode_kategori'] ?>'><?php echo $sql ['kode_kategori'] ?> | <?php echo $sql['nama'] ?></option>
                                            <?php } ?>
                                </select>
                  </div>
                  <div class="form-group">
                    <label>Pengarang</label>
                    <input type="text" class="form-control" name="pengarang" value="<?php echo $d ['pengarang'] ?>" required='required'/>
                  </div>
                  <div class="form-group">
                    <label>Stock Buku</label>
                    <input type="text" class="form-control" name="stock" value="<?php echo $d ['stock'] ?>" required='required'/>
                  </div>
                  <div class="form-group">
                    <label>Gambar</label>
                    <br>
                    <label>untuk foto besar maks 1mb dan nama foto tidak menggunakan spasi</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" placeholder="foto Buku">
                  </div>
                    <div class="card-footer">
                    <button type="submit" name='simpan' value='simpan' class="btn btn-success mr-2">Save</button>
                    </div>
                </div>
              </form>
              <?php 
                 if(isset($_POST['simpan'])){
                    if(editbuku ($_POST) > 0){
                        echo " 
                             <script>
                                document.location.href = 'buku.php?r=sukses';
                            </script>";
                            }else{
                                echo " 
                                    <script>
                                        document.location.href = 'buku.php?r=gagal';
                                     </script>";
                                }
                    }
            	}
	        ?>
          </section>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php
    include "footer.php";
  ?><!-- /.content-wrapper -->
  
</body>
</html>

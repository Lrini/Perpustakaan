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
                <h3 class="card-title">Form Input siswa</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
                $koneksi = new mysqli("localhost", "root", "", "perpus");
                $id = $_GET['nim'];
                $data = mysqli_query($koneksi,"select * from siswa where nim='$id'");
                while($d = mysqli_fetch_array($data)){
            ?>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label>NIM</label>
                    <label>Nim jangan diganti</label>
                    <input type="text" class="form-control" name="nim" value="<?php echo $d ['nim'] ?>" required='required'/>
                  </div>
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $d ['nama'] ?>" required='required'/>
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="alamat" value="<?php echo $d ['alamat'] ?>" required='required'/>
                  </div>
                  <div class="form-group">
                    <label>Jurusan</label>
                        <select name= "jurusan" id="jurusan" class="form-control" type="text">
                            <option>jurusan</option>
                                                                
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
                    <label>No telpon</label>
                    <input type="text" class="form-control" name="no_tlp" value="<?php echo $d ['no_tlp'] ?>" required='required'/>
                  </div>
                  <div class="form-group">
                    <label>Dosen PA</label>
                    <input type="text" class="form-control" name="dosen_pa" value="<?php echo $d ['dosen_pa'] ?>" required='required'/>
                  </div>
                    <div class="card-footer">
                    <button type="submit" name='simpan' value='simpan' class="btn btn-success mr-2">Save</button>
                    </div>
                </div>
              </form>
              <?php 
                 if(isset($_POST['simpan'])){
                    if(editsiswa ($_POST) > 0){
                        echo " 
                             <script>
                                document.location.href = 'siswa.php?r=sukses';
                            </script>";
                            }else{
                                echo " 
                                    <script>
                                        document.location.href = 'siswa.php?r=gagal';
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

<?php
session_start ();
if(!isset($_SESSION['username'])){
  ?>
  <script type="text/javascript">
    alert('login dulu');window.location='admin.php';
  </script>
  <?php
}else{
include "header.php";
include "function.php";
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
                $id = $_GET['kode_kategori'];
                $data = mysqli_query($koneksi,"select * from kategori where kode_kategori='$id'");
                while($d = mysqli_fetch_array($data)){
            ?>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label>Kode kategori</label>
                    <label>Kode kategori jangan diganti</label>
                    <input type="text" class="form-control" name="kode_kategori" value="<?php echo $d ['kode_kategori'] ?>" required='required'/>
                  </div>
                  <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $d ['nama'] ?>" required='required'/>
                  </div>
                    <div class="card-footer">
                    <button type="submit" name='simpan' value='simpan' class="btn btn-success mr-2">Save</button>
                    </div>
                </div>
              </form>
              <?php 
                 if(isset($_POST['simpan'])){
                    if(editkategori ($_POST) > 0){
                        echo " 
                             <script>
                                document.location.href = 'kategori.php?r=sukses';
                            </script>";
                            }else{
                                echo " 
                                    <script>
                                        document.location.href = 'kategori.php?r=gagal';
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
<?php
}
?>
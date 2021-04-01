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
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" class="form-control" id="nama_buku" name="nama_buku" placeholder="Nama Buku">
                  </div>
                  <div class="form-group">
                    <label>Jurusan</label>
                        <select name= "kategori" id="kategori" class="form-control" type="text">
                            <option>Jurusan</option>
                                                                
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
                    <input type="text" class="form-control" id="pengarang" name="pengarang" placeholder="Pengarang Buku">
                  </div>
                  <div class="form-group">
                    <label>Stock Buku</label>
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="Stock Buku">
                  </div>
                  <div class="form-group">
                    <label>Gambar</label>
                    <br>
                    <label>untuk foto besar maks 1mb dan nama foto tidak menggunakan spasi</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" placeholder="foto Buku">
                    <div class="card-footer">
                    <button type="submit" name='simpan' value='simpan' class="btn btn-success mr-2">Save</button>
                    </div>
                </div>
              </form>
              <?php
                if(isset($_POST['simpan'])){
                    if(tambahbuku ($_POST) > 0){
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
            ?>
                <div class="card">
          </section>
        </div>
       <div class="card-body">
                      <table id="dataTables" class="table table-bordered table-striped" >
                              <thead>
                                  <tr>
                                      <th>NO.</th>
                                      <th>ID</th>
                                      <th>Nama Buku</th>
                                      <th>Pengarang</th>
                                      <th>Stock Buku</th>
                                      <th>Jurusan</th>
                                      <th>Gambar</th>
                                      <th>Pilihan</th>
                                  </tr>
                              </thead>
                          
                          <tbody>
                            <?php
                            $conn = new mysqli("localhost", "root", "", "perpus");
                            if ($conn->connect_errno) {
                              echo "Failed to connect to MySQL: " . $conn->connect_error;
                            }
                            
                            $no = 1;
                            $res = $conn->query("select * FROM buku INNER JOIN kategori WHERE buku.kode_kategori = kategori.kode_kategori");
                            while($row = $res->fetch_assoc()){
                              echo '
                              <tr>
                                <td>'.$no.'</td>
                                <td>'.$row['SIBN'].'</td>
                                <td>'.$row['nama_buku'].'</td>
                                <td>'.$row['pengarang'].'</td>
                                <td>'.$row['stock'].'</td>
                                <td>'.$row['nama'].'</td>
                                <td><img src="../data/'.$row['gambar'].'" width="70" height="90"></td>
                                <td>
                                 <a href ="tambahbuku.php?SIBN='.$row['SIBN'].'"><i class="btn btn-block btn-primary btn-sm">edit</i></a>
                                 <a href ="hapusbuku.php?SIBN='.$row['SIBN'].'"><i class="btn btn-block btn-danger btn-sm">hapus</i></a>
                                </td>
                              </tr>
                              ';
                              $no++;
                            }
                            ?>
                          </tbody>
                        </table>
                </div>
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

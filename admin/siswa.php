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
                <h3 class="card-title">Form Daftar Nama Siswa</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label>NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM">
                  </div>
                  <div class="form-group">
                    <label>Nama siswa</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama siswa">
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                  </div>
                  <div class="form-group">
                    <label>Jurusan</label>
                        <select name= "jurusan" id="jurusan" class="form-control" type="text">
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
                    <label>No telpon</label>
                    <input type="text" class="form-control" id="no_tlp" name="no_tlp" placeholder="Nomor telphon">
                  </div>
                  <div class="form-group">
                    <label>Nama Dosen PA</label>
                    <input type="text" class="form-control" id="dosen_pa" name="dosen_pa" placeholder="Nama dosen PA">
                  </div>
                  <div class="form-group">
                    <label>Gambar</label>
                    <br>
                    <label>untuk foto besar maks 1mb dan nama foto tidak menggunakan spasi</label>
                    <input type="file" class="form-control" id="foto" name="foto" placeholder="foto siswa">
                    </div>
                  <div class="form-group">
                    <div class="card-footer">
                    <button type="submit" name='simpan' value='simpan' class="btn btn-success mr-2">Save</button>
                    </div>
                </div>
              </form>
              <?php
                if(isset($_POST['simpan'])){
                    if(tambahsiswa ($_POST) > 0){
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
            ?>
                <div class="card">
          </section>
        </div>
       <div class="card-body">
                      <table id="dataTables" class="table table-bordered table-striped" >
                              <thead>
                                  <tr>
                                      <th>NO.</th>
                                      <th>NIM</th>
                                      <th>Nama Siswa</th>
                                      <th>Alamat</th>
                                      <th>Jurusan</th>
                                      <th>Dosen PA</th>
                                      <th>Foto</th>
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
                            $res = $conn->query("select siswa.nim, siswa.nama AS lengkap, siswa.alamat, kategori.nama,siswa.dosen_pa,siswa.foto from siswa INNER join kategori where siswa.jurusan = kategori.kode_kategori");
                            while($row = $res->fetch_assoc()){
                              echo '
                              <tr>
                                <td>'.$no.'</td>
                                <td>'.$row['nim'].'</td>
                                <td>'.$row['lengkap'].'</td>
                                <td>'.$row['alamat'].'</td>
                                <td>'.$row['nama'].'</td>
                                <td>'.$row['dosen_pa'].'</td>
                                <td><img src="../siswa/'.$row['foto'].'" width="70" height="90"></td>
                                <td>
                                 <a href ="tambahsiswa.php?nim='.$row['nim'].'"><i class="btn btn-block btn-primary btn-sm">edit</i></a>
                                 <a href ="hapussiswa.php?nim='.$row['nim'].'"><i class="btn btn-block btn-danger btn-sm">hapus</i></a>
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

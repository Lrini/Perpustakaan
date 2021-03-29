<?php
session_start ();
include "function.php";
include "header.php";
$tgl_pinjam = date("Y-m-d");
$tujuh_hari = strtotime("+7 day", strtotime($tgl_pinjam));
$kembali = date("Y-m-d", $tujuh_hari);
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
                <h3 class="card-title">Form pinjam buku</h3>
                <br>
                <label>Waktu pinjam buku 1 minggu dan hanya bisa meminjam 1 buku untuk satu jenis buku</label>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
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
              <?php
                if(isset($_POST['simpan'])){
                    if(tambahpinjam ($_POST) > 0){
                        echo " 
                             <script>
                                document.location.href = 'pinjam.php?r=sukses';
                            </script>";
                            }else{
                                echo " 
                                    <script>
                                        document.location.href = 'pinjam.php?r=gagal';
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
                                      <th>Nama</th>
                                      <th>Buku</th>
                                      <th>Tanggal Pinjam</th>
                                      <th>Batas Pinjam</th>
                                      <th>Tanggal Kembali</th>
                                      <th>Jumlah buku</th>
                                      <th>Denda</th>
                                      <th>status</th>
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
                            $res = $conn->query("select siswa.nim,siswa.nama,buku.nama_buku,pinjaman.tgl_mulai,pinjaman.tgl_end,pinjaman.stock,pinjaman.denda,pinjaman.status,pinjaman.terlambat,pinjaman.id_pinjam,pinjaman.tgl_kembali from siswa,buku,pinjaman WHERE siswa.nim=pinjaman.nim AND buku.SIBN = pinjaman.SIBN");
                            while($row = $res->fetch_assoc()){
                          ?>
                              <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row ['nama']; ?></td>
                                <td><?php echo $row ['nama_buku'];?> </td>
                                <td><?php echo $row ['tgl_mulai'];?> </td>
                                <td><?php echo $row ['tgl_end'];?> </td>
                                <td><?php echo $row ['tgl_kembali'];?></td>
                                <td><?php echo $row ['stock'];?> </td>
                                <td><?php
                                    $denda = 500;
                                    $tgl_deadline = date_create($row['tgl_end']);
                                    $n = date_create(date('Y-m-d'));
                                    $status = $row ['status'];
                                    if ($n > $tgl_deadline && $status =="pinjam"){
                                      $terlambat = date_diff($tgl_deadline,$n);
                                      $hari = $terlambat->format("%a");
                                      $uang = $hari * $denda;
                                      echo "Rp.".$uang." sudah lewat".$hari."hari";
                                    } elseif ($n < $tgl_deadline && $status=="pinjam") {
                                      echo"belum terkena denda";
                                    }elseif ($n > $tgl_deadline && $status =="kembali"){
                                      echo"Lunas dibayar";
                                    }elseif($n < $tgl_deadline && $status =="kembali"){
                                      echo"Lunas dibayar";
                                    }
                                    
                                   

                                    ?></td>
                                <td><?php echo $row ['status'];?> </td>
                                <td><a href="kembalibuku.php?id_pinjam=<?= $row["id_pinjam"];?>" class="btn btn-success">Kembali</a>
                                    <a href="kembalihapus.php?id_pinjam=<?= $row["id_pinjam"];?>" class="btn btn-danger">Hapus</a>
                                </td>
                              </tr>
                            <?php
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

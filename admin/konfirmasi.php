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
       <div class="card-body">
                      <table id="dataTables" class="table table-bordered table-striped" >
                              <thead>
                                  <tr>
                                      <th>NO.</th>
                                      <th>SIBN</th>
                                      <th>Buku</th>
                                      <th>NIM</th>
                                      <th>Nama</th>
                                      <th>Status Pinjam</th>
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
                            $res = $conn->query("SELECT detail_pinjam.id,detail_pinjam.SIBN, detail_pinjam.nama_buku,detail_pinjam.nim, siswa.nama, detail_pinjam.status FROM detail_pinjam,buku,siswa WHERE detail_pinjam.SIBN = buku.SIBN AND detail_pinjam.nim = siswa.nim");
                            while($row = $res->fetch_assoc()){
                          ?>
                              <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row ['SIBN']; ?></td>
                                <td><?php echo $row ['nama_buku'];?> </td>
                                <td><?php echo $row ['nim'];?> </td>
                                <td><?php echo $row ['nama'];?> </td>
                                <td><?php echo $row ['status'];?></td>
                                <td><a href="status.php?id=<?= $row["id"];?>" class="btn btn-success">Kembali</a>
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
<?php
}
?>
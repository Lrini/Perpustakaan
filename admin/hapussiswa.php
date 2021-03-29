<?php
 include "function.php";
 $id = $_GET ["nim"];
if(hapussiswa ($id) > 0){
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
 ?>
<?php
 include "function.php";
 $id = $_GET ["id_pinjam"];
if(hapuspinjam ($id) > 0){
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
 ?>
<?php
 include "function.php";
 $id = $_GET ["id"];
if(konfirmasi ($id) > 0){
				 echo " 
			           <script>
			                document.location.href = 'konfirmasi.php?r=sukses';
			            </script>";
			}else{
				 echo " 
			           <script>
			                document.location.href = 'konfirmasi.php?r=gagal';
			            </script>";
			}
 ?>
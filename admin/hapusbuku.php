<?php
 include "function.php";
 $id = $_GET ["SIBN"];
if(hapusbuku ($id) > 0){
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
 ?>
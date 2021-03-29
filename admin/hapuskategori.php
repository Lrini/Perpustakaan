<?php
 include "function.php";
 $id = $_GET ["kode_kategori"];
if(hapuskategori ($id) > 0){
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
 ?>
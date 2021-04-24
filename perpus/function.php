<?php
	$kon = mysqli_connect("localhost","root","","perpus");
	function query($query){
		global $kon;
		$result = mysqli_query($kon,$query);
		$rows = [];
		while ( $row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
	}
	function gambar(){
		$namaFile = $_FILES['gambar']['name'];
		$ukuranFile = $_FILES['gmabar']['size'];
		$error = $_FILES['gambar']['error'];
		$tipe = $_FILES['gambar']['tmp_name'];

		//cek apa tidak ada gambar yang di upload 
		if (($error === 4)) {
			echo "<script>
					alert ('pilih gambar terlebih dahulu');
					</script>";
		return false;
		}
		//cek gambar atau bukan 
		$ekstensi = ['jpg','jpeg','png'];
		$eks = explode('.', $namaFile);
		$eks = strtolower(end($eks));
		if (!in_array($eks, $ekstensi)) {
			echo "<script>
					alert ('bukan gambar');
					</script>";
			return false;
		}
		//cek ukuran gambar 
		if ($ukuranFile >1000000) {
			echo "<script>
					alert ('ukuran terlalu besar');
					</script>";
		}
		//lolos cek generete nama baru 
	//	$namabaru = uniqid();
		//var_dump($namabaru);die;
	//	$namabaru .= '.';
	//	$namabaru .= $eks;
		move_uploaded_file($tipe, '../data/'.$namaFile);
		//var_dump($namabaru);die;
		return $namaFile;
	}
	function foto(){
		$namaFile = $_FILES['foto']['name'];
		$ukuranFile = $_FILES['foto']['size'];
		$error = $_FILES['foto']['error'];
		$tipe = $_FILES['foto']['tmp_name'];

		//cek apa tidak ada gambar yang di upload 
		if (($error === 4)) {
			echo "<script>
					alert ('pilih gambar terlebih dahulu');
					</script>";
		return false;
		}
		//cek gambar atau bukan 
		$ekstensi = ['jpg','jpeg','png'];
		$eks = explode('.', $namaFile);
		$eks = strtolower(end($eks));
		if (!in_array($eks, $ekstensi)) {
			echo "<script>
					alert ('bukan gambar');
					</script>";
			return false;
		}
		//cek ukuran gambar 
		if ($ukuranFile >1000000) {
			echo "<script>
					alert ('ukuran terlalu besar');
					</script>";
		}
		//lolos cek generete nama baru 
	//	$namabaru = uniqid();
		//var_dump($namabaru);die;
	//	$namabaru .= '.';
	//	$namabaru .= $eks;
		move_uploaded_file($tipe, '../siswa/'.$namaFile);
		//var_dump($namabaru);die;
		return $namaFile;
	}
//function untuk insert

	function pinjamic($data){
		global $kon;
		$SIBN = $_POST['SIBN'];
		$nama_buku = $_POST['nama_buku'];
		$nim = $_POST['nim'];
		$stock = $_POST['stock'];

		 $sql = mysqli_query($kon,"insert into detail_pinjam (SIBN,nim,nama_buku,stock,status) values ('$SIBN','$nim','$nama_buku','$stock','tidak')");
		 return mysqli_affected_rows($kon);
	
	}

?>
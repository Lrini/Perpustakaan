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

	function tambahbuku($data){
		global $kon;
		$nama_buku = $_POST['nama_buku'];
		$kategori = $_POST['kategori'];
		$pengarang = $_POST['pengarang'];
		$stock = $_POST['stock'];
		
		$gambar = gambar();
		if (!$gambar) {
			return false;
		}


		 $sql = mysqli_query($kon,"insert into buku (nama_buku,kode_kategori,pengarang,stock,gambar) values ('$nama_buku','$kategori','$pengarang','$stock','$gambar')");
		 return mysqli_affected_rows($kon);
	
	}
	function tambahkategori($data){
		global $kon;
		$nama = $_POST['nama'];

		 $sql = mysqli_query($kon,"insert into kategori (nama) values ('$nama')");
		 return mysqli_affected_rows($kon);
	
	}

	function tambahsiswa($data){
		global $kon;
		$nim = $_POST['nim'];
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$jurusan = $_POST['jurusan'];
		$dosen = $_POST['dosen_pa'];
		$no_tlp = $_POST['no_tlp'];
		$foto = foto();
		if (!$foto) {
			return false;
		}


		 $sql = mysqli_query($kon,"insert into siswa (nim,nama,alamat,jurusan,dosen_pa,no_tlp,foto) values ('$nim','$nama','$alamat','$jurusan','$dosen','$no_tlp','$foto')");
		 return mysqli_affected_rows($kon);
	
	}

	function tambahpinjam($data){
		global $kon;
		$nim = $_POST['nim'];
		$SIBN = $_POST ['SIBN'];
		$tgl_mulai = $_POST['tgl_mulai'];
		$tgl_end = $_POST['tgl_end'];
		$stock = $_POST['stock'];

		$sql=mysqli_query($kon,"insert into pinjaman (nim,SIBN,tgl_mulai,tgl_end,status,stock,terlambat) values ('$nim','$SIBN','$tgl_mulai','$tgl_end','pinjam','$stock','0 hari')" );
		return mysqli_affected_rows($kon);
	}
//function untuk edit
	function editbuku($data){
		global $kon;
		$SIBN =$_POST['SIBN'];
		$nama_buku = $_POST['nama_buku'];
		$kategori = $_POST['kategori'];
		$pengarang = $_POST['pengarang'];
		$stock = $_POST['stock'];
		$gambar = gambar();
		if (!$gambar) {
			return false;
		}
		 $sql = mysqli_query($kon,"update buku set nama_buku='$nama_buku',kode_kategori='$kategori',pengarang='$pengarang',stock='$stock',gambar='$gambar' where SIBN='$SIBN'");
		 return mysqli_affected_rows($kon);
	
	}

	function editkategori($data){
		global $kon;
		$kode =$_POST['kode_kategori'];
		$nama = $_POST['nama'];

		 $sql = mysqli_query($kon,"update kategori set nama='$nama' where kode_kategori='$kode'");
		 return mysqli_affected_rows($kon);
	
	}
	function editsiswa($data){
		global $kon;
		$nim =$_POST['nim'];
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$jurusan = $_POST['jurusan'];
		$no_tlp = $_POST['no_tlp'];
		$dosen = $_POST['dosen_pa'];

		 $sql = mysqli_query($kon,"update siswa set nama='$nama',alamat='$alamat',jurusan='$jurusan',no_tlp='$no_tlp',dosen_pa='$dosen' where nim='$nim'");
		 return mysqli_affected_rows($kon);
	
	}

	function editpinjam($id){
		global $kon;
		$n = date_create(date('Y-m-d'));
		$m = date_format($n,'Y-m-d');
		 $sql = mysqli_query($kon,"update pinjaman set status='kembali' where id_pinjam='$id'");
		 $sql1 =mysqli_query($kon,"update pinjaman set stock = 0,tgl_kembali='$m' where id_pinjam = '$id'");
		 return mysqli_affected_rows($kon);
	
	}
//function untuk hapus
	function hapusbuku($id){
		global $kon;
		$sql =mysqli_query($kon,"DELETE FROM buku where SIBN=$id");
		return mysqli_affected_rows($kon);
	}

	function hapuskategori($id){
		global $kon;
		$sql =mysqli_query($kon,"DELETE FROM kategori where kode_kategori=$id");
		return mysqli_affected_rows($kon);
	}

	function hapussiswa($id){
		global $kon;
		$sql =mysqli_query($kon,"DELETE FROM siswa where nim=$id");
		return mysqli_affected_rows($kon);
	}
	function hapuspinjam($id){
		global $kon;
		$sql =mysqli_query($kon,"DELETE FROM pinjaman where id_pinjam=$id");
		return mysqli_affected_rows($kon);
	}

?>
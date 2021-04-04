<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];

// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"select * from siswa where user='$username' and pass='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
//cek object yang ditemukan
$data2 = mysqli_fetch_array($data);
if($cek > 0){
    session_start ();
	if($data2['status'] == 'aktif') {
			$_SESSION['nim'] = $data2 ['nim'];
			$_SESSION['user'] = $data2['user'];
        header("location:../perpustakaan/perpus/index.php");
    } else {
        header("location:index.php?pesan=gagal");
    }
	
}else{
    header("location:index.php?pesan=belum_login");
}
?>
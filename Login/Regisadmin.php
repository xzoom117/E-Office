<?php
require_once("../config.php");
session_start();
date_default_timezone_set('Asia/Jakarta');
$tgl = date("Y-m-d");

if(isset($_POST['SUBMIT'])){
	$jam = date("H:i:s");
	
		$mail = trim($_POST['mail']);
		$nik = trim($_POST['name']);
		$nama = trim($_POST['admin']);
		$kantor = trim($_POST['peru']);
		$no = trim($_POST['telp']);
		$jenis = $_POST['gender'];
		$alamat = trim($_POST['alamat']);
		$pass = trim($_POST['password']);
//Mengecek agar tidak ada akun ganda yang menggunakan NIK atau nama perusahaan yang sama
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' OR Nama_Perusahaan='$kantor'");

		if (mysqli_num_rows($sql) != 0){
			$sql_err = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik'");
				if (mysqli_num_rows($sql_err) != 0){
					$_SESSION['error'] = 1;
				}
				else {
					$_SESSION['error'] = 2;
				}
		}
		else if (mysqli_num_rows($sql) == 0) {
			if($jenis == "L"){
				mysqli_query($konek, "INSERT INTO data_perusahaan VALUES ('$kantor','$nama','$nik','L','$mail','$no','$pass','$alamat','06:00:00','10:00:00','15:00:00','00:00:00','$jam','$tgl');");
			}
			else if($jenis == "P"){
				mysqli_query($konek, "INSERT INTO data_perusahaan VALUES ('$kantor','$nama','$nik','P','$mail','$no','$pass','$alamat','06:00:00','10:00:00','15:00:00','00:00:00','$jam','$tgl');");
			}
//Mengecek apakah data registrasi terkirim
$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Nama_Perusahaan='$kantor' AND Nama_Admin='$nama' AND Password='$pass'");
	if (mysqli_num_rows($sql) != 0){
			$_SESSION['LOGIN_ADMIN'] = 1;
			$_SESSION['kantor_admin'] = $kantor;
			$_SESSION['NIK_admin'] = $nik;
			$_SESSION['PW_admin'] = $pass;
			header("Location: ../admin/Admin1.php");
	}
	else {
		header("Location: ../etc/error/index.php?condition=10");
	}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Registration Admin</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="stylesheet" href="Regisadmin.css">
	<link rel="shortcut icon" href="../Icon/Sign_only_Inverted/Transparent.png">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	</head>
        <center>
	<body>
	<div class="contaner">
	<div class="wraper">
	<div class="skuy">
	<form id="form1" name="form1" method="post" action="">
        <h1>Registration Admin</h1>
<hr>
<?php
if (isset($_SESSION['error'])){
	if ($_SESSION['error'] == 1){
		$pesan = "NIK Sudah Digunakan Akun Lain";
	}
	else if ($_SESSION['error'] == 2){
		$pesan = "Nama Perusahaan Sudah Digunakan Akun Lain";
	}
	echo '
	<p>
	<input type="text" placeholder="'.$pesan.'" id="salah"
	class="plus" READONLY style="display: block; background-color: #ffE4E1; border: 1px solid red; animation-name: inputMove; animation-duration: .5s; box-sizing: border-box;"/>
	</p>
	';
	unset($_SESSION['error']);
}
?>
<p><br>
<label for="mail">Email:</label>
<input type="email" placeholder="Masukkan Email" class="nik"
name="mail" id="mail" required autocomplete="off"><br>
</p>
<p>
<label for="name">NIK:</label>
<input type="number" placeholder="Masukkan NIK" 
name="name" id="name" required autocomplete="off" class="nik"
oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
maxlength="16"><br>
</p>
<p>
<label for="admin">Nama Admin:</label>
<input type="text" placeholder="Masukkan Nama Admin"
name="admin" id="admin" required autocomplete="off"><br>
</p>
<p>
<label for="peru">Nama Perusahaan:</label>
<input type="text" placeholder="Masukkan Nama Perusahaan"
name="peru" id="peru" required autocomplete="off"><br>
</p>
<p>
<label for="telp">Masukkan No Telp:</label>
<input type="tel" name="telp" placeholder="Masukkan No Telp"
autocomplete="off" id="telp" class="nik" required
oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12"><br>
</p>
<p>
<label for="gender">Jenis Kelamin: </label><br>
<input type="radio" name="gender" id="gender" value="L"/>Laki-Laki&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="gender" id="gender" value="P"/>Perempuan<br><br>
</p>
<p>
<label for="alamat">Alamat Perusahaan:</label>
<textarea name="alamat" id="alamat" class="almt"
cols="35">
</textarea><br>
</p>
<p>
<label for="password">Password:</label>
</p>
<div class="form-contener">
<input type="password" placeholder="Masukkan Password"
name="password" id="password" required autocomplete="off">
	<i class="material-icons visibility">visibility_off</i>
</div>
<p>
<label for="repeat">Ulangi Password:</label>
</p>
<div class="fai">
<input type="password" placeholder="Masukkan Password"
name="repeat" id="repeat" required autocomplete="off">
</div>
<p>
<div class="sub">
<span id="meseg"></span><br>
<input type="submit" onclick="return valid()" name="SUBMIT" id="SUBMIT" value="Submit">
</div>
</p>
</form>
	</div>	
</div>
	</div>
	</body></center>

</html>
<script>
function valid () {
var pas = document.getElementById('password').value;
var pos = document.getElementById('repeat').value;
if (pos != pas) {
document.getElementById('meseg').innerHTML="*Password Salah*";
return false;
}
}

</script>
<script src="show.js"></script>
<script src="regis1.js"></script>

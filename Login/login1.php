<?php
require_once("../config.php");

if(isset($_POST['SUBMIT'])){
		$nik = trim($_POST['NIK']);
		$pw = trim($_POST['PW']);
		
		$sql = mysqli_query($konek, "SELECT * FROM login WHERE NIK='$nik' AND Password = '$pw'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM login WHERE NIK='$nik';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$nama = $row['Nama'];
					$tgl = $row['Tanggal_Lahir'];
					$bln = $row['Bulan_Lahir'];
					$thn = $row['Tahun_Lahir'];
					$jabatan = $row['Jabatan'];
					$tel = $row['No_Telp'];
					$email = $row['Email'];
					
					//date in mm/dd/yyyy format; or it can be in other formats as well
  					$birthDate = "$bln/$tgl/$thn";
  					//explode the date to get month, day and year
  					$birthDate = explode("/", $birthDate);
  					//get age from date or birthdate
  					$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    				? ((date("Y") - $birthDate[2]) - 1)
    				: (date("Y") - $birthDate[2]));
					
					header("Location: ../Main Tab/etc/Main.php?nama=$nama && umur=$age && jabatan=$jabatan && nik=$nik && tel=$tel && email=$email");
				}
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
		<title>Log in</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link rel="stylesheet" href="sutail.css">
<link rel="shortcut icon" href="../Icon/Sign_only_Inverted/Transparent.png">
</head>
	
	<center>
<body>
	<div class="contaner">
	<div class="wraper">
	<div class="skuy">
		
	<form id="form1" name="form1" method="post" action="">
        <h1>LOGIN</h1>
	<div class="imag">
		<a id="golink" href="Loginadmin.html">
		<img src="../Icon/Inverted/Icon.png" width="200" height="200" usemap="#image-map">
</a>
</div>
	<p>
	<label for="name">NIK:</label><br>
	<input type="number" placeholder="Ketik NIK" name="NIK" id="NIK" 
	autocomplete="off" class="nik" required><br>
	</p>
	<p>
	<label for="pass">Password:</label><br>
	<input type="password" placeholder="Ketik Password" name="PW" id="PW"
	autocomplete="off" id="password" required>
	</p>
	<p>
	<div class="cek">
	<input type="checkbox" name="show" id="sow"
	class="size" onclick="check()">Show Password<br>
	</div>
	</p>
	<p>
	<button type="submit" name="SUBMIT" id="SUBMIT" value="Submit">Login</button><br>
	</p>
	<p>
	<a href="../index.html"><button type="button" class="canc">Back</button></a>
	</p>
<p>
<a href="regis.html">klak</a>
</p>
	</form>
	</div>	
</div>
	</div>
	</body></center>

</html>
<script>
function check() {
var pas = document.getElementById('password');
if (pas.type==="password") {
pas.type="text";
}
else {
pas.type="password";
}
}
jQuery(function($) {
    $('#golink').click(function() {
        return false;
    }).dblclick(function() {
        window.location = this.href;
        return false;
    });
});
</script>
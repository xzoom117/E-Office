<?php
require_once("../config.php");

$kantor = $_GET['kantor'];
$nik = $_GET['nik'];
$pw = $_GET['password'];
		
$A_check = "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor';";
$result_check = mysqli_query($konek, $A_check);			

$row_check = mysqli_fetch_assoc($result_check);
$datang_value_check = $row_check['Absen_datang_min'];
$datang_max_value_check = $row_check['Absen_datang_max'];
$pulang_value_check = $row_check['Absen_pulang_min'];
$pulang_max_value_check = $row_check['Absen_pulang_max'];

$datang_value = date('H:i',strtotime($datang_value_check));
$datang_max_value = date('H:i',strtotime($datang_max_value_check));
$pulang_value = date('H:i',strtotime($pulang_value_check));
$pulang_max_value = date('H:i',strtotime($pulang_max_value_check));
					

if(isset($_POST['ABSEN_DATANG'])){
	$datang_min = trim($_POST['masuk1']);
	$datang_max = trim($_POST['masuk2']);
		
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					if (empty($datang_max)){
						$datang_max = date('H:i',strtotime($_GET['datang_max']));
					}
					if (empty($datang_min)){
						$datang_min = date('H:i',strtotime($_GET['datang_min']));
					}
					
					$admin = $row['Nama_Admin'];
					$email = $row['Email'];
					$telp = $row['No_Telp'];
					$pass = $row['Password'];
					$alamat = $row['Alamat_Perusahaan'];
					$pulang = $row['Absen_pulang_min'];
					$max = $row['Absen_pulang_max'];
					
					$datang_value = $datang_min;
					$datang_max_value = $datang_max;
						
					$sql = mysqli_query($konek, "DELETE FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor'");
						
					$sql = mysqli_query($konek, "INSERT INTO data_perusahaan VALUES ('$kantor','$admin','$nik','$email','$telp','$pass','$alamat','$datang_min','$datang_max','$pulang','$max')");
				}
			}
		}
	}

if(isset($_POST['ABSEN_PULANG'])){
	$pulang_min = trim($_POST['pulang']);
		
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					if (empty($pulang_min)){
						$pulang_min = date('H:i',strtotime($_GET['pulang_min']));
					}
					
					$admin = $row['Nama_Admin'];
					$email = $row['Email'];
					$telp = $row['No_Telp'];
					$pass = $row['Password'];
					$alamat = $row['Alamat_Perusahaan'];
					$datang = $row['Absen_datang_min'];
					$max = $row['Absen_datang_max'];
					$pulang_max_check = $row['Absen_pulang_max'];
					
					$pulang_max = date('H:i',strtotime($pulang_max_check));
					
					$pulang_value = $pulang_min;
					$pulang_max_value = $pulang_max;
						
					$sql = mysqli_query($konek, "DELETE FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor'");
						
					$sql = mysqli_query($konek, "INSERT INTO data_perusahaan VALUES ('$kantor','$admin','$nik','$email','$telp','$pass','$alamat','$datang','$max','$pulang_min','$pulang_max')");
				}
			}
		}
	}

if(isset($_POST['SET_ABSEN'])){
		
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					
					header("Location: Setting-Absen.php?kantor=$kantor && nik=$nik && password=$pw");
				}
			}
		}
	}
if(isset($_POST['PENGUMUMAN'])){
		
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					
					header("Location: +Pengumuman.php?kantor=$kantor && nik=$nik && password=$pw");
				}
			}
		}
	}
if(isset($_POST['TUGAS'])){
		
		$sql = mysqli_query($konek, "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM data_perusahaan WHERE NIK_Admin='$nik' AND Password='$pw' AND Nama_Perusahaan='$kantor';";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					
					header("Location: Tugas.php?kantor=$kantor && nik=$nik && password=$pw");
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting Absen</title>

    <link rel="stylesheet" href="Setting-Absen.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@1,600&display=swap" rel="stylesheet">
</head>
<body>
    <header class="banner">
        <h1 class="h1"><?php echo $_GET['kantor']; ?> Administrator</h1>
    </header>

	<form id="form1" name="form1" method="post" action="">
    <section class="fitur-jam-masuk">
        <h1 class="prg-absen">Absen Jam Masuk</h1>
        <h1 class="jam-masuk"><?php echo $datang_value; ?> - <?php echo $datang_max_value; ?></h1> <hr>
        <div class="setting-jam-masuk">
            <input class="setting-jam-masuk1" type="time" name="masuk1" id="masuk1">
            <input class="setting-jam-masuk2" type="time" name="masuk2" id="masuk2">

            <button class="oke1" type="submit" name="ABSEN_DATANG" id="ABSEN_DATANG" value="absen_datang">OK</button>
        </div>
    </section>

    <section class="fitur-jam-pulang">
        <h1 class="prg-absen">Absen Jam Pulang</h1>
        <h1 class="jam-pulang"><?php echo $pulang_value; ?> - <?php echo $pulang_max_value; ?></h1> <hr>
        <div class="setting-jam-masuk">
            <input class="setting-jam-masuk3" type="time" name="pulang" id="pulang">

            <button class="oke2" type="submit" name="ABSEN_PULANG" id="ABSEN_PULANG" value="absen_pulang">OK</button>
        </div>
    </section>

    <div class="Banner-handap">
        <div class="o">Officia</div>
        <form id="form2" name="form2" method="post" action="">
            <ul class="inline">
                <li><button style="background-color: transparent;border: none;" type="submit" name="SET_ABSEN" id="SET_ABSEN" value="set_absen"><a class="absen">Setting Absen<i class="logo fas fa-calendar-check"></i></a></button></li>
                <li><a class="cuti">Izin Cuti<i class="logo fas fa-calendar-minus"></i></a></li>
                <li><button style="background-color: transparent;border: none;" type="submit" name="PENGUMUMAN" id="PENGUMUMAN" value="pengumuman"><a class="pengumuman">Pengumuman<i class="logo fas fa-bullhorn"></i> </a></button></li>
                <li><a href="" class="karyawan">Karyawan<i class="logo fas fa-id-card"></i></a></li>
                <li><a href="" class="list-karyawan">List Karyawan<i class="logo fas fa-tasks"></i></a></li>
                <li><button style="background-color: transparent;border: none;" type="submit" name="TUGAS" id="TUGAS" value="tugas"><a class="tugas">Tugas<i class="logo fas fa-briefcase"></i></a></button></li>
            </ul>
		   </form>
		</form>
    </div>
</body>
</html>
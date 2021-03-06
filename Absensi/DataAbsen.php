<?php
session_start();
//mencegah user masuk bila mereka belum melakukan login
if (!isset($_SESSION['LOGIN'])){
	header("Location: ../Login/login1.php");
	exit ();
}

require_once("../config.php");
//Session akan membuat link terlihat polos dan membuat website lebih teroptimisasi dibanding sebelumnya
$nik = $_SESSION['nik'];
$kantor = $_SESSION['kantor'];
$pass = $_SESSION['password'];
$nama = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absen</title>

    <link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <link rel="stylesheet" href="styleDataAbsen.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="logo">
                <h1><?php echo $kantor; ?></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="Home.php">DASHBOARD</a></li> 
                    <li><a href="Absen.php">ABSEN</a></li>
                    <li><a href="Cuti.php">CUTI</a></li>
                    <li><a href=""><u style="color: rgb(190, 190, 190); text-shadow: 0px 0px 20px white;">DATA ABSEN</u></a></li>
                    <li><a href="../Main Tab/etc/Main.php">PROFILE</a></li>
                </ul>
            
                <div class="menu-toggle">
                    <input type="checkbox">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>
<section>
    <!-- partial:index.partial.html -->
<div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
            <th>NIK / ID</th>
			<th>Nama</th>
			<th>Tanggal</th>
			<th>Absen Masuk</th>
			<th>Absen Pulang</th>
			<th>Terlambat</th>
			<th>Status</th>
        </tr>
        </thead>
        <tbody>
<?php
	$sql = mysqli_query($konek, "SELECT * FROM absen WHERE NIK='$nik' AND Nama_Perusahaan='$kantor'");
		
		if (mysqli_num_rows($sql) != 0){
			$A = "SELECT * FROM absen WHERE NIK='$nik' AND Nama_Perusahaan='$kantor' ORDER BY Tanggal DESC;";
			$result = mysqli_query($konek, $A);
			$check = mysqli_num_rows($result);
				
			if ($check > 0){
				while ($row = mysqli_fetch_assoc($result)){
					$data_status = $row['Status'];
					
					$color = "yellow";
					if ($data_status == "Terlambat Absen"){
						$color = "red";
					}
					else if ($data_status == "Sudah Absen Masuk" || $data_status == "Absen Terlalu Pagi"){
						$color = "limegreen";
					}
					else if ($data_status == "Sudah Absen"){
						$color = "green";
					}
					$style = 'style="background-color: '.$color.';"';
			echo "<tr><td>" . $nik . "</td><td>" . $nama . "</td><td>" . $row['Tanggal'] . "</td><td>" . $row['Jam_masuk'] . "</td><td>" . $row['Jam_pulang'] . "</td><td>" . $row['Terlambat'] . "</td><td $style>" . $data_status . "</td></tr>";
		}
			}
		}
?>
                </tbody>
    </table>
</div>
<!-- partial -->
</section>
    <footer>
        <p class="copy">Absensi Online, Copyright &copy;2021 by Officia. All Right Reserved</p>
    </footer>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
</body>
</html>

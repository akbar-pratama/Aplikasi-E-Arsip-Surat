<?php include("sidebar/sidebar.php"); ?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Arsip</title>
  </head>
  <body>
   <div class="container col-md-11">
	<br>
		<h2>Arsip Surat</h2><br>
		<h6>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan</h6>
		<h6>Klik "Lihat" pada kolom aksi untuk menampilkan surat</h6>
		<br>

		<!-- Fitur Search -->

		 <div class="form-group form-inline">
		 	<div class="row">
		 		<div class="col-1">
			 		<h6>Cari Surat</h6>
			 	</div>
		 		<div class="col-8">
		         	<form method="POST" action="" > 
		                <input type="text" name="pencarian" class="form-control" placeholder="Cari Data Judul" required />
		            </div>
		            <div class="col">
			 			 <button type="submit" class="btn btn-info"> cari</button>
			 		</div>
		 		</form>
            </div>
        </div>
        <br>

        <!-- Table -->
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr align="center">
				 	<th style="width: 20%">Nomer Surat</th>
                    <th style="width: 15%">Kategori</th>
                    <th style="width: 20%">Judul</th>
                    <th style="width: 20%">Waktu Pengarsipan</th>
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>

            <?php 
            include 'koneksi.php';

            $batas = 5;
            $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;

            $previous = $halaman - 1;
            $next = $halaman + 1;

            $sql=mysqli_query($kon, "select*from data order by No_surat desc");
            $jumlah_data = mysqli_num_rows($sql);
            $total_halaman = ceil($jumlah_data / $batas);

            // pencarian data

              if ($_SERVER['REQUEST_METHOD'] == "POST"){
                    $pencarian = trim(mysqli_real_escape_string($kon, $_POST['pencarian']));
                    if ($pencarian != '') {
                        $sql = "SELECT * FROM data WHERE No_surat LIKE '%".$pencarian."%' or Judul LIKE '%".$pencarian."%' 
                         order by No_surat asc";
                        $query = $sql;
                        $queryjml = $sql;
                         $no = $halaman_awal+1;
                    } else{
                        $query = "SELECT * FROM data";
                    }
                }else{
                     $query = "SELECT * FROM data LIMIT $halaman_awal, 
                        $batas";
                }


            $hasil=mysqli_query($kon,$query);
            $no= $halaman_awal+1;
            while ($data = mysqli_fetch_array($hasil)) {
             ?>
                <tbody>
                    <tr align="center">
                        <td><?php echo $data["No_surat"]; ?></td>
                        <td><?php echo $data["Kategori"]; ?></td>
                        <td><?php echo $data["Judul"]; ?></td>
                        <td><?php echo $data["Tanggal"]; ?></td>
                        <td>       

              <!--           button aksi   -->      

                        <a onclick=" return confirm('Yakin Ingin Menghapus Data Ini?')" 
                        href="hapusdata.php?No_surat=<?php echo htmlspecialchars($data['No_surat']);?>" 
                        	class="btn btn-danger" role="button">Hapus</a>    
                        <a href="download.php?File=<?php echo htmlspecialchars($data['File']);?>"
                         class="btn btn-warning" role="button">Unduh</a>
                        <a href="lihat.php?No_surat=<?php echo htmlspecialchars($data['No_surat']);?>" 
                        	class="btn btn-primary" role="button">Lihat</a>
                        </td>
                    </tr>
                </tbody>
               <?php
            	}
            ?>
        </table>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if($halaman > 1){echo "href ='?halaman=$previous'";} ?>>Previous</a>
                </li>
                <?php
                for ($x=1; $x<=$total_halaman; $x++) { 
                    ?>
                    <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php
                }
                ?>
                <li class="page-item">
                    <a class="page-link" <?php if($halaman < $total_halaman){echo "href='?halaman=$next'";} ?>>Next</a>
                </li>
            </ul>
        </nav>

         <a href="tambahdata.php" class="btn btn-info justify-content-end" role="button">Arsipkan Surat</a>
    </div>
<br>
  </body>
</html>
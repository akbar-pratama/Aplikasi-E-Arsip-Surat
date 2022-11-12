<?php include("sidebar/sidebar.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ubah Surat</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
 <div class="container col-11">
 	<?php
   include "koneksi.php";
   // include "config/function.php";


    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
 
	    //Ambildata

        if( !isset($_GET['No_surat']) ){
            header('Location: lihat.php');
        }

        $id = $_GET['No_surat'];

        $sql = "SELECT * FROM data WHERE No_surat=$id";
        $hasil = mysqli_query($kon, $sql);
       while ($data = mysqli_fetch_array($hasil)) {
    ?>

	<br>
		<h2>Arsip Surat >> Ubah</h2><br>
		<h6>Unggah surat yang telah terbit pada form ini untuk diarsipkan</h6>
		<h6>Catatan:</h6>
		<h6>*Gunakan file berformat PDF</h6>
		<br>

		<!-- Form tambah data -->
 		<form action="aksiubah.php" method="post" enctype="multipart/form-data">
  			<div class=" form form-group">
		        <div class="row">
		         	<label class="col-2">Nomor Surat </label>
		            <div class="col-md-9"><input type="text" name="No_surat" class="form-control" placeholder="Masukkan Nomor Surat" 
                  required  value="<?php echo $data['No_surat'] ?>" /><br></div>
		    
		            <label class="col-2">Kategori</label>
		            <div class="col-9"><input type="text" name="Kategori" class="form-control" placeholder="Masukkan Kategori" 
                  required value="<?php echo $data['Kategori'] ?>" /><br></div>

		            <label class="col-2">Judul</label>
		            <div class="col-9"><input type="text" name="Judul" class="form-control" placeholder="Masukkan Judul" 
                  required value="<?php echo $data['Judul'] ?>" /><br></div>
		     
		            <label class="col-2">File</label>
		            <div class="col-9"><input type="file" name="File" class="form-control"  accept="application/pdf"
                        value="<?php echo $data['File'] ?>"/></div>
		        </div>
	    	</div>
            <?php 
                }
             ?>
	    	<br><br>
	    	<a href="lihat.php" class="btn btn-danger" role="button">Kembali</a>
	    	 <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
		</form>
</div>
</body>
</html>
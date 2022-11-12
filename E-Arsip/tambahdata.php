<?php include("sidebar/sidebar.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Arsipkan Surat</title>
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

    //cek apakah ada kiriman form dari method post
    // if ($_SERVER["REQUEST_METHOD"]=="POST") {
    // 	// $File = upload();
    //     $No_surat=input($_POST["No_surat"]);
    //     $Kategori=input($_POST["Kategori"]);
    //     $Judul=input($_POST["Judul"]); 
    //     $File = input($_POST["File"]);


    //    //query input menginput data kedalam tabel 
    //     $sql="insert into data (No_surat, Kategori, Judul, File) values
    //      ('$No_surat','$Kategori','$Judul','$File')";

    //     //mengeksekusi/menjalankan query diatas
    //     $hasil=mysqli_query($kon, $sql);

    //     //kondisi apakah berhasil atau tidak
    //     if ($hasil) {
    //          echo "<div class ='alert alert-danger'> Data berhasil di simpan.</div>";
    //      }
    //     else{
    //         echo "<div class ='alert alert-danger'> Data gagal di simpan.</div>";
    //     }
    // }

	if(isset($_POST['submit'])){
                $No_surat = $_POST['No_surat'];
                $Kategori = $_POST['Kategori'];
                $Judul = $_POST['Judul'];
                $File = $_FILES['File']['name'];
                $source = $_FILES['File']['tmp_name'];
   				$folder = 'upload/';

   				 move_uploaded_file($source, $folder.$File);
   				  $sql="insert into data (No_surat, Kategori, Judul, File) values
                             ('$No_surat','$Kategori','$Judul','$File')";
                  $hasil = mysqli_query($kon, $sql);

                  //kondisi apakah berhasil atau tidak
		        if ($hasil) {
		             echo "<div class ='alert alert-danger'> Data berhasil di simpan.</div>";
		         }
		        else{
		            echo "<div class ='alert alert-danger'> Data gagal di simpan.</div>";
		        }
		    }
    ?>

	<br>
		<h2>Arsip Surat >> Unggah</h2><br>
		<h6>Unggah surat yang telah terbit pada form ini untuk diarsipkan</h6>
		<h6>Catatan:</h6>
		<h6>*Gunakan file berformat PDF</h6>
		<br>

		<!-- Form tambah data -->
 		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
  			<div class=" form form-group">
		        <div class="row">
		         	<label class="col-2">Nomor Surat </label>
		            <div class="col-md-9"><input type="text" name="No_surat" class="form-control" placeholder="Masukkan Nomor Surat" required /><br></div>
		    
		            <label class="col-2">Kategori</label>
		            <div class="col-9"><select class="form-control" name="Kategori">
                    <option value="">--Pilih Paket--</option>
                    <option  value="Undangan">Undangan</option>
                    <option value="Pengumuman">Pengumuman</option>
                    <option value="Nota Dinas">Nota Dinas</option>
                    <option value="Pemberitahuan">Pemberitahuan</option>
                </select><br></div>

		            <label class="col-2">Judul</label>
		            <div class="col-9"><input type="text" name="Judul" class="form-control" placeholder="Masukkan Judul" required /><br></div>
		     
		            <label class="col-2">File</label>
		            <div class="col-9"><input type="file" name="File" class="form-control"  accept="application/pdf"/></div>
		        </div>
	    	</div>
	    	<br><br>
	    	<a href="index.php" class="btn btn-danger" role="button">Kembali</a>
	    	 <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
		</form>
</div>
</body>
</html>
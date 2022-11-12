<?php include("sidebar/sidebar.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Lihat</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="container col-md-11">
		<br>
		<h2>Arsip Surat >> Lihat</h2><br>
	<?php 
        include("koneksi.php");


        $id = $_GET['No_surat'];

        $sql = "SELECT * FROM data WHERE No_surat=$id ";
        $hasil=mysqli_query($kon,$sql);
       while ($data = mysqli_fetch_array($hasil)) {

    ?>
		 <div class="form-group row">
              <label for="No_surat" class="col-sm-2 col-form-label">Nomor</label>
              <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="nomer_surat" value=": &nbsp; <?php echo $data['No_surat'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="nomer_surat" class="col-sm-2 col-form-label">Kategori</label>
              <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="nomer_surat" value=": &nbsp; <?php echo $data['Kategori'] ?>">
              </div>
            </div>
          
            <div class="form-group row">
              <label for="judul" class="col-sm-2 col-form-label">Judul</label>
              <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="judul" value=": &nbsp; <?php echo $data['Judul'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="judul" class="col-sm-2 col-form-label">Waktu Unggah</label>
              <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="judul" value=": &nbsp; <?php echo $data['Tanggal'] ?>">
              </div>
            </div><br>
                <object  target="_blank"data="upload/<?php echo $data['File']?>" type="application/PDF" width="100%" height="800"  
              style="border: 1px solid; box-shadow: 2px 2px 8px #000000;"></object>
              <br><br>
                <a href="index.php"class="btn btn-danger" role="button">Kembali</a>    
                <a href="download.php?File=<?php echo htmlspecialchars($data['File']);?>"class="btn btn-warning" role="button">Unduh</a>
                <a href="ubah.php?No_surat=<?php echo htmlspecialchars($data['No_surat']);?>" 
                  class="btn btn-primary" role="button">Edit/Ganti File</a>
                <br><br>
          </div>
              <?php 
                }
               ?>
           

</body>
</html>
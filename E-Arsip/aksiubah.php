<?php 
include("koneksi.php");

if(isset($_POST['submit'])){
                $No_surat = $_POST['No_surat'];
                $Kategori = $_POST['Kategori'];
                $Judul = $_POST['Judul'];
                $File = $_FILES['File']['name'];
                $source = $_FILES['File']['tmp_name'];
                $folder = 'upload/';

                 move_uploaded_file($source, $folder.$File);
                  $sql="UPDATE data SET Kategori='$Kategori', Judul='$Judul', File='$File'
                   where No_surat=$No_surat";
                  $hasil = mysqli_query($kon, $sql);

                  //kondisi apakah berhasil atau tidak
                  if ($hasil) {
                 ?>
                 <script type="text/javascript">
                   alert("Data Berhasil Diubah");
                   location="index.php";
                 </script>
                 <?php  
                   }
                  else{
                    ?>
                  <script type="text/javascript">
                   alert("Data Gagal Diubah");
                   window.location.href="?page=ubah";
                 </script>
                 <?php  
                   }
            }
 ?>
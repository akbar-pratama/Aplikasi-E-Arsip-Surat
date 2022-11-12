<?php
include 'koneksi.php';

if (isset($_GET['No_surat'])){
    $id = htmlspecialchars($_GET["No_surat"]);

    $sql =mysqli_query($kon,"select*from data where No_surat='$id'");

    $data = $sql -> fetch_assoc();

    $file = $data['File'];

    if (file_exists("upload/$file")) {
        unlink("upload/$file");
    }
     $hapus =mysqli_query($kon,"delete from data where No_surat='$id'");


     //Kondisi

    if($hapus){      
     	 ?>
         <script type="text/javascript">
         alert("Data Berhasil Dihapus");
            location="index.php";
            </script>
        <?php  
    }
    else {
             ?>
         <script type="text/javascript">
         alert("Data gagal Dihapus");
            location="index.php";
            </script>
        <?php  
    }
}
?>
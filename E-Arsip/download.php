<?php 
include'koneksi.php';

 if (isset($_GET['File'])) {
 	 $id = htmlspecialchars($_GET["No_surat"]);
 	$sql = "SELECT * FROM data WHERE No_surat=$id";
        $hasil = mysqli_query($kon, $sql);
     $filename    = $hasil['File'];

    $back_dir    ="upload/";
    $file = $back_dir.$_GET['File'];
     
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: private');
            header('Pragma: private');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            
            exit;
        } 
        else {
            $_SESSION['pesan'] = "Oops! File - $filename - not found ...";
            header("location:index.php");
        }
    }
?>
 ?>
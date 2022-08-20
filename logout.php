<?php 
session_start();
session_destroy();
echo "<script>
	  alert('Anda berhasil logout');
       document.location='index.php';
     </script>";
?>
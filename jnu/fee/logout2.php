<?php
session_start(); 
include("conn.php");
echo '<meta charset="utf-8">';
session_destroy();
echo "<script>location='fee2.php'</script>";
exit;	
?>
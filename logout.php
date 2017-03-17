<?php
include("conn.php");
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
session_start();
session_destroy();
echo "<script>location='index.php'</script>";	
?>
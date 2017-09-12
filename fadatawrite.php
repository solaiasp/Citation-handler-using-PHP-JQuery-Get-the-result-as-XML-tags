<?php 

if(isset($_POST['data'])){
 $contentD = $_POST['data'];
 //$Article_logFile = date("h-i-sa")."-log.txt";
 $Article_logFile ="log.txt";
 if (file_exists($Article_logFile)) {
    $fh = fopen($Article_logFile, 'a');
    fwrite($fh, $contentD."\n");
  } else {
    $fh = fopen($Article_logFile, 'w');
    fwrite($fh, $contentD."\n");
  }
  fclose($fh);
 echo 'File Created';
}


?>
<?php
session_start();
$file  = $_SESSION["download"];
header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");
header("Content-Type: application/force-download");
header("Content-Length: " . filesize($file));
header("Connection: close");
readfile($file);
unset($_SESSION["download"]);
?>

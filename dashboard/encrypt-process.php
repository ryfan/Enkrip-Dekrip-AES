<?php
session_start();
include "../config.php";   //memasukan koneksi
include "AES.php"; //memasukan file AES

  if (isset($_POST['encrypt_now'])) {
      $user 		 = $_SESSION['username'];
      $key		   = mysql_escape_string(substr(md5($_POST["pwdfile"]), 0,16));
      $deskripsi = mysql_escape_string($_POST['desc']);

      $file_tmpname   = $_FILES['file']['tmp_name'];
      //untuk nama file url
      $file           = rand(1000,100000)."-".$_FILES['file']['name'];
      $new_file_name  = strtolower($file);
      $final_file     = str_replace(' ','-',$new_file_name);
      //untuk nama file
      $filename       = rand(1000,100000)."-".pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
      $new_filename  = strtolower($filename);
      $finalfile     = str_replace(' ','-',$new_filename);
      $size           = filesize($file_tmpname);
      $size2          = (filesize($file_tmpname))/1024;
      $info           = pathinfo($final_file );
      $file_source		= fopen($file_tmpname, 'rb');
      $ext            = $info["extension"];

      if( $ext=="docx" || $ext=="doc" || $ext=="txt" || $ext=="pdf" || $ext=="xls" || $ext=="xlsx" || $ext=="ppt" || $ext=="pptx"){
      }else{
          echo("<script language='javascript'>
          window.location.href='encrypt.php';
          window.alert('Maaf, file yang bisa dienkrip hanya word, excel, text, ppt ataupun pdf.');
          </script>");
          exit();
      }

      if($size2>3084){
          echo("<script language='javascript'>
          window.location.href='home.php?encrypt';
          window.alert('Maaf, file tidak bisa lebih besar dari 3MB.');
          </script>");
          exit();
      }

      $sql1   = "INSERT INTO file VALUES ('', '$user', '$final_file', '$finalfile.rda', '', '$size2', '$key', now(), '1', '$deskripsi')";
      $query1  = mysql_query($sql1) or die(mysql_error());

      $sql2   = "select * from file where file_url =''";
      $query2  = mysql_query($sql2) or die(mysql_error());

      $url   = $finalfile.".rda";
      $file_url = "file_encrypt/$url";

      $sql3   = "UPDATE file SET file_url ='$file_url' WHERE file_url=''";
      $query3  = mysql_query($sql3) or die(mysql_error());

      $file_output		= fopen($file_url, 'wb');

      $mod    = $size%16;
      if($mod==0){
          $banyak = $size / 16;
      }else{
          $banyak = ($size - $mod) / 16;
          $banyak = $banyak+1;
      }

      if(is_uploaded_file($file_tmpname)){
          ini_set('max_execution_time', -1);
          ini_set('memory_limit', -1);
          $aes = new AES($key);

         for($bawah=0;$bawah<$banyak;$bawah++){
             $data    = fread($file_source, 16);
             $cipher  = $aes->encrypt($data);
             fwrite($file_output, $cipher);
         }
         fclose($file_source);
         fclose($file_output);

         echo("<script language='javascript'>
          window.location.href='encrypt.php';
          window.alert('Enkripsi Berhasil..');
          </script>");
      }else{
         echo("<script language='javascript'>
          window.location.href='encrypt.php';
          window.alert('Encrypt file mengalami masalah..');
          </script>");
      }
  }

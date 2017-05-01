<?php
session_start();
include "../config.php";   //memasukan koneksi
include "AES.php"; //memasukan file AES

  if (isset($_POST['encrypt_now'])) {
      $user 		 = $_SESSION['username'];
      $key		   = mysql_escape_string(base64_encode($_POST['pwdfile']));
      $deskripsi = mysql_escape_string($_POST['desc']);
      $tgl       = mysql_escape_string($_POST['datenow']);

      $file_tmpname = $_FILES['file']['tmp_name'];
      $file = rand(1000,100000)."-".$_FILES['file']['name'];
      $new_file_name = strtolower($file);
      $final_file =str_replace(' ','-',$new_file_name);
      $file_name = $_FILES['file']['name'];
      $file_size = $_FILES['file']['size'];
      $file_type = $_FILES['file']['type'];
      $info = pathinfo($file_name);

      $file_source = fopen($file_tmpname, 'rb');
      $file_output = fopen('../file_encrypt/' . $final_file, 'wb');

      $a = filesize($file_tmpname);
      $mod = $a % 16;
      if ($mod == 0) {
          $banyak = $a / 16;
      } else {
          $banyak = ($a - $mod) / 16;
          $banyak = $banyak + 1;
      }

      if ($info['extension'] == 'doc' || $info['extension'] == 'docx' || $info['extension'] == 'xls' || $info['extension'] == 'xlsx' || $info['extension'] == 'excel' || $info['extension'] == 'pdf') {
        echo "<script language=\"JavaScript\">\n";
        echo "alert('Ekstension File diterima, Klik OK untuk melanjutkan');\n";
        echo "</script>";
        if (is_uploaded_file($file_tmpname)) {
            ini_set('max_execution_time', -1);
            ini_set('memory_limit', -1);
            $hash_password = md5($key);
            $aes = new AES(substr($hash_password, 0, 16));

            for ($bawah = 0; $bawah < $banyak; $bawah++) { // 34 bit
                $data = fread($file_source, 16);
                if ($mod > 0 && $bawah == ($banyak - 1)) {
                    $data[15] = $mod; // 2
                    $cipher = $aes->encrypt($data);
                    fwrite($file_output, $cipher);
                } else {
                    $cipher = $aes->encrypt($data);
                    fwrite($file_output, $cipher);
                }
            }

            $sql = "INSERT INTO file VALUES('', '$user', '$final_file', 'file_encrypt/$final_file', '$file_size', '$key', '$tgl', '0', '$deskripsi')";
            $query = mysql_query($sql) or die(mysql_error());
            if ($query) {
              echo "<script language=\"JavaScript\">\n";
              echo "alert('Berhasil mengenkrip.');\n";
              echo "window.location='encrypt.php'";
              echo "</script>";
            } else {
              echo "<script language=\"JavaScript\">\n";
              echo "alert('Gagal mengenkrip data.');\n";
              echo "window.location='encrypt.php'";
              echo "</script>";
            }
        } else {
            echo "Possible file upload attack : ";
            echo "filename " . $_FILES['file']['tmp_name'] . ".";
            echo "filename " . $_FILES['file']['error'] . ".";
        }
      } else {
        echo "<script language=\"JavaScript\">\n";
        echo "alert('Maaf hanya file Word, Excel dan PDF saja yang diterima');\n";
        echo "window.location='encrypt.php'";
        echo "</script>";
      }
  }

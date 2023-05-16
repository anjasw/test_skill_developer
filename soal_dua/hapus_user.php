<?php
session_start();

include './config.php';
if(!isset($_SESSION['sess_log'])){
    echo '<script>alert("Maaf, harus login terlebih dahulu."); window.location.href = "login.php";</script>';exit;
}

if(isset($_GET['idpk'])){
    $idpk = $_GET['idpk'];
    $sql_check = 'SELECT * FROM tbl_user WHERE Id = "'.$idpk.'"';
    $data = $conn->query($sql_check);
    if(isset($data[0]) > 0){
        // echo json_encode($data[0]);exit;
        $id = $data[0]['Id'];
        if($conn->delete('tbl_user', array("Id" => $id))){
            echo '<script>alert("Berhasil Hapus User"); window.location.href = "index.php";</script>';exit;
         // echo 'a';exit;
        }else{
            echo 'Gagal Update User';exit;
    
        }
    }else{
        echo '<script>alert("User Tidak Ditemukan"); window.location.href = "index.php";</script>';exit;

    }
}else{
    header('Location: index.php');
    exit;
}


?>
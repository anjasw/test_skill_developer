<?php 
session_start();

include './config.php';
if(!isset($_SESSION['sess_log'])){
    echo '<script>alert("Maaf, harus login terlebih dahulu."); window.location.href = "login.php";</script>';exit;
}

if(isset($_POST['logsess'])){
    if(strlen($_POST['form_nama']) > 128 || strlen($_POST['form_password']) > 8){
        echo '<script>alert("Nama User atau Password terlalu panjang."); window.location.href = "index.php";</script>';exit;
    }
    $dataInsert['Username'] = trim($_POST['form_nama']);
    $dataInsert['Password'] = md5(sha1(trim($_POST['form_password'])));
    $dataInsert['CreateTime'] = date('Y-m-d H:i:s');
    if($conn->insert('tbl_user',$dataInsert)){
        echo '<script>alert("Berhasil Tambah User"); window.location.href = "tambah_user.php";</script>';exit;
    // echo 'a';exit;
    }else{
        echo 'Gagal Tambah User';exit;

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login test phiraka</title>
</head>
<body>
    <h3>FORM PENAMBAHAN USER</h3>
    <a href="index.php">Daftar User</a>
    <hr>
    <br>
    <form action="" method="post">
        <table>
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" id="form_nama" name="form_nama" autocomplete="off" maxlength="128"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" id="form_password" name="form_password" autocomplete="off" maxlength="8"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2"><button type="submit" name="logsess">Submit</button></td>

                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>
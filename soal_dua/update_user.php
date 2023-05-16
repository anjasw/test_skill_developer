<?php 
session_start();

include './config.php';
if(!isset($_SESSION['sess_log'])){
    echo '<script>alert("Maaf, harus login terlebih dahulu."); window.location.href = "login.php";</script>';exit;
}
if(isset($_GET['idpk'])){
    $id = $_GET['idpk'];
    $sql_check = 'SELECT * FROM tbl_user WHERE Id = "'.$id.'"';
    $data = $conn->query($sql_check);
    if(isset($data[0]) > 0){
        // echo json_encode($data[0]);exit;
        $form_nama = $data[0]['Username'];

    }else{
        echo '<script>alert("User Tidak Ditemukan"); window.location.href = "index.php";</script>';exit;

    }
}else{
    header('Location: index.php');
    exit;
}
if(isset($_POST['sub_form']) && isset($_GET['idpk'])){
    if(strlen($_POST['form_nama']) > 128 || strlen($_POST['form_password']) > 8){
        echo '<script>alert("Nama User atau Password terlalu panjang."); window.location.href = "index.php";</script>';exit;
    }
    $dataUpdate['Username'] = trim($_POST['form_nama']);
    $dataUpdate['Password'] = md5(sha1(trim($_POST['form_password'])));
    // $dataUpdate['LastUpdateTime'] = date('Y-m-d H:i:s');

    if($conn->update('tbl_user',$dataUpdate, array("Id" => $id))){
        echo '<script>alert("Berhasil Update User"); window.location.href = "index.php";</script>';exit;
        // echo 'a';exit;
    }else{
        echo 'Gagal Update User';exit;

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
    <h3>FORM PERUBAHAN USER</h3>
    <a href="index.php">Daftar User</a>
    <hr>
    <br>
    <form action="" method="post">
        <table>
            <tbody>
                <tr>
                    <td>New Nama</td>
                    <td><input type="text" id="form_nama" name="form_nama" autocomplete="off" value="<?php echo $form_nama ?>"></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="password" id="form_password" name="form_password" autocomplete="off"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2"><button type="submit" name="sub_form">Submit</button></td>

                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>
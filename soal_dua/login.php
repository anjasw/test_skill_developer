
<?php 
include './config.php';
// session_start(); 
if(isset($_SESSION['sess_log'])){
    header('Location: index.php');
    exit;
    // echo '<script>alert("Maaf, harus login terlebih dahulu."); window.location.href = "login.php";</script>';exit;
}
// if()
$msg = '';
$nama = '';
$password = '';

if(isset($_POST['logsess'])){
    include_once './securimage/securimage.php';
    $securimage = new Securimage();

    if ($securimage->check($_POST['security_img']) == false) {
        // kalo salah
        $msg = 'LOGIN GAGAL | Security Image tidak sesuai';
        $nama = $_POST['form_nama'];
        $password = $_POST['form_password'];
        // $password = '';
    }else{
       
        $nama = trim($_POST['form_nama']);
        $password = md5(sha1(trim($_POST['form_password'])));

        $sql_check_user = 'SELECT Username,Password,CreateTime FROM tbl_user WHERE Username = "'.$nama.'" AND Password = "'.$password.'"';
        $check = count($conn->query($sql_check_user));
        if($check > 0){
            $_SESSION['sess_log'] = true;
            $_SESSION['sess_nama'] = trim($_POST['form_nama']);
            // header('Location: index.php');
            // exit;
            echo '<script>alert("LOGIN SUKSES"); window.location.href = "index.php";</script>';exit;

        }else{
            
            $password = $_POST['form_password'];
            $msg = 'LOGIN GAGAL | User tidak ditemukan';
            
        }
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
    <h3>FORM LOGIN</h3>
    <hr>
    <form action="" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2"><?php echo $msg ?></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" id="form_nama" name="form_nama" autocomplete="off" value="<?php echo $nama ?>" maxlength="128"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" id="form_password" name="form_password" autocomplete="off" value="<?php echo $password ?>"  maxlength="8"></td>
                </tr>
                <tr>
                    <td>
                        Seccurity Image
                    </td>
                    <td>
                    <img id="captcha" src="./securimage/securimage_show.php" alt="CAPTCHA Image" />
                        

                        <a href="#" onclick="document.getElementById('captcha').src = './securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
                    </td>
                </tr>
                <tr>
                    <td>Input karakter yang muncul pada tampilan diatas</td>
                    <td><input type="text" name="security_img" size="10" maxlength="6" /></td>
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
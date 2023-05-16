<?php
session_start();
include './config.php';
if(!isset($_SESSION['sess_log'])){
    echo '<script>alert("Maaf, harus login terlebih dahulu."); window.location.href = "login.php";</script>';exit;
}
$user = $conn->query("SELECT Username,CreateTime,Id FROM tbl_user");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <h3>Daftar User</h3> 
    <a href="tambah_user.php">Tambah User</a> | 
    <a href="logout.php">Logout</a>
    <hr>
    <br>
    <table border="1">
        <thead>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Password</td>
                <td>CTime</td>
                <td colspan="2">Fungsi</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach($user as $k => $v): ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $v['Username'] ?></td>
                <td><?php echo "*****" ?></td>
                <td><?php echo date_format(date_create($v['CreateTime']),'d/m/Y') ?></td>
                <td><a href="update_user.php?idpk=<?php echo $v['Id'] ?>">Edit</a></td>
                <td><a onclick="return confirm('Yakin Hapus User?');" href="hapus_user.php?idpk=<?php echo $v['Id'] ?>">Hapus</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
    </script>
</body>
</html>
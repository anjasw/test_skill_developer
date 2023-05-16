<?php
$data = array();
$col = '';
 $row = '';
if(isset($_POST['process'])){

    $col = (int)$_POST['col'];
    $row = (int)$_POST['row'];
    // $data[1] = 'asd';
    // echo $row;exit;
    $bil_fib = array();
    // $bil_fib[0] = 0;
    for($i = 0; $i < $row; $i++){
        for($ii = 0; $ii < $col; $ii++){

            if(count($bil_fib) > 1){
                $new_fib = array_slice($bil_fib, -2, 2, true);

                $next_bil_fib = array_sum($new_fib);
                $bil_fib[] = $next_bil_fib;
                $data[$i][] = $next_bil_fib;
                
            }elseif(count($bil_fib) > 0){
                $next_bil_fib = array_sum($bil_fib) + 1;
                $bil_fib[] = $next_bil_fib;
                $data[$i][] = $next_bil_fib;
            }else{
                // $;
                $bil_fib[] = 0;
                $data[$i][] = 0;
            }
            
        }
        // exit;
        
    } 
    // foreach($)
    // echo json_encode($data);exit;
    // exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .list, .list tr, .list td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <table border="0">
            <tr>
                <td>Rows</td>
                <td><input type="number" name="row" maxlength="1" value="<?= $row ?>"></td>
            </tr>
            <tr>
                <td>Columns</td>
                <td><input type="number" name="col" maxlength="1" value="<?= $col ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="process">Submit</button></td>
            </tr>
        </table>
    </form>

    <br>
    <br>
    <?php if(count($data) > 0): ?>
    <table class="list">
        <?php foreach($data as $a => $b){ ?>
            <tr>
            <?php foreach($b as $k => $v){ ?>
                <td><?= $v?></td>
            <?php } ?>
            </tr>
        <?php } ?>
    </table>
    <?php endif; ?>
</body>
</html>
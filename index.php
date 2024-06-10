<?php
$redMessage = '';
$greenMessage = '';

if (!empty($_POST)) {
    if (isset($_POST["country"])&&$_POST["country"]!="")
    {
        $country = htmlentities($_REQUEST['country']);

        $fileStringDict=file_get_contents("dictionary.txt");
        $pos=strstr($fileStringDict, $country);
        if ($pos){
            $fileString=file_get_contents("countries.txt");
            $pos=strstr($fileString, $country);
            if ($pos===false) {
                $data = $country.":"."\r\n";
                $file=fopen("countries.txt", "a");
                fwrite($file, $data);
                fclose($file);
                $greenMessage = $country.' added successfully!';
            }
            else {
                $redMessage = $country.' already exists in thе list';
            }
        }else {
            $redMessage = $country.' is not exists in the World!';
        }
    }
    else {
        $redMessage = 'Please fill all fields';
    }
}

//вывод списка в select
$arr = file("countries.txt");
$new_arr = str_replace(":", "</option><option>", $arr);
foreach ($new_arr as $i => $a)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <form action="index.php" method="post">

            <div class="form-group">
                <label for="Country">Country</label>
                <input type="text" class="form-control" id="Country" placeholder="country" name="country">
            </div>

            <button type="submit" class="btn btn-primary" name="done">Submit</button>

            <div style="color: red"><?= $redMessage ?></div>
            <div style="color: green"><?= $greenMessage ?></div>

            <select name="countries" id="countries"
            <?php
            foreach($new_arr as $i => $a)
                echo '<option> '.$a. ' </option>';
            ?>></select>

        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

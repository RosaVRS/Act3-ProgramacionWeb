<?php
error_reporting(0);
if (isset($_GET['dir']) && isset($_GET['note'])) {
    $dir = $_GET['dir'];
    $note = $_GET['note'];
} else {
    header("Location: index.php");
}

$file = "files/" . $dir . '/' . $note;
$filed = $note . '&dir=' . $dir;

$file_contents = file_get_contents($file);
if (($_POST['save'])) {
    file_put_contents($file, $_POST['valor-nota']);
    header('Location: nota.php?note=' . $filed);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title><?php echo $note ?></title>
    <link rel="shortcut icon" href="img/logokw.png" />
</head>

<body>
    <nav class="navbar navbar-dark bg-black">
        <div class="container">
            <a class="navbar-brand" href="directorio.php?dir=<?php echo $dir ?>"><img style="width: 35px;" src="./assets/img/left-arrow.png" alt=""> Volver a <?php echo $dir ?></a>
        </div>
    </nav>

    <form method="post" action="">
        <textarea name="valor-nota" style="height: 500px;" class="form-control bg-dark" id="" cols="30" rows="10"><?php echo $file_contents; ?></textarea>
        <input class="btn btn-secondary" type="submit" name="save" value="Guardar">
    </form>

</body>

</html>
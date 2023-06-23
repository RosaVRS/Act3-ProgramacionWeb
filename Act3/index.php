<?php

$msg = null;

if (isset($_POST['create']) &&  isset($_POST['folder'])) {


    $name = $_POST['folder'];
    $directorio = "files/$name";

    try {

        if (!(is_dir($directorio))) {

            mkdir($directorio);
            $msg = 'Directorio creado.';
        } else {
            $msg = 'El directorio ya existe.';
        }
    } catch (Exception $e) {
        echo 'Error: ',  $e->getMessage(), "\n\n";
    }
}

unset($_POST['create']);
unset($_POST['folder']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotePad Nikini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="img/logokw.png" />
</head>

<body>
<div class="image">
            <img src="img/logokw.png">
        </div>
    <nav class="nav justify-content-center">
        <h1>NotePad Nikini</h1>
    </nav>
    <hr>
    <div class="row row-cols-4 w-75 mx-auto">
        <p>
            <button class="btn btn-outline-dark" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                CREAR NUEVA CARPETA
            </button>
        </p>
    </div>
    <div class="row row-cols-4 w-75 mx-auto">
        <div class="collapse" id="collapseExample">
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                <div class="input-group mb-3">
                    <input autocomplete="off" type="text" name="folder" class="form-control" placeholder="Ej: Nota" aria-describedby="button-addon2">
                    <button type="submit" name="create" class="btn btn-outline-secondary" type="button" id="button-addon2">Crear</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row row-cols-4 w-75 mx-auto">
        <strong id="negrita"><?php echo $msg ?></strong><br>
        <table class="table table-borderless caption-top table-active table-hover">
            <thead>
                <tr>
                    <th scope="col">Carpeta</th>
                    <th scope="col">Fecha de Modif.</th>
                    <th scope="col">Tipo</th>
                </tr>
            </thead>
            <tbody>

                <?php
                try {

                    $dir = 'files';
                    $dirs  = scandir($dir);

                    foreach ($dirs as $direc) {
                        if ('.' !== $direc && '..' !== $direc) {

                ?>
                            <tr>
                                <td><i class="fa-solid fa-folder-closed"></i> <a href="directorio.php?dir=<?php echo $direc ?>" class="card-link"><?php echo $direc ?></a></td>
                                <td><?php date_default_timezone_set('America/Caracas'); echo date("d-m-Y H:i:s", filemtime($dir)); ?></td>
                                <td>Carpeta de Archivos</td>
                            </tr>

                <?php
                        }
                    }
                } catch (Exception $e) {
                    echo 'Se ha encontrado un error: ',  $e->getMessage(), "\n\n";
                }

                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>
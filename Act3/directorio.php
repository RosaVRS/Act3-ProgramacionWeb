<?php

if (isset($_GET['dir'])) {
    $dir = $_GET['dir'];
    $msg = null;
    

    if (isset($_POST['createn'])) {

        if (isset($_POST['namen']) && isset($_POST['contentn']) && isset($_POST['dir'])) {
            $name = $_POST['namen'];
            $dir = $_POST['dir'];
            $content = $_POST['contentn'];
            $direct = "files/$dir/$name.txt";
            $msg = '';
            try {

                if (file_exists($direct)) {
                    $msg = "Ya existe un archivo con el nombre nombre <b>$name</b>";
                } else {
                    $nota = fopen($direct, 'a');
                    fputs($nota, $content);
                    fclose($nota);

                    header('Location: directorio.php?dir=' . $dir);
                }
            } catch (Exception $exp) {
                echo 'Excepción capturada: ',  $exp->getMessage(), "\n\n";
            }
        }
    }
    unset($_POST['createn']);
    unset($_POST['namen']);
} else {
    header("Location: index.php");
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <title><?php echo $dir ?></title>
    <link rel="shortcut icon" href="img/logokw.png" />
</head>

<body>
    <nav class="navbar navbar-dark bg-black">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img style="width: 35px;" src="./assets/img/left-arrow.png" alt=""> Inicio</a>
        </div>
    </nav>
    <br>
    <div class="container">
        <p><b><a href="index.php">/</a> <?php echo $dir ?></a></b></p>
        <hr>
        <p>
            <button class="btn btn-outline-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                CREAR NUEVO ARCHIVO
            </button>
        </p>
        <div class="collapse" id="collapseExample">
            <form action="directorio.php?dir=<?php echo $dir ?>" method="post">
                <textarea placeholder="Escribe algo..." name="contentn" style="height: 500px;" class="form-control bg-dark" id="" cols="30" rows="10"></textarea>
                <br>
                <input type="hidden" name="dir" value="<?php echo $dir ?>">
                <div class="input-group mb-3">
                    <input autocomplete="off" type="text" name="namen" class="form-control" placeholder="Ej: Nota" aria-describedby="button-addon2">
                    <button type="submit" name="createn" value="create" class="btn btn-outline-secondary" id="button-addon2">Crear</button>
                </div>
            </form>
            <br>
        </div>

        <p><?php echo $msg ?></p>
        <br>
        <div class="row row-cols-4 w-75 mx-auto">
            <table class="table table-borderless caption-top table-active table-hover">
                <caption style="color: aliceblue;">Archivos</caption>
                <thead>
                    <tr>
                        <th scope="col">Nombre de archivo</th>
                        <th scope="col">Contenido</th>
                        <th scope="col">Fecha de Modif.</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Tamaño</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $directorio = "./files/" . $dir;
                    $direc  = scandir($directorio);

                    if (count($direc) > 2) {
                        foreach ($direc as $valor) {
                            if ('.' !== $valor && '..' !== $valor) {

                                $file = "./files/" . $dir . '/' . $valor;

                                if (filesize($file) > 0) {
                                    $contents = file_get_contents($file, FILE_USE_INCLUDE_PATH);
                                } else {
                                    $contents = 'No hay contenido aun';
                                }

                    ?>
                                <tr>
                                    <td><i class="fa-sharp fa-solid fa-note-sticky"></i> <a href="nota.php?note=<?php echo $valor ?>&dir=<?php echo $dir ?>" class="card-link"><?php echo rtrim($valor) ?></a></td>
                                    <td><?php
                                        if (filesize($file) <= 29) {
                                            echo '<p class="card-text"><i>' . substr($contents, 0, 28) . '</i></p>';
                                        } else {
                                            echo '<p class="card-text"><i>' . substr($contents, 0, 28) . '...</i></p>';
                                        }
                                        ?>
                                    </td>
                                    <td><?php date_default_timezone_set('America/Caracas'); echo date("d-m-Y H:i:s", filemtime($file)); ?></td>
                                    <td><?php echo filetype($file) ?></td>
                                    <td><?php echo filesize($file) ?> bytes</td>
                                </tr>

                    <?php


                            }
                        }
                    }

                    ?>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>
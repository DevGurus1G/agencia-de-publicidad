
<?php require 'views/components/header.php'; ?> 

<main>

    <form action="/admin/editar" enctype="multipart/form-data" method="POST">

    <?php 
    
    $var = 0;

    foreach ($campos as $campo => $tipo) {

        if ($campo == 'icono') {
            echo "<input type=" . $tipo . " name='imagen' placeholder=" . $campo . " accept='image/svg+xml'>";
            continue;
        }
  
        echo "<input type=" . $tipo . " name=" . $campo . " value = " . $datos[$var] .  " placeholder=" . $campo . ">";

        $var = $var + 1;

        if($var == 4){

            echo "<input type='password' placeholder='Contraseña'>";
    
        }

    }

    

    echo $hidden;

    echo $hiddenId;

    echo "<input type='submit' value='Editar'>";

    echo "<a href='/admin'>Atras</a>";

    ?>

    </form>

</main>

<?php require 'views/components/footer.php'; ?> 
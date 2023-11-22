
<?php require 'views/components/header.php'; ?> 

<main>

    <form action="/admin/editar" method="GET">

    <?php 
    
    $var = 0;

    foreach ($campos as $campo => $tipo) {
  
        echo "<input type=" . $tipo . " name=" . $campo . " value = " . $datos[$var] .  " placeholder=" . $campo . ">";

        $var = $var + 1;

    }

    if($tipo == 'user'){

        echo "<input type='password' placeholder='Contraseña'>";

    }

    echo $hidden;

    echo $hiddenId;

    echo "<input type='submit' value='Editar'>"

    ?>

    </form>

</main>

<?php require 'views/components/footer.php'; ?> 
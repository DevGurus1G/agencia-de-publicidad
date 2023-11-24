
<?php require 'views/components/header.php'; ?> 

<main>

    <form class="formAdmin" action="/admin/editar" enctype="multipart/form-data" method="POST">

    <?php 

    $base64img = base64_encode($categoria['imagen']);
    
    $var = 0;

    foreach ($campos as $campo => $tipo) {

        if ($campo == 'icono') {

            echo "<div class='imagen-input' id='imagen-input'>
                    <div class='imagen-grupo'>
                        <object data='data:image/svg+xml;base64," . $base64img . "' type='image/svg+xml' id='avatar'></object>
                        <input type='file' name='imagen' id='imagen' placeholder='icono' accept='image/svg+xml'>
                        <label for='imagen'>Subir</label>
                    </div>
                  </div>";

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
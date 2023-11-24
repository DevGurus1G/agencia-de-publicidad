<?php require 'views/components/header.php'; ?> 

<main>

    <form class="formAdmin" action="/admin/insertar" enctype="multipart/form-data" method="POST">

    <?php 

    $base64img = base64_encode('');

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

        if ($campo == 'imagen') {

            echo "<div class='imagen-input' id='imagen-input'>
                    <div class='imagen-grupo'>
                        <img src='data:image/png;base64," . $base64img . " alt='' id='avatar'>
                        <input type='file' name='imagen' id='imagen'/>
                        <label for='imagen'>Subir</label>
                    </div>
                  </div>";

            continue;
        }

        echo "<input type=" . $tipo . " name=" . $campo . " placeholder=" . $campo . ">";

        $var = $var +1;

        if($var == 5){

            echo "
            <label for='admin'>Admin</label>
            <input type='radio' name='tipo' id='admin' value='admin' />
          
          
            <label for='comprador'>Comprador</label>
            <input type='radio' name='tipo' id='comprador' value='comprador' />
          
          
            <label for='tienda'>Tienda</label>
            <input type='radio' name='tipo' id='tienda' value='tienda' />";

            echo "<input type='password' name='password' placeholder='password'>";
    
        }

    }
    
    echo $hidden;

    echo "<input type='submit' value='Insertar'>";

    echo "<a href='/admin'>Atras</a>";

    ?>

    </form>

</main>

<?php require 'views/components/footer.php'; ?> 
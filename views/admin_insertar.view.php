<?php require 'views/components/header.php'; ?> 

<main>

    <form action="/admin/insertar" enctype="multipart/form-data" method="POST">

    <?php 

    $var = 0;

    foreach ($campos as $campo => $tipo) {
  
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

    echo "<input type='submit' value='Insertar'>"

    ?>

    </form>

</main>

<?php require 'views/components/footer.php'; ?> 
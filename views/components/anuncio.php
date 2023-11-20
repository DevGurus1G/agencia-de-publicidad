<div class="anuncio-card">
<?php
    if (!empty($imagenes)) {
        $imagenEncontrada = false;
        foreach ($imagenes as $imagen) {
            if ($imagen['anuncio_id'] == $anuncio['id'] && !$imagenEncontrada) {
                echo '<img src="data:image/jpeg;base64,' . base64_encode($imagen['imagen']) . '" alt="Foto del anuncio mostrado" />';
                $imagenEncontrada = true;
            }
        }
        if (!$imagenEncontrada) {
            echo "No se encontró la imagen para este anuncio";
        }
    } else {
        echo "No se encontraron imágenes";
    }
?>
    <div class="anuncio-card-info">
        <h2><?= $anuncio['titulo'] ?></h2>
        <p><?= $anuncio['descripcion'] ?></p>
    <!-- <span><i class="fa fa-user"></i> Publicado por: Admin</span> -->
        <a href="/anuncio?id=<?=$anuncio['id']?>">Publicado por <?= $anuncio['anunciante'] ?></a>
    </div>
</div>
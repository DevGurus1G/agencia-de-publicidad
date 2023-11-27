<?php require 'views/components/header.php'; ?>
<main>
    <div class="busqueda">
        <form>
            <input type="text" placeholder="Buscar">
        </form>
    </div>

    <div class="filtro">
        <form>
            <input type="button" id="usuarios" value="Usuarios">
            <input type="button" id="empresas" value="Empresas">
            <input type="button" id="anuncios" value="Anuncios">
            <input type="button" id="categorias" value="Categorias">
        </form>
    
    </div>
    <div id="tabla"></div>
</main>
<?php require 'views/components/footer.php'; ?>

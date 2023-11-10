CREATE TABLE IF NOT EXISTS usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE NOT NULL,
    pass VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    tipo VARCHAR(255) NOT NULL CHECK (tipo IN ('tienda', 'comprador')),
    imagen LONGBLOB NOT NULL
);

CREATE TABLE IF NOT EXISTS categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    imagen LONGBLOB NOT NULL
);

CREATE TABLE IF NOT EXISTS anuncios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias (id)
);


CREATE TABLE IF NOT EXISTS imagenes_anuncios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    imagen LONGBLOB NOT NULL,
    anuncio_id INT NOT NULL,
    FOREIGN KEY (anuncio_id) REFERENCES anuncios(id)
);

CREATE TABLE IF NOT EXISTS chat (
    id INT PRIMARY KEY AUTO_INCREMENT,
    de_usuario_id INT,
    para_usuario_id INT,
    mensaje VARCHAR(255),
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (de_usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (para_usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE IF NOT EXISTS favoritos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    anuncio_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (anuncio_id) REFERENCES anuncios(id)
);
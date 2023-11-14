-- SE QUITA EL NOT NULL DE IMAGENES PARA REALIZAR PRUEBAS
CREATE TABLE IF NOT EXISTS usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE NOT NULL,
    hashed_pass VARCHAR(255) NOT NULL,
    salt VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    tipo VARCHAR(255) NOT NULL CHECK (tipo IN ('tienda', 'comprador', 'admin')),
    imagen LONGBLOB
);

CREATE TABLE IF NOT EXISTS categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    imagen LONGBLOB
);

CREATE TABLE IF NOT EXISTS anuncios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    anunciante INT NOT NULL,
    categoria_id INT NOT NULL,
    FOREIGN KEY (anunciante) REFERENCES usuarios (id),
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

-- insert into usuarios (username,pass,email,nombre,apellidos,tipo) values ("Comprador1","Pass1","comprador1@gmail.com","nombre1","apellido1 apellido2","comprador");
-- insert into usuarios (username,pass,email,nombre,apellidos,tipo) values ("Comprador2","Pass2","comprador2@gmail.com","nombre2","apellido1 apellido2","comprador");
-- insert into usuarios (username,pass,email,nombre,apellidos,tipo) values ("tienda1","Pass3","tienda1@gmail.com","nombre3","apellido1 apellido2","tienda");
-- insert into usuarios (username,pass,email,nombre,apellidos,tipo) values ("tienda2","Pass4","tienda2@gmail.com","nombre4","apellido1 apellido2","tienda");

-- insert into categorias (nombre) values ("Vehiculos");
-- insert into categorias (nombre) values ("Electronica");
-- insert into categorias (nombre) values ("Deporte");

-- insert into anuncios (titulo,descripcion,precio,anunciante,categoria_id) values ("Vendo opel corsa","Coche seminuevo en perfecto estado",1000,3,1);
-- insert into anuncios (titulo,descripcion,precio,anunciante,categoria_id) values ("Zapatillas runner","Zapatillas para correr a una super velocidad",105.20,4,3);
-- insert into anuncios (titulo,descripcion,precio,anunciante,categoria_id) values ("Raton gaming","Raton gaming con 10000dpis y que cocina",15,3,2);
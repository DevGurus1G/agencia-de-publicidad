# Agencia de publicidad

Es un sitio web donde se puede publicar, gestionar anuncios para la sociedad de comerciantes de Vitoria

## Usuarios DEMO

| Email              | Contraseña | Tipo      |
| ------------------ | ---------- | --------- |
| jaime@gmail.com    | jaime      | comprador |
| admin@admin.com    | admin      | admin     |
| nintento@gmail.com | nintendo   | tienda    |
| elkar@gmail.com    | elkar      | tienda    |

## Guia de instalacion o desplieque

- Descargar docker
- Descargar el archivo docker-compose.yml
- Descargar la carpeta de docker
- Descargar el fichero agencia.sql
- Descargar fichero .env
  Luego crear este arbol de directorios

- /docker/DockerFApache
- /db/archivo.sql
- /docker-compose.yml
- /.env

**NOTA: El archivo .env solo se descarga por motivos de facilitar la correccion para clase ya que contiene datos sensibles de bbdd, en un ambiente real este archivo no se compartiria ni subiria a github**

Depues, ejecutar este comando en powershell desde la raiz donde hayamos guardado los archivos:

```bash
docker-compose up -d
```

## Diagrama de gantt (Temporizacion)

[Diagrama](https://awesomeopensource.com/project/elangosundar/awesome-README-templates)

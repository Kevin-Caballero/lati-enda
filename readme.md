# Lati-Enda - Proyecto de Comercio Electrónico

¡Bienvenido a LatienDa, tu nueva tienda online! Este proyecto es una aplicación web desarrollada en PHP vanilla con MySQL como base de datos. A continuación, te proporcionamos los pasos necesarios para levantar y correr la tienda en tu entorno local.

## Requisitos previos

- XAMPP (https://www.apachefriends.org/index.html)
- Git (opcional, pero recomendado)

## Pasos de instalación

### 1. Clonar el repositorio

Clona el repositorio de LatienDa en tu máquina local utilizando el siguiente comando:

```bash
git clone https://github.com/Kevin-Caballero/lati-enda
```

O descarga el código fuente como un archivo ZIP y descomprímelo en tu directorio local.

### 2. Importar la base de datos desde phpMyAdmin

- Inicia XAMPP y asegúrate de que Apache y MySQL estén activos.
- Abre tu navegador y accede a phpMyAdmin (http://localhost/phpmyadmin/).
- Navega a la pestaña "Importar" en la parte superior de la página.
- Haz clic en "Seleccionar archivo" y elige el archivo SQL ubicado en ./scripts/ce1pra.sql.
- Asegúrate de dejar todas las demás opciones como están y haz clic en "Ejecutar".
- Este proceso importará automáticamente las tablas y los datos necesarios en tu base de datos.

¡Ahora tu base de datos está lista para ser utilizada por Lati-enda!

### 3. ¡Listo para correr!

Abre tu navegador web y accede a la tienda en http://localhost/ce1pra (dependiendo donde hayas hubicado el codigo dentro de la carpeta htdocs). Deberías ver la página principal de Lati-Enda.

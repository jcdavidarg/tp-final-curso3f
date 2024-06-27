# CRUD con Login y Registro

Este proyecto es una aplicación CRUD que permite la gestión de productos con funcionalidades de login y registro de usuarios para el curso de PHP avanzado del ministerio de tres de febrero.

## FUNCIONALIDADES

- Login y Registro de usuarios
- Registro de nuevos usuarios.
- Inicio de sesión para usuarios registrados.
- Gestión de Productos
- Visualizar una lista de productos.
- Crear nuevos productos.
- Editar productos existentes.
- Eliminar productos.

## Instalación

Sigue estos pasos para instalar y configurar el proyecto en tu entorno local usando XAMPP.

### Requisitos previos

- [XAMPP](https://www.apachefriends.org/index.html) instalado en tu sistema.

### Pasos

1. **Clonar el repositorio**

   ```bash
   git clone https://github.com/tu-usuario/tu-repositorio.git
2. **Mover el proyecto a la carpeta de XAMPP**

    Mueve el proyecto clonado a la carpeta htdocs de tu instalación de XAMPP. Por ejemplo:

    mv tu-repositorio /ruta/a/xampp/htdocs/
    Configurar la base de datos
3. **Abre XAMPP y arranca los módulos de Apache y MySQL.**

    Abre phpMyAdmin desde el panel de control de XAMPP (generalmente disponible en http://localhost/phpmyadmin).
    Crea una nueva base de datos llamada rest_api_demo:
    Importa el archivo SQL que contiene la estructura y los datos iniciales de tu base de datos:

4. **Configurar el archivo de conexión a la base de datos**

    Asegúrate de que el archivo de configuración de la base de datos (config/Database.php o similar) tenga los detalles correctos para conectarse a tu base de datos de XAMPP.
5. **Acceder a la aplicación**

    Abre tu navegador y ve a http://localhost/tu-repositorio/index.php.

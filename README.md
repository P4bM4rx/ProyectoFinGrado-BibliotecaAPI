# 📚 Marchante de Libros

Aplicación web para la **gestión de una biblioteca**, desarrollada como Proyecto Fin de Grado de 2º de Desarrollo de Aplicaciones Web (DAW).

El proyecto permite a los usuarios consultar el catálogo de libros, realizar reservas y préstamos y consultar su historial. Los administradores disponen de herramientas adicionales para gestionar los libros, reservas y préstamos de la biblioteca.

---

## 🎯 Objetivo del proyecto

**Marchante de Libros** nace con el objetivo de facilitar la gestión de una biblioteca y mejorar la experiencia tanto de los usuarios como de los trabajadores.

La aplicación busca:

* Facilitar la búsqueda y consulta de libros.
* Permitir realizar y cancelar reservas.
* Gestionar préstamos y devoluciones.
* Mantener un historial de las operaciones realizadas.
* Facilitar a los administradores la gestión del catálogo.
* Mejorar la organización interna de la biblioteca.
* Proporcionar una interfaz sencilla, limpia e intuitiva.

El proyecto está pensado para adaptarse a la forma actual de consultar y gestionar los préstamos y reservas de libros mediante una aplicación web.

---

## 🛠️ Tecnologías utilizadas

### Backend

* **PHP**
* **MySQL**
* **phpMyAdmin**
* **SQL**
* **AJAX**
* Patrón **DAO**

### Frontend

* **HTML**
* **Tailwind CSS**
* **CSS**
* **JavaScript**
* **jQuery**

## La aplicación utiliza PHP para el backend y PHP/HTML, Tailwind y JavaScript para el frontend. Las peticiones AJAX permiten actualizar determinados contenidos sin necesidad de recargar completamente la página.

## 🏗️ Arquitectura

El proyecto está organizado siguiendo una separación entre las diferentes responsabilidades de la aplicación.

```text
ProyectoFinGrado-BibliotecaAPI/
│
├── _aux/
│
├── config/
│
├── controladores/
│
├── estilos/
│
├── img/
│
├── js/
│
├── modelos/
│
├── vistas/
│
├── index.php
│
└── README.md
```

La estructura actual del repositorio puede consultarse directamente en GitHub.

### Controladores

Los controladores reciben las acciones de la aplicación y se encargan de coordinar las operaciones necesarias.

Actualmente destacan:

* `ControladorLibros.php`
* `ControladorReservas.php`
* `ControladorUsuarios.php`

### Modelos y DAO

La carpeta `modelos` contiene las clases utilizadas por la aplicación y los diferentes DAO encargados del acceso a la base de datos.

Entre ellos se encuentran:

* `Categoria.php`
* `Libros.php`
* `Prestamos.php`
* `Reservas.php`
* `Usuarios.php`

Y sus correspondientes DAO:

* `CategoriaDAO.php`
* `LibrosDAO.php`
* `PrestamosDAO.php`
* `ReservasDAO.php`
* `UsuariosDAO.php`

También se encuentran:

* `ConexionDB.php` — gestión de la conexión con la base de datos.
* `Sesion.php` — gestión de las sesiones de usuario.

Esta separación permite mantener diferenciadas las entidades, el acceso a datos y la lógica utilizada por los controladores.

---

## 🗄️ Base de datos

La aplicación utiliza **MySQL** como sistema gestor de base de datos y **phpMyAdmin** para su administración.

La base de datos utilizada por el proyecto se denomina:

```text
biblioteca
```

La conexión con la base de datos se configura desde:

```text
config/config.php
```

Este archivo contiene las constantes necesarias para establecer la conexión con MySQL.

---

## 🔐 Seguridad

El proyecto incorpora diferentes medidas de seguridad.

### Contraseñas

Las contraseñas de los usuarios se almacenan utilizando mecanismos de cifrado/hash para evitar guardar las contraseñas directamente.

### Validación de datos

Los datos recibidos por la aplicación son validados para reducir riesgos relacionados con entradas maliciosas e inyección SQL.

### Control de acceso

El sistema dispone de rutas públicas y privadas.

El archivo `index.php` utiliza un mapa de rutas mediante el array `$mapa`, donde cada acción contiene información sobre:

* Controlador.
* Método.
* Si la acción es privada.

Las acciones privadas requieren que exista una sesión activa.

---

# 👥 Roles de usuario

La aplicación diferencia principalmente entre dos tipos de usuarios:

## 👤 Usuario

Los usuarios pueden:

* Registrarse.
* Iniciar sesión.
* Cerrar sesión.
* Consultar libros.
* Buscar libros por título.
* Realizar reservas.
* Cancelar reservas.
* Consultar préstamos.
* Consultar su historial.
* Consultar información sobre el proyecto.

Las funcionalidades principales para usuarios están recogidas en la documentación del proyecto.

## 👨‍💼 Administrador

Los administradores disponen de las funcionalidades de los usuarios y además pueden:

* Autorizar préstamos.
* Consultar reservas activas.
* Consultar préstamos activos.
* Añadir libros.
* Editar libros.
* Eliminar libros.
* Gestionar devoluciones.

---

# 📚 Gestión de libros

La aplicación permite consultar el catálogo completo de libros.

Desde esta sección se puede:

* Visualizar los libros disponibles.
* Buscar libros por título.
* Consultar información del libro.
* Realizar reservas.
* Consultar si un libro está prestado.

Los administradores disponen además de opciones para añadir, editar y eliminar libros.

---

# 📖 Reservas y préstamos

## Reservas

Los usuarios pueden realizar reservas de libros y cancelar sus propias reservas.

Los administradores pueden consultar las reservas activas y gestionar las operaciones relacionadas con ellas.

## Préstamos

Los usuarios pueden consultar sus préstamos y devolver libros.

Los administradores pueden autorizar préstamos, consultar los préstamos activos y gestionar las devoluciones.

---

# 🕐 Historial

Cada usuario dispone de un historial donde puede consultar las operaciones realizadas con los libros.

El historial permite consultar información relacionada con:

* Libros reservados.
* Libros prestados.
* Estado de las operaciones.
* Fechas relacionadas con los préstamos y devoluciones.

---

# ⚡ AJAX y navegación

Una de las características de la aplicación es el uso de **AJAX** para actualizar determinados contenidos sin tener que recargar completamente la página.

El archivo JavaScript realiza peticiones AJAX y actualiza el contenido del contenedor correspondiente con la respuesta obtenida del servidor.

Por ejemplo, desde la página principal se pueden cargar diferentes vistas dentro del contenedor central:

```text
Login
   ↓
Inicio
   ↓
┌─────────────────────┐
│ Ver libros          │
│ Ver historial       │
│ Sobre mí            │
└─────────────────────┘
```

De esta forma, la navegación resulta más dinámica y evita realizar recargas innecesarias.

---

# 🧭 Sistema de rutas

El archivo principal:

```text
index.php
```

contiene el sistema de mapeo de rutas mediante el array:

```php
$mapa
```

Cada ruta define:

```text
controlador
método
privada
```

Por ejemplo, conceptualmente:

```php
'ruta' => [
    'controlador' => 'Controlador...',
    'metodo' => '...',
    'privada' => true
]
```

Cuando se recibe una petición, `index.php` determina qué acción debe ejecutarse.

Si la ruta no existe, se devuelve un error **404**.

Si la ruta requiere autenticación y el usuario no tiene una sesión activa, se redirige al inicio.

---

# 📂 Principales directorios

| Directorio       | Descripción                                       |
| ---------------- | ------------------------------------------------- |
| `_aux/`          | Archivos auxiliares del proyecto                  |
| `config/`        | Configuración de la aplicación                    |
| `controladores/` | Controladores PHP                                 |
| `estilos/`       | Archivos CSS y Tailwind                           |
| `img/`           | Imágenes de usuarios, libros y elementos gráficos |
| `js/`            | JavaScript y peticiones AJAX                      |
| `modelos/`       | Modelos, DAO, conexión y sesiones                 |
| `vistas/`        | Vistas de la aplicación                           |

---

# 🖥️ Vistas

Entre las principales vistas utilizadas por la aplicación se encuentran:

```text
ajaxInicio.php
ajaxLogin.php
ajaxMenuHorizontal.php
ajaxRegistrar.php
editarLibros.php
registrarLibros.php
verBuscadorLibros.php
verHistorial.php
verLibrosCategoria.php
verPrestamos.php
verReservas.php
verSobreMi.php
```

Estas vistas representan las diferentes interfaces con las que interactúa el usuario.

---

# ⚙️ Instalación

## Requisitos

Para ejecutar el proyecto localmente se necesita:

* **XAMPP**
* **Apache**
* **MySQL**
* **phpMyAdmin**
* Una versión de PHP compatible con el proyecto.
* Navegador web.

---

## 1. Instalar XAMPP

Descarga e instala XAMPP en el equipo.

Una vez instalado, coloca el proyecto dentro de:

```text
C:\xampp\htdocs\
```

Por ejemplo:

```text
C:\xampp\htdocs\ProyectoFinGrado-BibliotecaAPI\
```

---

## 2. Iniciar los servicios

Abre el panel de control de XAMPP e inicia:

```text
Apache
MySQL
```

---

## 3. Configurar la base de datos

Accede a:

```text
http://localhost/phpmyadmin/
```

Crea/importa la base de datos correspondiente al proyecto.

El proyecto incluye el archivo necesario para importar la estructura y los datos de la base de datos.

La documentación original establece este procedimiento mediante phpMyAdmin.

---

## 4. Configurar la conexión

Revisa:

```text
config/config.php
```

y establece los datos correspondientes al servidor MySQL:

```text
Host
Usuario
Contraseña
Base de datos
```

---

## 5. Ejecutar la aplicación

Una vez iniciados Apache y MySQL, abre el navegador y accede a la dirección correspondiente al proyecto:

```text
http://localhost/ProyectoFinGrado-BibliotecaAPI/
```

La ruta exacta dependerá del nombre de la carpeta utilizada dentro de `htdocs`.

---

# 🧪 Pruebas

Durante el desarrollo se realizaron pruebas sobre las principales funcionalidades de la aplicación.

Entre ellas:

### Usuarios

* Registro.
* Registro con correo ya existente.
* Inicio de sesión.
* Inicio de sesión con datos incorrectos.
* Cierre de sesión.

### Libros

* Visualización de libros.
* Búsqueda por título.
* Añadir libros.
* Editar libros.
* Eliminar libros.

### Reservas

* Crear una reserva.
* Cancelar una reserva.
* Consultar reservas.

### Préstamos

* Realizar un préstamo.
* Devolver un libro.
* Consultar préstamos.
* Consultar historial.

Estas pruebas se realizaron tanto para usuarios normales como para administradores según correspondía.

---

# 🔮 Mejoras futuras

Entre las posibles mejoras planteadas para futuras versiones se encuentran:

* Área de atención al cliente.
* Sistema de notificaciones para usuarios y administradores.
* Edición del perfil de usuario.
* Posibilidad de donar libros a la biblioteca.
* Incorporación de nuevas funcionalidades.
* Adaptación a nuevas tecnologías.
* Refuerzo de la seguridad.
* Optimización de la comunicación entre la aplicación y la base de datos.

---

# 🎓 Proyecto Fin de Grado

Este proyecto ha sido desarrollado por:

**Pablo Marchante Fernández**

**2º DAW — Desarrollo de Aplicaciones Web**

El proyecto tiene como finalidad aplicar los conocimientos adquiridos durante el ciclo formativo, especialmente en:

* Desarrollo web con PHP.
* HTML y CSS.
* JavaScript.
* AJAX.
* Bases de datos SQL.
* Patrón DAO.
* Gestión de sesiones.
* Control de usuarios y permisos.
* Desarrollo de interfaces web.

---

## 📄 Documentación

La documentación completa del proyecto incluye:

* Análisis de requisitos.
* Diseño y planificación.
* Arquitectura.
* Diseño de interfaz.
* Implementación.
* Pruebas.
* Documentación técnica.
* Manual de usuario.
* Manual de instalación.
* Plan de mantenimiento.
* Mejoras futuras.
* Conclusiones.

---

## 🔗 Repositorio

El código fuente del proyecto está disponible en GitHub:

[ProyectoFinGrado-BibliotecaAPI — GitHub](https://github.com/P4bM4rx/ProyectoFinGrado-BibliotecaAPI?utm_source=chatgpt.com)

---

## 📜 Licencia

Proyecto desarrollado con fines académicos como parte del Proyecto Fin de Grado.

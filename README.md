<div align="center">

# Programación Web Back End

### Repositorio de cursada y proyecto final
#### Potrero Digital

![Estado](https://img.shields.io/badge/Estado-En%20desarrollo-b85a5a)
![Curso](https://img.shields.io/badge/Curso-Back%20End-4f4f4f)
![Tecnologías](https://img.shields.io/badge/Tecnologías-HTML%20%7C%20CSS%20%7C%20Bootstrap%20%7C%20PHP%20%7C%20MySQL-c9a35b)

</div>

---

## Descripción

Este repositorio reúne las actividades, prácticas y proyectos realizados durante el curso de **Programación Web Back End** de **Potrero Digital**.

El objetivo principal es integrar conocimientos de **HTML**, **CSS**, **Bootstrap**, **PHP** y **MySQL** para construir sitios dinámicos conectados a una base de datos, aplicando formularios, consultas, validaciones y operaciones de administración.

---

## Proyecto Final: DeCompritas

**DeCompritas** es una tienda web de ropa y accesorios desarrollada como proyecto final del curso.

El sitio cuenta con una vista pública tipo catálogo y un panel administrativo simple para gestionar las prendas cargadas en la base de datos.

### Funcionalidades principales

- Página principal con diseño responsive.
- Logo personalizado para la marca **DeCompritas**.
- Catálogo de productos cargados desde MySQL.
- Cards de productos con imagen, marca, talle, prenda y precio.
- Botón **Ver detalles** con modal de información completa.
- Botón **Comprar ahora** por producto mediante link de compra.
- Carrito de compras con sesiones PHP.
- Suma, resta, eliminacion y vaciado de productos seleccionados.
- Pantalla de resumen para preparar la compra total.
- Checkout simple con datos del comprador.
- Confirmacion final del pedido y vaciado automatico del carrito.
- Busqueda de productos por texto.
- Filtros por marca, talle y rango de precio.
- Ordenamiento por productos recientes, precio o marca.
- Seccion de novedades generada desde la base de datos.
- Seccion de mejores precios generada desde la base de datos.
- Pagina institucional **Quienes somos**.
- Pagina personalizada de error 404.
- Login de administrador.
- Panel para listar prendas.
- Alta de nuevas prendas con imagen.
- Modificación de prendas existentes.
- Borrado de prendas.
- Estilos propios centralizados en `tienda.css`.
- Conexion a base de datos centralizada en `conexion.php`.

### Accesos principales

| Sección | Archivo |
|---|---|
| Inicio / catálogo | `Proyecto-Final/index.php` |
| Busqueda y filtros | `Proyecto-Final/index.php#filtros` |
| Catalogo de productos | `Proyecto-Final/index.php#productos` |
| Quienes somos | `Proyecto-Final/quienes-somos.php` |
| Pagina no encontrada | `Proyecto-Final/404.php` |
| Carrito de compras | `Proyecto-Final/carrito.php` |
| Resumen de compra | `Proyecto-Final/comprar_carrito.php` |
| Finalizar compra | `Proyecto-Final/finalizar_compra.php` |
| Pedido confirmado | `Proyecto-Final/pedido_confirmado.php` |
| Login administrador | `Proyecto-Final/login.html` |
| Panel administrador | `Proyecto-Final/listar.php` |
| Agregar prenda | `Proyecto-Final/agregar.html` |
| Modificar prenda | `Proyecto-Final/modificar.php` |
| Agregar al carrito | `Proyecto-Final/agregar_carrito.php` |
| Quitar del carrito | `Proyecto-Final/quitar_carrito.php` |
| Vaciar carrito | `Proyecto-Final/vaciar_carrito.php` |
| Conexion a base de datos | `Proyecto-Final/conexion.php` |

---

## Tecnologías utilizadas

- **HTML5** para la estructura del sitio.
- **CSS3** para estilos personalizados.
- **Bootstrap 5** para componentes responsive.
- **PHP** para la lógica del lado del servidor.
- **MySQL** para almacenamiento de datos.
- **XAMPP** como entorno local de Apache y MySQL.
- **Git y GitHub** para control de versiones.

---

## Estructura del repositorio

| Carpeta / Archivo | Descripción |
|---|---|
| `Proyecto-Final/` | Proyecto final DeCompritas |
| `tarea-login/` | Práctica de login con usuario y contraseña |
| `tarea3/` | Práctica de estructuras de control |
| `tarea4-bucles/` | Práctica de bucles |
| `tarea5-arrays/` | Práctica de arrays |
| `tarea-base-de-datos/` | Primeras prácticas con base de datos |
| `tarea-select/` | Consultas SQL con `SELECT` |
| `tarea-cards/` | Práctica de cards visuales |
| `tarea-9/` | Actividad de cursada |
| `tarea-10/` | Actividad de cursada |
| `ABMcompleto/` | Práctica de alta, baja y modificación |
| `imagenes/` | Recursos gráficos del repositorio |

---

## Cómo ejecutar el proyecto

Para ejecutar este repositorio se recomienda usar **XAMPP**.

### Pasos

1. Descargar o clonar este repositorio.
2. Copiar la carpeta `Programacion-Web-BackEnd` dentro de `htdocs` de XAMPP.
3. Iniciar **Apache** y **MySQL** desde el panel de XAMPP.
4. Crear la base de datos `tienda`.
5. Crear la tabla `ropa`.
6. Abrir el navegador en:

```bash
http://localhost/Programacion-Web-BackEnd/Proyecto-Final/index.php
```

---

## Configuracion para InfinityFree

El proyecto usa el archivo `Proyecto-Final/conexion.php` para centralizar la conexion a MySQL.

En local, el archivo detecta XAMPP y usa:

```php
127.0.0.1 / root / tienda
```

En InfinityFree, el archivo usa la configuracion del hosting. Antes de subir la version final o despues de subirla desde el File Manager, completar solamente este valor:

```php
'password' => 'CAMBIAR_PASSWORD_INFINITYFREE',
```

con la password real de la base de datos del hosting.

Si el sitio esta publicado como:

```txt
https://decompritas.infinityfree.io/index.php
```

subir el contenido de `Proyecto-Final/` dentro de `htdocs`, no la carpeta completa. De esa forma las rutas relativas como `tienda.css`, `navbar-carrito.js`, `img/logo-decompritas.svg` y `404.php` funcionan correctamente.

Para que la pagina personalizada de error 404 funcione en InfinityFree, el archivo `Proyecto-Final/.htaccess` debe usar:

```apache
ErrorDocument 404 /404.php
```

---

## Base de datos

El proyecto final utiliza una base de datos llamada:

```sql
tienda
```

Tabla principal:

```sql
ropa
```

Estructura sugerida:

```sql
CREATE DATABASE tienda;

USE tienda;

CREATE TABLE ropa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  prenda VARCHAR(100) NOT NULL,
  marca VARCHAR(100) NOT NULL,
  talle VARCHAR(20) NOT NULL,
  precio DECIMAL(10, 2) NOT NULL,
  imagen LONGBLOB NOT NULL,
  link_compra VARCHAR(255) NULL
);
```

Campos utilizados por el proyecto:

| Campo | Descripción |
|---|---|
| `id` | Identificador de la prenda |
| `prenda` | Tipo de prenda |
| `marca` | Marca del producto |
| `talle` | Talle disponible |
| `precio` | Precio del producto |
| `imagen` | Imagen guardada en la base de datos |
| `link_compra` | Link externo para comprar el producto |

Si la tabla ya existe, se puede agregar el campo de compra con:

```sql
ALTER TABLE ropa
ADD COLUMN link_compra VARCHAR(255) NULL AFTER imagen;
```

El carrito de compras no requiere una tabla adicional en esta etapa. Los productos seleccionados se guardan temporalmente en `$_SESSION`, por eso cada usuario mantiene su propio carrito mientras navega por el sitio.

La finalizacion de compra actual funciona como un flujo educativo: toma los datos del comprador, recalcula el pedido desde la sesion y la base de datos, muestra una confirmacion y vacia el carrito. La integracion de pago real con Mercado Pago queda preparada como una mejora posterior.

---

## Credenciales de prueba

El panel administrativo cuenta con un login básico para fines educativos.

```txt
Usuario: admin
Contraseña: 12345
```

> Estas credenciales son solo para pruebas locales del curso.

---

## Objetivos de aprendizaje

- Comprender el flujo entre formularios HTML y scripts PHP.
- Conectar PHP con una base de datos MySQL.
- Usar sesiones PHP para mantener informacion entre paginas.
- Ejecutar consultas `SELECT`, `INSERT`, `UPDATE` y `DELETE`.
- Construir un ABM completo.
- Mostrar imágenes almacenadas en base de datos.
- Organizar un proyecto web en archivos claros.
- Aplicar estilos responsive con CSS y Bootstrap.
- Documentar un proyecto para presentación y entrega.

---

## Buenas prácticas aplicadas

- Separación entre archivos de vista, estilos y lógica PHP.
- Uso de una hoja de estilos principal: `tienda.css`.
- Navegación consistente en las páginas del proyecto final.
- Diseño responsive para escritorio, tablet y celular.
- Reutilización de componentes visuales.
- Configuracion centralizada de la conexion a MySQL.
- Validación básica de formularios mediante HTML.
- Redirecciones con `header()` en scripts PHP.
- Documentación clara para instalación y ejecución.

---

## Autor

**Alexis Roldan**

Repositorio desarrollado como parte del curso **Programación Web Back End** de **Potrero Digital**.

---

<div align="center">

### DeCompritas
**Ropa y accesorios**

</div>

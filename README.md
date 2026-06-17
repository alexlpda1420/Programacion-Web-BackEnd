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
- Filtro de productos de marca **Nike**.
- Filtro de productos **Nike XL**.
- Login de administrador.
- Panel para listar prendas.
- Alta de nuevas prendas con imagen.
- Modificación de prendas existentes.
- Borrado de prendas.
- Estilos propios centralizados en `tienda.css`.

### Accesos principales

| Sección | Archivo |
|---|---|
| Inicio / catálogo | `Proyecto-Final/index.php` |
| Productos Nike | `Proyecto-Final/nike.php` |
| Productos Nike XL | `Proyecto-Final/nikexl.php` |
| Login administrador | `Proyecto-Final/login.html` |
| Panel administrador | `Proyecto-Final/listar.php` |
| Agregar prenda | `Proyecto-Final/agregar.html` |
| Modificar prenda | `Proyecto-Final/modificar.php` |

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
  imagen LONGBLOB NOT NULL
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

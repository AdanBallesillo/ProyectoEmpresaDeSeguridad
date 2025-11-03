# 🗄️ Migraciones y Base de Datos – Proyecto SIASEG

Este documento explica el procedimiento para configurar la base de datos del proyecto, ejecutar las migraciones y cargar los datos iniciales mediante seeders.

---

## ✅ Requisitos Previos

Asegúrate de tener instaladas las siguientes herramientas:

| Herramienta     | Versión recomendada | Descripción               |
| --------------- | ------------------- | ------------------------- |
| PHP             | 8.1+                | Ejecuta Laravel           |
| Composer        | Última versión      | Manejador de dependencias |
| MySQL / MariaDB | 8.x / 10.x          | Base de datos             |
| Laravel         | 10.x                | Framework utilizado       |

Si trabajas con **Laragon**, solo verifica que MySQL está iniciado.

---

## ⚙️ Configuración de la Base de Datos

1. Crear una base de datos llamada:

   ```sql
   CREATE DATABASE prueba;
   ```

2. Editar el archivo `.env` (en la raíz del proyecto) y colocar:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=prueba
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Limpiar cachés del proyecto:

   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

---

## 🏗️ Ejecutar Migraciones

Para crear las tablas en la BD, ejecutar:

```bash
php artisan migrate
```

Si necesitas reconstruir todo desde cero (elimina tablas):

```bash
php artisan migrate:fresh
```

> ⚠️ Advertencia: `migrate:fresh` borra toda la información existente.

---

## 🌱 Cargar Datos Iniciales (Seeders)

Para insertar los datos iniciales en las tablas:

```bash
php artisan db:seed
```

Si deseas ejecutar un seeder específico:

```bash
php artisan db:seed --class=NombreDelSeeder
```

Ejemplo:

```bash
php artisan db:seed --class=EmpleadosTableSeeder
```

---

## 🧹 Problemas Comunes y Soluciones

| Error                                   | Causa                                          | Solución                                       |
| --------------------------------------- | ---------------------------------------------- | ---------------------------------------------- |
| `SQLSTATE[HY000] 1049 Unknown database` | La base no existe o está mal escrita en `.env` | Crear la base y corregir `.env`                |
| `Nothing to migrate.`                   | Las migraciones ya fueron ejecutadas           | Ejecutar `php artisan migrate:fresh`           |
| `Duplicate entry` en seeders            | Datos repetidos                                | Limpiar tabla o permitir registros únicos      |
| `Invalid datetime value '0000-00-00'`   | MySQL no admite fecha vacía                    | Asegurarse de usar `nullable()` en migraciones |

---

## 💡 Recomendaciones

- No ejecutar `migrate:fresh` en producción.
- Mantener los seeders actualizados cuando cambien datos iniciales.
- Antes de subir cambios, ejecutar migraciones en un entorno de prueba.

---

## 👥 Equipo / Contacto

Para dudas sobre la base de datos o estructura del sistema, consultar al lider de base de datos:

- Jonathan Alejandro Gutierrez Gallardo
- Tel: 4741205503
- Correo: jgutierrezgallardo@gmail.com

---

**Última actualización:** _31/10/2025_

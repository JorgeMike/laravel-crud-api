<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Proyecto de CRUD

Este proyecto es un crud basico sobre una tabla llamata tarea

Para el desarrollo de este proyecto se hizo uso de mariadb y se realizaron los siguientes paso:

```bash
php artisan install:api 
```

Se creo la migracion de la tarea:

```bash
php artisan make:migration create_tarea_table
```

SE creo la tabla en la base de datos:

```bash
php artisan migrate
```

Se creo su modelo:

```bash
php artisan make:model Tarea
```

y se creo su respectivo controlador:

```bash
php artisian make:controller Api/tareaController
```

En la raiz del proyecto existe un archivo llamado `thunder-collection.json` que es en donde vienen los enpoints programados listos para probar en el usurio de thunder client que fue en donde se hicieron las pruebas de los endpoints.
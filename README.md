# 🐾 Sistema de Gestión Veterinaria

Aplicación web desarrollada con **Laravel 12** para la gestión integral de una clínica veterinaria.  
Incluye autenticación con separación de roles, panel de administración y dashboard para veterinarios.

![Laravel 12](https://img.shields.io/badge/Laravel-12-red?style=for-the-badge&logo=laravel)
![PHP 8.4](https://img.shields.io/badge/PHP-8.4-blue?style=for-the-badge&logo=php)
![MariaDB](https://img.shields.io/badge/MariaDB-11.8-teal?style=for-the-badge&logo=mariadb)
![SB Admin 2](https://img.shields.io/badge/SB_Admin_2-template-orange?style=for-the-badge)

---

## 📋 Tabla de Contenidos

- [Tecnologías](#-tecnologías)
- [Requisitos](#-requisitos)
- [Instalación](#-instalación)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Sistema de Roles](#-sistema-de-roles)
- [Usuarios de Prueba](#-usuarios-de-prueba)
- [Rutas Disponibles](#-rutas-disponibles)

---

## 🛠 Tecnologías

| Tecnología | Versión | Uso |
|---|---|---|
| Laravel | 12.x | Framework principal (backend, rutas, ORM) |
| PHP | 8.4 | Lenguaje del servidor |
| MariaDB | 11.8 | Base de datos relacional |
| SB Admin 2 | — | Plantilla de interfaz de usuario (Bootstrap 4) |
| Font Awesome | 5.x | Íconos |

---

## ✅ Requisitos

- PHP >= 8.2
- Composer
- MariaDB / MySQL
- Servidor web (Apache / Nginx) o `php artisan serve`
- Node.js (opcional, solo si se recompilan assets)

---

## 🚀 Instalación

```bash
git clone https://github.com/williamzav/veterinaria_ia.git
cd veterinaria_ia
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

## 📁 Estructura del Proyecto
resources/views/
│
├── layouts/
│   ├── main.blade.php
│   ├── admin.blade.php
│   ├── auth.blade.php
│   └── partials/
│       ├── sidebar.blade.php
│       ├── topbar.blade.php
│       ├── footer.blade.php
│       ├── logout-modal.blade.php
│       └── admin/
│           ├── sidebar.blade.php
│           └── topbar.blade.php
│
└── modules/
├── auth/
│   └── login.blade.php
├── dashboard/
│   └── home.blade.php
└── admin/
└── dashboard.blade.php

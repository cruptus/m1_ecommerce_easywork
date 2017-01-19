# Ecommerce
- Framework PHP7 [EasyWork](https://github.com/cruptus/easywork)
- Auteur : Elbaz Jérémie (Cruptus)
- Site Web : https://www.jeremielbaz.fr
- Projet Web M1 S2I

## Pre-requis 
- PHP 7.0 
- MySQL
- Composer 1.3.1
- Apache

## Installation
Activer le mode rewrite
```bash
$ a2enmod rewrite
```
Creation de l'utilisateur et de la Base de données (require un utilisateur admin)
```mysql
CREATE DATABASE StocksetAppro;
CREATE USER 'utilisateur'@'localhost' IDENTIFIED BY 'mot_de_passe';
GRANT ALL PRIVILEGES ON StocksetAppro.* TO 'utilisateur'@'localhost';
```
Modifier le fichier `core/Config.php`
```php
/* Database */
    public static $DB_NAME = 'StocksetAppro';

    public static $DB_USER = 'utilisateur';

    public static $DB_PASSWORD = 'mot_de_passe';

    public static $DB_HOST = 'localhost';
```
Installation des dépendances
```bash
$ composer install
```



Pointer le serveur web sur le dossier `public`





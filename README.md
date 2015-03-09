PHP Modul pro administraci dotazů od publika na konferencích

Požadavky
=========

- PHP
- MySQL
- Apache s mod_rewrite
- trpělivé adminy, kterým nevadí refreshe skrz AJAX co 10 vteřin

Instalace
=========

1. Stáhnout repozitář
1. Nainstalovat jednotlivé závislosti pomocí `composer install`
1. Nastavit databázi a šifrovací klíč v .env.php
1. Migrovat databázi `php artisan migrate`
1. Vytvořit uživatele přes `php artisan tinker`

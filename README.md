# Laravel 12 MVC

Proyecto sencillo con una sola página de bienvenida en español.

## Iniciar en este equipo

Desde PowerShell, dentro del proyecto:

```powershell
.\iniciar.cmd
```

Abre http://127.0.0.1:8000. Para detenerlo, presiona Ctrl+C.
El script utiliza PHP de `C:\php` y la configuración local `.tools/php.ini`.
Usa `--no-reload` para conservar la configuración de PHP y las variables de Windows al iniciar el servidor. Si modificas `.env`, reinicia el servidor; los cambios en las vistas y el código se muestran al actualizar el navegador.
Composer está disponible en `.tools/composer.phar`. La carpeta `.tools` es local y no se versiona.

## Estructura MVC

- `app/Models/`: modelos de datos; conserva el modelo User de Laravel como base.
- `app/Http/Controllers/WelcomeController.php`: controlador de bienvenida.
- `resources/views/welcome.blade.php`: única página, con estilos incluidos.
- `routes/web.php`: conecta `/` con el controlador.

La bienvenida no consulta modelos porque no necesita datos persistentes.
Las sesiones y la caché usan archivos; las colas se ejecutan de forma síncrona.
No necesitas Node.js ni configurar una base de datos para abrir la página.

## Otros equipos

Instala PHP 8.4 o superior compatible con el archivo composer.lock y Composer, con las extensiones requeridas por Laravel y SQLite.

```sh
composer install
```

Copia `.env.example` como `.env` y ejecuta:

```sh
php artisan key:generate
php artisan serve
```

## Verificación

```powershell
& C:\php\php.exe -c .tools/php.ini artisan test
```

Documentación oficial: https://laravel.com/docs/12.x

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

## Desplegar en Vercel

La integración usa el runtime comunitario `vercel-php@0.9.0` (PHP 8.5).

1. Sube el proyecto a un repositorio de GitHub, incluyendo `composer.lock`, `api/index.php` y `vercel.json`. No subas `.env`, `.tools` ni `vendor`.
2. En Vercel, importa el repositorio como un proyecto nuevo.
3. Selecciona Framework Preset: Other, Root Directory: la raíz del repositorio y Node.js: 22.x. `vercel.json` configura la salida `public` y deja vacíos los comandos de instalación y build; el runtime instala Composer por su cuenta.
4. Añade la variable secreta `APP_KEY` en Production y Preview. Genera una clave nueva con el comando siguiente y copia el valor completo, incluido `base64:`. Conserva esa misma clave entre despliegues:

```powershell
& C:\php\php.exe -c .tools/php.ini artisan key:generate --show
```

5. Añade `APP_URL` con la URL HTTPS asignada al proyecto (por ejemplo, `https://tu-proyecto.vercel.app`).
6. Pulsa Deploy. Si cambias las variables después del despliegue, haz un Redeploy.

La configuración usa cookies para las sesiones, caché temporal en memoria y logs en stderr. Las vistas compiladas van al directorio temporal de la función. No ejecutes `iniciar.cmd` ni `artisan serve` en Vercel.

Esta configuración cubre la bienvenida actual. Si agregas datos o archivos subidos, usa una base de datos y almacenamiento externos; el disco temporal no persiste entre instancias. Las rutas actuales pasan por Laravel y no publican automáticamente nuevos archivos estáticos.

Validación local realizada con la entrada `api/index.php` y las variables de producción. La construcción y ejecución en Vercel se deben comprobar con el primer Deploy.

Referencia del runtime: https://github.com/vercel-community/php
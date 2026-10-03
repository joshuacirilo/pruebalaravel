@echo off
setlocal
cd /d "%~dp0"
set "PHPRC=%~dp0.tools\php.ini"
"C:\php\php.exe" artisan serve --host=127.0.0.1 --port=8000 --no-reload

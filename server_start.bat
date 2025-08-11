@echo off
REM Get local IP (IPv4)
FOR /F "tokens=14" %%i IN ('ipconfig ^| findstr "IPv4" ^| findstr /V "127.0.0.1"') DO SET LANIP=%%i

REM Show detected IP
echo Detected LAN IP: %LANIP%

REM Update APP_URL in .env
powershell -Command "(Get-Content .env) -replace 'APP_URL=.*', 'APP_URL=http://%LANIP%:8000' | Set-Content .env"

REM Clear Laravel cache
php artisan config:clear
php artisan cache:clear

REM Start Laravel server on LAN IP
php artisan serve --host=%LANIP% --port=8000
pause

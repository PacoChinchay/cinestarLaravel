## Instalación y configuración del proyecto Laravel 12

Después de clonar el repositorio, sigue estos pasos para ejecutar el proyecto:

```bash
# 1. Instalar las dependencias de PHP con Composer
composer install

# 2. Copiar el archivo de configuración de entorno
cp .env.example .env

# 3. Generar la clave de la aplicación
php artisan key:generate

# 4. (Opcional) Ejecutar migraciones y seeders si aplica
php artisan migrate --seed

# 5. Ejecutar el servidor local (opcional)
php artisan serve

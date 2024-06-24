# Laravelv10 - Sistema de Gestión Documental

Este proyecto es una implementación de un Sistema de Gestión Documental utilizando Laravel 10.

## Descargar

Para clonar el repositorio, ejecuta:

```sh
git clone https://github.com/dakaidev/laravelv10.git

# Configura la conexión a la base de datos en el archivo `.env`
# Asegúrate de que estas variables estén configuradas correctamente:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=databaseSGD
# DB_USERNAME=root
# DB_PASSWORD=

# Ejecuta las migraciones y crea la base de datos cuando se te solicite
php artisan migrate

# Pobla la base de datos con datos de ejemplo, incluyendo la creación de un administrador (admin@gmail.com / 0T1producci0n)
php artisan db:seed

# Inicia el servidor de desarrollo
php artisan serve

# Compila los assets de frontend
npm run dev
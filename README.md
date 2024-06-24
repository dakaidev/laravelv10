# Descargar

Para descargar, ejecuta:

```sh
git clone https://github.com/dakaidev/laravelv10.git
```

# Instalacion
Una vez que esté descargado, debes hacer una copia a `.env`.

```sh
cp .env.example .env
```
Ahora instalar composer:
```sh
composer install
```

Generar la Key:

```sh
php artisan key:generate
```

# Configuración

Ahora debes configurar algunos datos para tu aplicación, como la el nombre de la BD. Dirígete al archivo `.env`. Aqui modificar el nombre por `databaseSGD` como se muestra acontinuación:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=databaseSGD
DB_USERNAME=root
DB_PASSWORD=
```
ahora hacer la migracion:
```sh
php artisan migrate
```
A continuación se mostrara el siguiente mensaje `Would you like to create it? (yes/no) [no]`, escribir  `yes` para crear el DB.

Ahora crearemos el `admin` donde el ususario sera `admin@gmail.com` y la contraseña `0T1producci0n`, tambien se crearan algunas tablas con datos por default en la carpeta seeders.
```sh
php artisan db:seed
```
Ejecutamos el siguiente comando:
```sh
nom run dev
```

y por ultimo 
```sh
php artisan serve
```



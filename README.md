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
cd mv
```
```sh
cd Scripts
```
```sh
activate
```

Regresamos a `/apiTrivIARaymundo` y a continuacion instalamos lo siguiente:

```sh
pip install fastapi uvicorn
```
```sh
pip install scikit-learn sqlalchemy pymysql
```
```sh
pip install pandas
```
```sh
pip install cryptography
```
## Configuración

Ir a `config/dbp.py` y modificar la contraseña de mysql `contraseña` y el nombre de tu base de datos `basededatos` :
```sh
URL_DATABASE = 'mysql+pymysql://root:contraseña@localhost:3306/basededatos'
```
## Iniciar

En `/apiTrivIARaymundo` ejecutar:
```sh
uvicorn main:app --reload
```

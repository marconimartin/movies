<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Movies Manager ##
Administrador de títulos de películas.

---
## Requisitos ##
- git
- docker

## Clonar Proyecto

```
cd ~/<your-proyects-root-dir>
git clone https://github.com/marconimartin/movies.git movies
cd movies
chmod -R 777 storage
docker-compose up -d
```

## Inicializar Proyecto
(se puede repetir tantas veces como sea necesario)
```
// En la carpeta del proyecto
cp .env.example .env
docker-compose up -d
docker-compose exec app sh

    // Dentro del contenedor
    php artisan migrate:fresh --seed
        // ^ repetir si hay clave duplicada.
    php artisan passport:install
      
    // Copiar las credenciales mostradas.
    // Para consumir la API usar "Laravel Password Grant Client".
    // En caso de no copiar las credenciales, se pueden recuperar
    // de la base dedatos de la tabla tabla oauth_clients.
```

## Correr el Proyecto (web)
```
// En la carpeta del proyecto (en caso que no esté corriendo)
docker-compose up -d 
```

**En el navegador :**

- **url** : [localhost:8105](https://localhost:8105)
- **usuario** : admin@movies.com
- **contraseña** : 123456
 
En **data** hay archivos **.CSV** con datos (títulos de películas) para probar la importación
con web o api.

---

## Para ingresar a los contenedores
```
// En la carpeta del proyecto
docker-compose exec **app** sh
docker-compose exec **db** sh
docker-compose exec **web** sh
```

---
## API ##
Para probar la API, se proporciona una colección de peticiones de postman (v2.1) para realizar pruebas.
Se encuentran en la carpeta **data**.


---
## Permisos ### 
(en caso de ser necesario)
```
cd ~/<your-proyects-root-dir>/movies    // (fuera de contenedores)
sudo chown -R $USER:$USER .
sudo chmod -R +w .
chmod -R 777 storage

```

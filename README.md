# API Laravel para Gestión de Herramientas

Esta es una API construida con Laravel para gestionar herramientas. Permite registrar usuarios, iniciar sesión, gestionar herramientas y autenticar solicitudes mediante JWT (JSON Web Token).

## Despliegue

Para desplegar esta API, sigue los siguientes pasos:

### Requisitos previos
1. Tener instalado PHP (>= 8.0)
2. Tener instalado Composer
3. Tener instalado MySQL o cualquier otra base de datos compatible con Laravel
4. Tener instalado Node.js (opcional, para el entorno de desarrollo)

### Pasos de instalación

1. **Clona el repositorio:**

   ```bash
   git clone <URL_DEL_REPOSITORIO>
   cd <nombre_del_directorio>
   ```

2. **Instala las dependencias:**

   Ejecuta el siguiente comando para instalar las dependencias de Laravel:

   ```bash
   composer install
   ```

3. **Configura el archivo `.env`:**

   Copia el archivo `.env.example` a `.env` y configura los parámetros de la base de datos:

   ```bash
   cp .env.example .env
   ```

   Luego, actualiza el archivo `.env` con los datos de tu base de datos.

4. **Genera la clave de la aplicación:**

   ```bash
   php artisan key:generate
   ```

5. **Ejecuta las migraciones:**

   Para crear las tablas necesarias en la base de datos, ejecuta:

   ```bash
   php artisan migrate
   ```

6. **Instala JWT:**

   Si aún no has instalado JWT, asegúrate de tener el paquete `tymon/jwt-auth` instalado:

   ```bash
   composer require tymon/jwt-auth
   ```

   Luego, publica el archivo de configuración de JWT:

   ```bash
   php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
   ```

7. **Configura JWT:**

   En el archivo `.env`, agrega las siguientes líneas para configurar JWT:

   ```env
   JWT_SECRET=generate_this_using_php artisan jwt:secret
   ```

   Puedes generar el valor de `JWT_SECRET` ejecutando:

   ```bash
   php artisan jwt:secret
   ```

### Ejecuta la aplicación

1. **Desarrollo:**

   ```bash
   php artisan serve
   ```

   La aplicación debería estar disponible en `http://localhost:8000`.

2. **Producción:**

   Para desplegar en producción, configura tu servidor web y ejecuta las optimizaciones de producción:

   ```bash
   php artisan optimize
   ```

   También puedes configurar un entorno de producción como:

   ```bash
   php artisan config:cache
   php artisan route:cache
   ```

## Endpoints

### 1. **Ruta raíz:**

```http
GET / 
```

Devuelve un mensaje básico:

```json
{
  "message": "API LARAVEL"
}
```

### 2. **Registro de Usuario:**

```http
POST /register
```

**Cuerpo de la solicitud:**
```json
{
  "name": "Nombre del Usuario",
  "email": "usuario@ejemplo.com",
  "password": "contraseña"
}
```

Devuelve un mensaje de éxito:

```json
{
  "user": {
    "id": 1,
    "name": "Nombre del Usuario",
    "email": "usuario@ejemplo.com"
  },
  "message": "Usuario registrado exitosamente"
}
```

### 3. **Inicio de Sesión:**

```http
POST /login
```

**Cuerpo de la solicitud:**
```json
{
  "email": "usuario@ejemplo.com",
  "password": "contraseña"
}
```

Devuelve un token de autenticación JWT:

```json
{
  "message": "Usuario logueado con éxito",
  "token": "jwt_token_aqui"
}
```

### 4. **Cerrar Sesión:**

```http
POST /logout
```

Requiere que el usuario esté autenticado mediante JWT. Devuelve un mensaje de éxito:

```json
{
  "message": "Sesión cerrada correctamente"
}
```

### 5. **Gestionar Herramientas:**

- **Ver todas las herramientas:**

```http
GET /tools
```

Devuelve todas las herramientas disponibles:

```json
[
  {
    "id": 1,
    "name": "Martillo",
    "description": "Martillo de acero",
    "quantity": 10,
    "location": "Almacén A",
    "user_id": 1
  }
]
```

- **Añadir una nueva herramienta:**

```http
POST /tools
```

**Cuerpo de la solicitud:**
```json
{
  "name": "Martillo",
  "description": "Martillo de acero",
  "quantity": 10,
  "location": "Almacén A"
}
```

Devuelve la herramienta creada:

```json
{
  "id": 1,
  "name": "Martillo",
  "description": "Martillo de acero",
  "quantity": 10,
  "location": "Almacén A",
  "user_id": 1
}
```

- **Ver detalles de una herramienta:**

```http
GET /tools/{id}
```

Devuelve los detalles de una herramienta específica:

```json
{
  "id": 1,
  "name": "Martillo",
  "description": "Martillo de acero",
  "quantity": 10,
  "location": "Almacén A",
  "user_id": 1
}
```

- **Actualizar una herramienta:**

```http
PUT /tools/{id}
```

**Cuerpo de la solicitud:**
```json
{
  "name": "Martillo actualizado",
  "description": "Martillo de acero actualizado",
  "quantity": 15,
  "location": "Almacén B"
}
```

- **Eliminar una herramienta:**

```http
DELETE /tools/{id}
```

Devuelve un mensaje de éxito:

```json
{
  "message": "Tool deleted"
}
```

## Comandos Útiles

- Para iniciar el servidor de desarrollo:

  ```bash
  php artisan serve
  ```

- Para ejecutar migraciones:

  ```bash
  php artisan migrate
  ```

- Para crear una clave JWT:

  ```bash
  php artisan jwt:secret
  ```


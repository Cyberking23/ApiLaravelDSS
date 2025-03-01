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

6. **Configura JWT:**

   En el archivo `.env`, agrega las siguientes líneas para configurar JWT:

   ```env
   JWT_SECRET=<token>
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

# **Despliegue con Docker y Kubernetes**

## **1. Construcción y ejecución con Docker**

### **1.1. Construir la imagen de Docker**
Ejecuta el siguiente comando en la raíz de tu proyecto para crear una imagen Docker con tu API Laravel:

```bash
docker build -t <nombre_imagen> .
```
Ejemplo:
```bash
docker build -t laravel-api .
```

### **1.2. Ejecutar un contenedor con Docker**
Ahora, ejecuta un contenedor basado en la imagen creada:

```bash
docker run -d --name <nombre_contenedor> -p <puerto>:80 <nombre_imagen>
```

Ejemplo:
```bash
docker run -d --name laravel-api-container -p 8080:80 laravel-api
```
Esto ejecutará la API en el puerto `8080` de tu máquina y la redirigirá al puerto `80` del contenedor.

### **1.3. Verificar que el contenedor está corriendo**
Ejecuta:

```bash
docker ps
```
Esto mostrará todos los contenedores en ejecución.

Para verificar si la API responde correctamente:

```bash
curl http://localhost:8080
```

Si ves la respuesta de Laravel, significa que el contenedor está funcionando correctamente.

---

## **2. Preparar la imagen para Kubernetes**

Para desplegar la imagen en Kubernetes, primero debemos subirla a Docker Hub.

### **2.1. Iniciar sesión en Docker Hub**
Ejecuta el siguiente comando y proporciona tus credenciales:

```bash
docker login
```

### **2.2. Etiquetar la imagen para Docker Hub**
Antes de subirla, necesitamos etiquetarla con nuestro usuario de Docker Hub:

```bash
docker tag <nombre_imagen> <usuario_dockerhub>/<nombre_imagen>:latest
```

Ejemplo:
```bash
docker tag laravel-api pgap22/laravel-api:latest
```

### **2.3. Subir la imagen a Docker Hub**
Ahora, subimos la imagen:

```bash
docker push <usuario_dockerhub>/<nombre_imagen>:latest
```

Ejemplo:
```bash
docker push pgap22/laravel-api:latest
```

---

## **3. Configurar Kubernetes con Minikube**

### **3.1. Instalar `kubectl` y `minikube`**
#### **Windows**
1. Descarga `kubectl` desde: [https://kubernetes.io/docs/tasks/tools/](https://kubernetes.io/docs/tasks/tools/)
2. Descarga Minikube desde: [https://minikube.sigs.k8s.io/docs/start/](https://minikube.sigs.k8s.io/docs/start/)
3. Instala y verifica con:
   ```bash
   kubectl version --client
   minikube version
   ```

#### **Linux (Ubuntu/Debian)**
Ejecuta:

```bash
curl -LO "https://dl.k8s.io/release/$(curl -L -s https://dl.k8s.io/release/stable.txt)/bin/linux/amd64/kubectl"
chmod +x kubectl
sudo mv kubectl /usr/local/bin/

curl -LO https://storage.googleapis.com/minikube/releases/latest/minikube-linux-amd64
chmod +x minikube-linux-amd64
sudo mv minikube-linux-amd64 /usr/local/bin/minikube
```

Verifica la instalación con:

```bash
kubectl version --client
minikube version
```

---

## **4. Iniciar Minikube y desplegar la API**

### **4.1. Iniciar Minikube**
Ejecuta:

```bash
minikube start
```

Si usas Docker como driver:

```bash
minikube start --driver=docker
```

### **4.2. Aplicar los archivos de Kubernetes**
Ahora, dentro de la carpeta del repositorio, ejecuta:

```bash
kubectl apply -f deployment.yaml
kubectl apply -f service.yaml
kubectl apply -f hpa.yaml
```

### **4.3. Verificar que los pods están corriendo**
Ejecuta:

```bash
kubectl get pods
```

Para ver los detalles del despliegue:

```bash
kubectl describe deployment mi-api
```

---

## **5. Exponer la API**

Si `service.yaml` usa `LoadBalancer`, puedes ejecutar:

```bash
minikube tunnel
```

Si prefieres `port-forward`, usa:

```bash
kubectl port-forward service/api-service 8080:80
```

Ahora, puedes acceder a la API en:

```bash
http://localhost:8080
```

---

Con estos pasos, tienes tu API Laravel corriendo en Kubernetes con Minikube. 🚀 ¡Déjame saber si necesitas ajustes!
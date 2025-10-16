# ProyectoEmpresaDeSeguridad
En este repositorio se estaran subiendo los avances del proyecto, favor de crear una rama diferente para cada avance con un nombre decente y antes de hacer el merge hay que acudir a las personas encargadas de QA para que den el visto bueno. 
Si tienen alguna duda con respecto al manejo de GitHub pregunten ya sea a los compañeros o investiguen para evitar errores y malos entendidos.

# Instalación del proyecto:

### REQUISITOS PARA EL PROYECTO: 
Tener instalado PHP 8.4 y Composer

**Para ver la versión de PHP y Composer: **

*php -v* 

*composer -v*


**1.Clonar el repositorio:** *git clone git@github.com:AdanBallesillo/ProyectoEmpresaDeSeguridad.git*

**2. Entrar a la ruta del proyecto:** *cd ProyectoEmpresaDeSeguridad/SIASEG*

**3. Dentro de la carpeta SIASEG, descargar e instalar dependencias que el proyecto necesita para funcionar:** *composer install*

**4. Copiar y crear un nuevo .env:**

***Para Windows:*** *copy .env.example .env*

***Para Linux:*** *cp .env.example .env*

**5. Generar la llave:** *php artisan key:generate*

**6. Probar si puede arrancar el servidor:** *php artisan serve*

**7. Entrar a la ruta que da el server, por ejemplo: [http://127.0.0.1:8000], entrar y ver si carga la pagina.**

# 📚 Sistema de Calificaciones

### Gestión Académica Completa

![Status](https://img.shields.io/badge/status-active-success.svg)
![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?logo=javascript&logoColor=black)
![License](https://img.shields.io/badge/license-Educational-green.svg)

**Sistema web profesional para la gestión integral de estudiantes, profesores, exámenes y calificaciones**

[✨ Características](#-características-principales) • 
[🚀 Instalación](#-instalación-paso-a-paso) • 
[📖 Documentación](#-documentación) • 
[🐛 Problemas](#-solución-de-problemas)

---

</div>

## 📋 Tabla de Contenidos

- [Descripción](#-descripción-del-proyecto)
- [Características](#-características-principales)
- [Tecnologías](#️-stack-tecnológico)
- [Estructura](#-estructura-del-proyecto)
- [Base de Datos](#️-base-de-datos)
- [Instalación](#-instalación-paso-a-paso)
- [Uso](#-guía-de-uso)
- [API](#-documentación-api)
- [Solución de Problemas](#-solución-de-problemas)
- [Contribución](#-contribuir)
- [Licencia](#-licencia)
- [Contacto](#-contacto)

---

## 🎯 Descripción del Proyecto

Sistema web completo desarrollado para instituciones educativas que necesitan administrar eficientemente:

- 👨‍🎓 **Registro y gestión de estudiantes**
- 👨‍🏫 **Control de personal docente**
- 📝 **Creación y seguimiento de exámenes**
- 🎯 **Organización de grupos académicos**
- 📊 **Seguimiento de calificaciones y evaluaciones**

> **Ideal para:** Colegios, institutos, academias y centros de formación que buscan digitalizar su gestión académica.

---

## ✨ Características Principales

<table>
<tr>
<td width="50%">

### 🎨 Interfaz Intuitiva
- ✅ Diseño limpio y profesional
- ✅ Navegación simplificada
- ✅ Responsive design
- ✅ Experiencia de usuario optimizada

### 🔐 Gestión Completa
- ✅ CRUD completo para todas las entidades
- ✅ Validación de datos en tiempo real
- ✅ Confirmaciones antes de eliminar
- ✅ Mensajes de éxito/error claros

</td>
<td width="50%">

### ⚡ Rendimiento
- ✅ Respuestas rápidas
- ✅ Optimización de consultas SQL
- ✅ Carga asíncrona de datos
- ✅ Manejo eficiente de recursos

### 📱 Tecnología Moderna
- ✅ Arquitectura MVC
- ✅ API RESTful
- ✅ JavaScript vanilla (sin dependencias pesadas)
- ✅ MySQL robusto

</td>
</tr>
</table>

---

## 🛠️ Stack Tecnológico

<div align="center">

<table>
<tr>
<td align="center" width="20%">
<img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg" width="50" height="50"/>
<br><b>HTML5</b>
<br><sub>Estructura</sub>
</td>
<td align="center" width="20%">
<img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-original.svg" width="50" height="50"/>
<br><b>CSS3</b>
<br><sub>Estilos</sub>
</td>
<td align="center" width="20%">
<img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" width="50" height="50"/>
<br><b>JavaScript</b>
<br><sub>Lógica Frontend</sub>
</td>
<td align="center" width="20%">
<img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" width="50" height="50"/>
<br><b>PHP</b>
<br><sub>Backend MVC</sub>
</td>
<td align="center" width="20%">
<img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original.svg" width="50" height="50"/>
<br><b>MySQL</b>
<br><sub>Base de Datos</sub>
</td>
</tr>
</table>

### Servidor de Desarrollo

<img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/apache/apache-original.svg" width="40" height="40"/> **XAMPP** - Apache + MySQL + PHP

</div>

---

## 📁 Estructura del Proyecto

```
examenes_proyecto/
│
├── 📂 config/                       # ⚙️ Configuraciones
│   ├── 📄 config.php               # Configuración general
│   ├── 📄 database.php             # Conexión a BD
│   └── 📄 test_conexion.php        # Test de conexión
│
├── 📂 controllers/                  # 🎮 Controladores MVC
│   ├── 📄 AlumnoController.php
│   ├── 📄 ProfesorController.php
│   ├── 📄 ExamenController.php
│   └── 📄 GrupoController.php
│
├── 📂 models/                       # 📊 Modelos de Datos
│   ├── 📄 Alumno.php
│   ├── 📄 Profesor.php
│   ├── 📄 Examen.php
│   └── 📄 Grupo.php
│
├── 📂 middleware/                   # 🔒 Middleware
│   └── 📄 Auth.php
│
├── 📂 routes/                       # 🛣️ Enrutamiento
│   └── 📄 api.php
│
├── 📂 utils/                        # 🔧 Utilidades
│   ├── 📄 Response.php             # Respuestas HTTP
│   ├── 📄 Validator.php            # Validaciones
│   ├── 📄 .htaccess               # Reescritura URLs
│   ├── 📄 api.php                 # Entry point API
│   ├── 📄 index.php
│   └── 📄 test_db.php
│
└── 📂 frontend/                     # 🎨 Interfaz de Usuario
    ├── 📂 pages/                    # Páginas HTML
    │   ├── 📄 alumnos.html         # 👨‍🎓 Gestión Alumnos
    │   ├── 📄 profesores.html      # 👨‍🏫 Gestión Profesores
    │   ├── 📄 examenes.html        # 📝 Gestión Exámenes
    │   └── 📄 grupos.html          # 🎯 Gestión Grupos
    │
    ├── 📄 index.html                # 🏠 Panel Principal
    ├── 📄 styles.css                # 💅 Estilos globales
    ├── 📄 scripts.js                # ⚡ Scripts principales
    ├── 📄 app.js                    # 📱 Aplicación
    ├── 📄 server.js                 # 🖥️ Servidor Node (opcional)
    ├── 📄 package.json              # 📦 Dependencias
    └── 📂 node_modules/             # 📚 Módulos Node
```

---

## 🗄️ Base de Datos

### 📌 Nombre: `profesores`

<details>
<summary><b>📊 Esquema de Tablas (Click para expandir)</b></summary>

<br>

#### 🎓 Tabla: `alumno`
| Campo | Tipo | Descripción |
|-------|------|-------------|
| `matricula` | INT (PK) | ID único del alumno |
| `nombre` | VARCHAR(100) | Nombre completo |
| `grupo` | VARCHAR(10) (FK) | Grupo asignado |

#### 👨‍🏫 Tabla: `profesor`
| Campo | Tipo | Descripción |
|-------|------|-------------|
| `dni` | INT (PK) | Documento de identidad |
| `nombre` | VARCHAR(100) | Nombre completo |

#### 📝 Tabla: `examen`
| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | INT (PK) | ID del examen |
| `nombre` | VARCHAR(100) | Título del examen |
| `fecha` | DATE | Fecha de aplicación |
| `grupo_id` | VARCHAR(10) (FK) | Grupo al que aplica |

#### 🎯 Tabla: `grupo`
| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | VARCHAR(10) (PK) | Código del grupo (A1, B2, etc.) |
| `nombre` | VARCHAR(50) | Nombre descriptivo |

#### 📚 Tabla: `practica`
| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | INT (PK) | ID de la práctica |
| `titulo` | VARCHAR(100) | Título de la práctica |
| `descripcion` | TEXT | Descripción detallada |

#### 🔗 Tabla: `presenta`
| Campo | Tipo | Descripción |
|-------|------|-------------|
| `alumno_id` | INT (FK) | Referencia al alumno |
| `examen_id` | INT (FK) | Referencia al examen |
| `calificacion` | DECIMAL(5,2) | Nota obtenida |
| `fecha_presentacion` | DATETIME | Fecha y hora |

#### ✅ Tabla: `realiza`
| Campo | Tipo | Descripción |
|-------|------|-------------|
| `alumno_id` | INT (FK) | Referencia al alumno |
| `practica_id` | INT (FK) | Referencia a la práctica |
| `completada` | BOOLEAN | Estado de completitud |
| `fecha` | DATE | Fecha de realización |

</details>

<details>
<summary><b>🔍 Diagrama de Relaciones</b></summary>

<br>

```
┌─────────────┐         ┌─────────────┐         ┌─────────────┐
│   ALUMNO    │────┬───▶│   GRUPO     │◀───┬────│   EXAMEN    │
│             │    │    │             │    │    │             │
│ • matricula │    │    │ • id        │    │    │ • id        │
│ • nombre    │    │    │ • nombre    │    │    │ • nombre    │
│ • grupo_id  │    │    └─────────────┘    │    │ • fecha     │
└─────────────┘    │                       │    │ • grupo_id  │
       │           │                       │    └─────────────┘
       │           │                       │           │
       ▼           │                       │           ▼
┌─────────────┐   │                       │    ┌─────────────┐
│  PRESENTA   │◀──┘                       └───▶│  PRACTICA   │
│             │                                 │             │
│ • alumno_id │                                 │ • id        │
│ • examen_id │                                 │ • titulo    │
│ • calif.    │                                 │ • descrip.  │
└─────────────┘                                 └─────────────┘
       │                                               │
       └───────────────────┬───────────────────────────┘
                           ▼
                    ┌─────────────┐
                    │   REALIZA   │
                    │             │
                    │ • alumno_id │
                    │ • pract_id  │
                    │ • completada│
                    └─────────────┘
```

</details>

---

## 🚀 Instalación Paso a Paso

### 📋 Requisitos Previos

Antes de comenzar, asegúrate de tener instalado:

- ✅ **XAMPP** v3.3.0 o superior → [Descargar](https://www.apachefriends.org/)
- ✅ **Navegador moderno** (Chrome, Firefox, Edge)
- ✅ **Editor de código** (VS Code recomendado) → [Descargar](https://code.visualstudio.com/)
- ✅ **Git** (opcional) → [Descargar](https://git-scm.com/)

---

### 📥 Paso 1: Descargar el Proyecto

**Opción A: Clonar con Git**
```bash
git clone https://github.com/tu-usuario/examenes_proyecto.git
cd examenes_proyecto
```

**Opción B: Descargar ZIP**
1. Descargar el archivo ZIP del repositorio
2. Extraer en una carpeta de tu elección
3. Renombrar a `examenes_proyecto` (sin espacios)

---

### 🔧 Paso 2: Instalar y Configurar XAMPP

1. **Instalar XAMPP**
   - Ejecutar el instalador descargado
   - Seguir el asistente de instalación
   - Instalar en: `C:/xampp` (ruta recomendada)

2. **Abrir XAMPP Control Panel**
   - Ejecutar como administrador
   - ![XAMPP Control Panel](https://via.placeholder.com/600x200/333/fff?text=XAMPP+Control+Panel)

3. **Iniciar Servicios**
   ```
   ✅ Apache  → Click en "Start"  (debe ponerse verde)
   ✅ MySQL   → Click en "Start"  (debe ponerse verde)
   ```

4. **Verificar que los servicios están corriendo**
   - Apache: Puerto 80 (o 8080)
   - MySQL: Puerto 3306 (o 3307)

<details>
<summary>⚠️ <b>¿Problemas con los puertos?</b> Click aquí</summary>

<br>

**Si Apache no inicia (Puerto 80 ocupado):**

1. Abrir archivo de configuración:
   ```
   C:/xampp/apache/conf/httpd.conf
   ```

2. Buscar y cambiar:
   ```apache
   Listen 80          →  Listen 8080
   ServerName localhost:80  →  ServerName localhost:8080
   ```

3. Guardar y reiniciar Apache

4. Ahora acceder vía: `http://localhost:8080`

---

**Si MySQL no inicia (Puerto 3306 ocupado):**

1. Abrir archivo de configuración:
   ```
   C:/xampp/mysql/bin/my.ini
   ```

2. Buscar y cambiar:
   ```ini
   port=3306    →  port=3307
   ```

3. Actualizar `config/database.php`:
   ```php
   define('DB_PORT', '3307');
   ```

4. Guardar y reiniciar MySQL

</details>

---

### 📂 Paso 3: Copiar el Proyecto a XAMPP

1. Copiar toda la carpeta `examenes_proyecto`
2. Pegar en: `C:/xampp/htdocs/`
3. Ruta final: `C:/xampp/htdocs/examenes_proyecto/`

```
C:/
└── xampp/
    └── htdocs/
        └── examenes_proyecto/   ← Aquí debe estar tu proyecto
            ├── config/
            ├── controllers/
            ├── frontend/
            └── ...
```

---

### 🗄️ Paso 4: Crear la Base de Datos

1. **Abrir phpMyAdmin**
   ```
   http://localhost/phpmyadmin
   ```

2. **Crear nueva base de datos**
   - Click en "Nueva" (New) en el panel izquierdo
   - Nombre: `profesores`
   - Cotejamiento: `utf8mb4_unicode_ci`
   - Click en "Crear"

3. **Importar el esquema** (si tienes archivo SQL)
   - Seleccionar la base de datos `profesores`
   - Click en pestaña "Importar"
   - Seleccionar archivo SQL
   - Click en "Continuar"

<details>
<summary>📄 <b>¿No tienes el archivo SQL?</b> Usa este script</summary>

<br>

Ejecuta este SQL en phpMyAdmin:

```sql
-- Crear base de datos
CREATE DATABASE IF NOT EXISTS profesores 
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE profesores;

-- Tabla grupo
CREATE TABLE grupo (
    id VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

-- Tabla alumno
CREATE TABLE alumno (
    matricula INT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    grupo VARCHAR(10),
    FOREIGN KEY (grupo) REFERENCES grupo(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Tabla profesor
CREATE TABLE profesor (
    dni INT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

-- Tabla examen
CREATE TABLE examen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    fecha DATE,
    grupo_id VARCHAR(10),
    FOREIGN KEY (grupo_id) REFERENCES grupo(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabla practica
CREATE TABLE practica (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT
) ENGINE=InnoDB;

-- Tabla presenta (relación alumno-examen)
CREATE TABLE presenta (
    alumno_id INT,
    examen_id INT,
    calificacion DECIMAL(5,2),
    fecha_presentacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (alumno_id, examen_id),
    FOREIGN KEY (alumno_id) REFERENCES alumno(matricula) ON DELETE CASCADE,
    FOREIGN KEY (examen_id) REFERENCES examen(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabla realiza (relación alumno-practica)
CREATE TABLE realiza (
    alumno_id INT,
    practica_id INT,
    completada BOOLEAN DEFAULT FALSE,
    fecha DATE,
    PRIMARY KEY (alumno_id, practica_id),
    FOREIGN KEY (alumno_id) REFERENCES alumno(matricula) ON DELETE CASCADE,
    FOREIGN KEY (practica_id) REFERENCES practica(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Insertar datos de ejemplo
INSERT INTO grupo (id, nombre) VALUES 
('A1', 'Grupo A1'), ('A2', 'Grupo A2'),
('B1', 'Grupo B1'), ('B2', 'Grupo B2'),
('C1', 'Grupo C1'), ('C2', 'Grupo C2'),
('D1', 'Grupo D1');
```

</details>

---

### ⚙️ Paso 5: Configurar la Conexión

Editar el archivo `config/database.php`:

```php
<?php
/**
 * Configuración de Conexión a Base de Datos
 */

// Configuración para XAMPP estándar
define('DB_HOST', 'localhost');
define('DB_NAME', 'profesores');
define('DB_USER', 'root');
define('DB_PASS', '');              // Vacío por defecto en XAMPP
define('DB_PORT', '3306');          // Cambiar si usas otro puerto
define('DB_CHARSET', 'utf8mb4');

// Configuración de la zona horaria
date_default_timezone_set('America/Bogota');  // Ajustar según tu ubicación

// Configuración de errores (en desarrollo)
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

💡 **Nota:** Si cambiaste el puerto de MySQL a 3307, actualiza `DB_PORT`.

---

### ✅ Paso 6: Verificar la Instalación

1. **Test de conexión a la base de datos**
   ```
   http://localhost/examenes_proyecto/config/test_conexion.php
   ```
   
   ✅ **Resultado esperado:**
   ```
   ✓ Conexión exitosa a la base de datos
   ✓ Base de datos: profesores
   ✓ Servidor: localhost
   ```

2. **Acceder al sistema**
   ```
   http://localhost/examenes_proyecto/frontend/index.html
   ```
   
   ✅ **Deberías ver:** El panel principal con 4 botones (Alumnos, Profesores, Exámenes, Grupos)

---

### 📦 Paso 7: Instalar Dependencias (Opcional)

Si el proyecto usa Node.js para algunas funcionalidades:

```bash
cd frontend
npm install
```

---

## 🎯 Guía de Uso

### 🌐 Acceder al Sistema

1. Asegúrate de que XAMPP esté corriendo (Apache y MySQL verdes)
2. Abre tu navegador favorito
3. Navega a:

```
http://localhost/examenes_proyecto/frontend/index.html
```

---

### 🏠 Panel Principal

Al abrir el sistema, verás la pantalla principal:

```
╔═══════════════════════════════════════════════════════════╗
║                                                           ║
║           🎓 SISTEMA DE CALIFICACIONES                    ║
║                                                           ║
║   ╔══════════════════╗      ╔══════════════════╗         ║
║   ║                  ║      ║                  ║         ║
║   ║   👨‍🎓 ALUMNOS   ║      ║  👨‍🏫 PROFESORES ║         ║
║   ║                  ║      ║                  ║         ║
║   ╚══════════════════╝      ╚══════════════════╝         ║
║                                                           ║
║   ╔══════════════════╗      ╔══════════════════╗         ║
║   ║                  ║      ║                  ║         ║
║   ║   📝 EXÁMENES    ║      ║   🎯 GRUPOS      ║         ║
║   ║                  ║      ║                  ║         ║
║   ╚══════════════════╝      ╚══════════════════╝         ║
║                                                           ║
║              Panel Principal Académico                    ║
╚═══════════════════════════════════════════════════════════╝
```

---

### 📚 Módulos del Sistema

#### 1️⃣ 👨‍🎓 Gestión de Alumnos

**Ruta:** `/pages/alumnos.html`

**Funcionalidades:**

| Acción | Descripción | Campos |
|--------|-------------|--------|
| ➕ **Crear** | Registrar nuevo alumno | • Matrícula (único)<br>• Nombre completo<br>• Grupo |
| 📋 **Listar** | Ver todos los alumnos | Tabla con todos los registros |
| ✏️ **Editar** | Modificar datos | Actualizar nombre o grupo |
| 🗑️ **Eliminar** | Borrar registro | Con confirmación previa |

**Ejemplo de uso:**
```
1. Click en botón "Nuevo Alumno"
2. Llenar formulario:
   - Matrícula: 1001
   - Nombre: Juan Pérez García
   - Grupo: A1
3. Click en "Guardar"
4. El alumno aparece en la tabla
```

---

#### 2️⃣ 👨‍🏫 Gestión de Profesores

**Ruta:** `/pages/profesores.html`

**Funcionalidades:**

| Acción | Descripción | Campos |
|--------|-------------|--------|
| ➕ **Crear** | Registrar nuevo profesor | • DNI (único)<br>• Nombre completo |
| 📋 **Listar** | Ver todos los profesores | Directorio completo |
| ✏️ **Editar** | Actualizar información | Modificar nombre |
| 🗑️ **Eliminar** | Borrar registro | Con confirmación |

**Ejemplo de uso:**
```
1. Click en "+ Nuevo"
2. Llenar datos:
   - DNI: 5001
   - Nombre: Daniela Quintero
3. Click en "Actualizar"
4. Profesor registrado exitosamente
```

---

#### 3️⃣ 📝 Gestión de Exámenes

**Ruta:** `/pages/examenes.html`

**Funcionalidades:**

| Acción | Descripción | Campos |
|--------|-------------|--------|
| ➕ **Crear** | Programar nuevo examen | • Nombre del examen<br>• Fecha<br>• Grupo |
| 📋 **Listar** | Ver exámenes programados | Todos los registros |
| ✏️ **Editar** | Modificar detalles | Cambiar fecha o grupo |
| 🗑️ **Eliminar** | Cancelar examen | Con confirmación |

**Ejemplo de uso:**
```
1. Completar formulario:
   - Nombre: Examen Final Matemáticas
   - Fecha: 2024-12-15
   - Grupo: A1
2. Click en "Crear Examen"
3. Examen programado correctamente
```

---

#### 4️⃣ 🎯 Gestión de Grupos

**Ruta:** `/pages/grupos.html`

**Funcionalidades:**

| Acción | Descripción | Campos |
|--------|-------------|--------|
| ➕ **Crear** | Crear nuevo grupo | • Código (A1, B2, etc.) |
| 📋 **Listar** | Ver grupos existentes | Listado completo |
| 🔄 **Actualizar** | Refrescar lista | Botón "Actualizar" |

**Grupos disponibles por defecto:**
- `A1`, `A2` - Grupos nivel A
- `B1`, `B2` - Grupos nivel B
- `C1`, `C2` - Grupos nivel C
- `D1` - Grupo nivel D

---

## 🔌 Documentación API

La API RESTful sigue el estándar REST con respuestas en formato JSON.

### 🌐 URL Base

```
http://localhost/examenes_proyecto/utils/api.php
```

---

### 👨‍🎓 Endpoints - Alumnos

#### 📋 Listar todos los alumnos
```http
GET /api/alumnos
```

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "data": [
    {
      "matricula": "1001",
      "nombre": "Juan Pérez",
      "grupo": "A1"
    },
    {
      "matricula": "1002",
      "nombre": "María García",
      "grupo": "A1"
    }
  ]
}
```

---

#### 🔍 Obtener un alumno específico
```http
GET /api/alumnos/:matricula
```

**Parámetros:**
- `matricula` (requerido): Matrícula del alumno

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "data": {
    "matricula": "1001",
    "nombre": "Juan Pérez",
    "grupo": "A1"
  }
}
```

---

#### ➕ Crear nuevo alumno
```http
POST /api/alumnos
Content-Type: application/json
```

**Body:**
```json
{
  "matricula": "1003",
  "nombre": "Carlos López",
  "grupo": "A2"
}
```

**Respuesta exitosa (201):**
```json
{
  "success": true,
  "message": "Alumno creado exitosamente",
  "data": {
    "matricula": "1003",
    "nombre": "Carlos López",
    "grupo": "A2"
  }
}
```

---

#### ✏️ Actualizar alumno
```http
PUT /api/alumnos/:matricula
Content-Type: application/json
```

**Body:**
```json
{
  "nombre": "Carlos López Martínez",
  "grupo": "B1"
}
```

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "message": "Alumno actualizado exitosamente"
}
```

---

#### 🗑️ Eliminar alumno
```http
DELETE /api/alumnos/:matricula
```

**Respuesta exitosa (200):**
```json
{
  "success": true,
  "message": "Alumno eliminado exitosamente"
}
```

---

### 👨‍🏫 Endpoints - Profesores

#### 📋 Listar todos los profesores
```http
GET /api/profesores
```

#### 🔍 Obtener un profesor
```http
GET /api/profesores/:dni
```

#### ➕ Crear nuevo profesor
```http
POST /api/profesores
Content-Type: application/json

{
  "dni": "5001",
  "nombre": "Laura Suárez"
}
```

#### ✏️ Actualizar profesor
```http
PUT /api/profesores/:dni
Content-Type: application/json

{
  "nombre": "Laura Suárez González"
}
```

#### 🗑️ Eliminar profesor
```http
DELETE /api/profesores/:dni
```

---

### 📝 Endpoints - Exámenes

####
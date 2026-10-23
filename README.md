# ⚡ NexusCraft Studio — Desarrollo Web Integral (Unidad 3)

[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)](https://developer.mozilla.org/es/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)](https://developer.mozilla.org/es/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/es/docs/Web/JavaScript)
[![Responsive](https://img.shields.io/badge/Design-Mobile--First-success?style=for-the-badge)](https://developer.mozilla.org/es/docs/Learn/CSS/CSS_layout/Responsive_Design)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

> Proyecto web interactivo y responsivo desarrollado para la materia de **Desarrollo Web Integral (DWI)**, correspondiente a la **Unidad 3**.

---

## 👨‍🎓 Información Académica

| Concepto | Detalle |
| :--- | :--- |
| **Alumno** | Oscar Armando Rodarte Lara |
| **Materia** | Desarrollo Web Integral (DWI) |
| **Unidad de Aprendizaje** | Unidad 3 (U3) |
| **Usuario GitHub** | [@racso3424](https://github.com/racso3424) |
| **Repositorio Oficial** | [RodarteLaraOscarArmando_U3_DWI](https://github.com/racso3424/RodarteLaraOscarArmando_U3_DWI) |

---

## 💡 Concepto del Proyecto: NexusCraft Studio

**NexusCraft Studio** es una plataforma web moderna para una agencia de ingeniería y diseño web. Representa la síntesis de los aprendizajes clave del curso de **Desarrollo Web Integral**, demostrando dominio en:

1. **Maquetación Semántica y Accesible**: Uso riguroso de elementos HTML5 (`<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`).
2. **Estilizado Avanzado con CSS Vanilla**: Sistema de diseño basado en Custom Properties (Variables CSS), diseño fluido con Flexbox y CSS Grid, efectos de *Glassmorphism*, paletas contrastadas y micro-animaciones.
3. **Lógica e Interactividad con JavaScript (ES6+)**: Manipulación del DOM en tiempo real, persistencia de preferencias de usuario y componentes reactivos sin dependencia de librerías externas.

---

## 🚀 Funcionalidades y Módulos Implementados

### 1. 🌓 Selector de Tema Claro / Oscuro con Memoria
- Permite alternar dinámicamente entre un diseño nocturno (*Dark Mode*) y uno claro (*Light Mode*).
- Persistencia automática de la preferencia seleccionada en el navegador mediante `localStorage`.

### 2. 🧮 Cotizador Interactivo de Proyectos en Tiempo Real
- Calculadora reactiva donde el usuario puede seleccionar el tipo de sitio web (Landing Page, Corporativo, E-commerce, Web App SaaS), marcar módulos adicionales (Autenticación, Pasarelas de Pago, CMS, SEO) y definir la urgencia de entrega.
- Proyecta de manera automática la inversión estimada en **USD** y **MXN**, junto con las semanas de desarrollo estimadas.
- Botón para precargar los datos calculados directamente en el formulario de contacto.

### 3. 📂 Portafolio con Filtrado Dinámico
- Visualización de proyectos organizados por etiquetas: *Todos*, *Web Apps*, *E-commerce*, *SaaS & Dashboards* y *Landing Pages*.
- Transiciones suaves y sin recargas de página al cambiar de categoría.

### 4. 🔍 Ventana Modal de Ficha Técnica
- Al hacer clic en *"Ver Detalles"*, se abre un cuadro de diálogo accesible con la arquitectura de software empleada, características principales y tecnologías utilizadas.

### 5. 📬 Formulario de Contacto con Validación en Vivo y Toasts
- Validador del lado del cliente que verifica nombres, correos electrónicos con expresiones regulares y longitudes de mensaje.
- Sistema de retroalimentación mediante notificaciones flotantes (*Toasts*) visuales y temporizadas.

### 6. 📱 Diseño 100% Responsivo (Mobile-First)
- Menú tipo hamburguesa colapsable para dispositivos móviles y tablets.
- Tipografía fluida con `clamp()` y reordenamiento de rejillas de contenido adaptable a cualquier resolución de pantalla.

---

## 📁 Estructura del Repositorio

```plaintext
RodarteLaraOscarArmando_U3_DWI/
│
├── assets/
│   └── hero_showcase.jpg    # Recurso gráfico de alta definición para el hero
│
├── css/
│   └── styles.css           # Sistema de diseño, temas claro/oscuro y responsive CSS
│
├── js/
│   └── main.js              # Lógica de interactividad, cotizador, modal y validación
│
├── index.html               # Página web principal estructurada semánticamente
└── README.md                # Documentación oficial del proyecto
```

---

## 🛠️ Tecnologías Empleadas

- **HTML5**: Estructuración semántica, metadatos SEO y Open Graph.
- **CSS3 Vanilla**:
  - CSS Custom Properties (Variables de diseño).
  - CSS Flexbox y CSS Grid para layouts bidimensionales.
  - Media queries para diseño responsivo.
  - Efectos visuales modernos (`backdrop-filter`, sombras de elevación, gradientes).
- **JavaScript Moderno (ES6+)**:
  - `IntersectionObserver` para contadores de estadísticas al hacer scroll.
  - `LocalStorage API` para retención del modo oscuro.
  - Event-driven DOM manipulation sin dependencias de terceros.
- **Tipografías de Google Fonts**: *Outfit* (encabezados) y *Plus Jakarta Sans* (cuerpo de texto).

---

## 💻 Instrucciones para Ejecutar Localmente

### Opción 1: Apertura Directa
1. Clona o descarga este repositorio en tu computadora.
2. Abre la carpeta del proyecto.
3. Haz doble clic sobre el archivo `index.html` para abrirlo en cualquier navegador web moderno (Google Chrome, Microsoft Edge, Firefox, Brave).

### Opción 2: Con Live Server (Recomendado en Visual Studio Code)
1. Abre la carpeta en **Visual Studio Code**.
2. Instala la extensión **Live Server** (creada por *Ritwick Dey*).
3. Haz clic derecho en `index.html` y selecciona **"Open with Live Server"**.

### Opción 3: Servidor Local con Python
Si tienes Python instalado, ejecuta en la terminal dentro de la carpeta:
```bash
python -m http.server 8000
```
Luego abre tu navegador en `http://localhost:8000`.

---

## 📤 Comandos Git para Sincronizar y Subir a GitHub

Si deseas inicializar o actualizar este repositorio en GitHub, ejecuta los siguientes comandos en tu terminal (PowerShell o Git Bash):

```bash
# 1. Inicializar el repositorio Git local (si aún no está iniciado)
git init

# 2. Agregar todos los archivos al área de preparación
git add .

# 3. Crear el primer commit descriptivo
git commit -m "feat: implementacion inicial de index.html, estilos css, interactividad js y documentacion"

# 4. Asegurarse de estar en la rama principal 'main'
git branch -M main

# 5. Conectar con el repositorio remoto de GitHub
git remote add origin https://github.com/racso3424/RodarteLaraOscarArmando_U3_DWI.git

# 6. Subir el proyecto al repositorio remoto
git push -u origin main
```

---

## 👤 Autor

* **Estudiante:** Oscar Armando Rodarte Lara
* **Asignatura:** Desarrollo Web Integral
* **GitHub:** [@racso3424](https://github.com/racso3424)
* **Fecha:** Octubre 2026

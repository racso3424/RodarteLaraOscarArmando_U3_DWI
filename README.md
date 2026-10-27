# ⚡ NexusTech Store — Plataforma E-Commerce (Desarrollo Web Integral - U3)

[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)](https://developer.mozilla.org/es/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)](https://developer.mozilla.org/es/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/es/docs/Web/JavaScript)
[![Responsive](https://img.shields.io/badge/Design-Mobile--First-success?style=for-the-badge)](https://developer.mozilla.org/es/docs/Learn/CSS/CSS_layout/Responsive_Design)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

> Aplicación web interactiva de **Comercio Electrónico (E-Commerce)** desarrollada para la asignatura de **Desarrollo Web Integral (DWI)**, correspondiente a la **Unidad 3**.

---

## 👨‍🎓 Información Académica

| Concepto | Detalle |
| :--- | :--- |
| **Alumno** | Oscar Armando Rodarte Lara |
| **Materia** | Desarrollo Web Integral (DWI) |
| **Unidad de Aprendizaje** | Unidad 3 (U3) — Comercio Electrónico |
| **Usuario GitHub** | [@racso3424](https://github.com/racso3424) |
| **Repositorio Oficial** | [RodarteLaraOscarArmando_U3_DWI](https://github.com/racso3424/RodarteLaraOscarArmando_U3_DWI) |

---

## 💡 Concepto del Proyecto: NexusTech Store

**NexusTech Store** es una tienda online de tecnología premium especializada en dispositivos de audio de alta fidelidad, smartwatches, accesorios de carga y periféricos gaming. 

El proyecto demuestra la implementación integral de los principios fundamentales de una aplicación web comercial moderna:
- **Catálogo Reactivo:** Renderizado dinámico de productos, ordenamiento por precio o calificación, y filtrado por categorías y texto en vivo.
- **Carrito de Compras Persistente:** Gestión en tiempo real del estado de compra guardado en el navegador (`localStorage`), con controles de cantidad y eliminación.
- **Sistema de Cupones de Descuento:** Validación de códigos promocionales (`DWIU3` para 15% OFF, `TECH10` para 10% OFF) con recálculo automático de subtotales, envíos e impuestos en USD y MXN.
- **Checkout y Proceso de Compra:** Simulación completa del despacho con validación de datos de envío y opciones de pago cifradas.

---

## 🚀 Funcionalidades y Módulos Desarrollados

### 1. 🛒 Carrito de Compras en Panel Lateral (Drawer)
- Despliegue interactivo desde el lateral derecho sin recargar la página.
- Contador reactivo en la barra de navegación con animación visual al agregar productos.
- Controles de incremento (`+`), decremento (`-`) y remoción (`🗑️`).
- Cálculo de envío automático (Gratis para compras superiores a $50 USD).
- Persistencia de los artículos en `localStorage`, conservando el carrito aunque se cierre el navegador.

### 2. 🏷️ Sistema de Cupones Promocionales
- Permite ingresar códigos promocionales directamente en el carrito:
  - `DWIU3`: Aplica un **15% de descuento** sobre el subtotal.
  - `TECH10`: Aplica un **10% de descuento** sobre el subtotal.
- Notificaciones de error ante códigos inválidos o ya expirados.

### 3. 🔎 Búsqueda en Vivo y Filtro por Categorías
- Barra de búsqueda predictiva con filtrado en tiempo real según el título, descripción o categoría.
- Filtros rápidos tipo píldora: *Todos*, *Audio & Auriculares*, *Smartwatches*, *Gaming* y *Accesorios*.
- Menú de ordenamiento por precio (*Menor a Mayor*, *Mayor a Menor*) y por calificación.

### 4. ❤️ Lista de Deseos (Wishlist / Favoritos)
- Botón de guardado rápido en cada tarjeta de producto con animación de corazón.
- Contador de favoritos sincronizado en el encabezado.

### 5. 👁️ Modal de Vista Rápida (Quick View)
- Cuadro de diálogo accesible para visualizar especificaciones técnicas detalladas, estado de stock y añadir productos directamente al carrito.

### 6. 🛍️ Modal de Finalización de Compra (Checkout)
- Resumen completo de la orden con desglose de productos y total final.
- Formulario de datos de despacho y selección de método de pago (Tarjeta, PayPal o Efectivo).
- Simulación de procesamiento con indicador de carga y generación de número de orden único (`ORD-XXXXXX`).

### 7. 🔥 Oferta Relámpago con Cuenta Regresiva
- Temporizador interactivo (*Flash Sale*) en tiempo real (Horas, Minutos, Segundos).
- Botón para añadir paquetes de productos (*Combo Gamer Pro*) con descuento especial aplicado.

### 8. 🌓 Modo Oscuro / Modo Claro Dinámico
- Alternancia visual con paletas cromáticas accesibles y retención de preferencia en `localStorage`.

---

## 📁 Estructura del Repositorio

```plaintext
RodarteLaraOscarArmando_U3_DWI/
│
├── assets/
│   ├── ecommerce_hero.jpg    # Banner de alta resolución para la tienda
│   └── hero_showcase.jpg     # Recursos gráficos del proyecto
│
├── css/
│   └── styles.css            # Sistema de diseño, temas claro/oscuro y componentes
│
├── js/
│   └── main.js               # Carrito, cupones, catálogo dinámico, modales y checkout
│
├── index.html                # Estructura semántica de la tienda e-commerce
└── README.md                 # Documentación técnica y académica del proyecto
```

---

## 🛠️ Tecnologías y Estándares Web

- **HTML5**: Estructuración semántica (`<header>`, `<nav>`, `<main>`, `<section>`, `<aside>`, `<article>`, `<footer>`), metadatos SEO y atributos de accesibilidad (`aria-expanded`, `aria-hidden`, `role="dialog"`).
- **CSS3 Vanilla**:
  - Variables CSS (Custom Properties) para temas y tokens de diseño.
  - Maquetación flexible con CSS Grid y Flexbox (*Mobile-First*).
  - Efectos visuales de *Glassmorphism* (`backdrop-filter`) y sombras de elevación.
  - Animaciones y transiciones fluidas.
- **JavaScript Moderno (ES6+)**:
  - Manipulación nativa del DOM sin dependencias pesadas.
  - `LocalStorage API` para persistir el carrito y la lista de deseos.
  - Validaciones de formularios en el cliente mediante expresiones regulares.
- **Tipografías Google Fonts**: *Outfit* y *Plus Jakarta Sans*.

---

## 💻 Instrucciones para Ejecutar Localmente

### Opción 1: Apertura Directa en el Navegador
1. Clona o descarga este repositorio en tu computadora.
2. Abre la carpeta del proyecto.
3. Haz doble clic en el archivo `index.html` para abrirlo en Google Chrome, Microsoft Edge, Firefox o Brave.

### Opción 2: Con la extensión Live Server (VS Code)
1. Abre la carpeta del proyecto en **Visual Studio Code**.
2. Haz clic derecho sobre `index.html` y selecciona **"Open with Live Server"**.

### Opción 3: Servidor Local con Python
```bash
python -m http.server 8000
```
Luego visita `http://localhost:8000` en tu navegador.

---

## 📤 Comandos Git para Sincronizar con GitHub

Para actualizar tu repositorio remoto en GitHub con todos los cambios del e-commerce:

```powershell
# 1. Verificar el estado de los archivos modificados
git status

# 2. Agregar todos los cambios al staging
git add .

# 3. Crear el commit descriptivo
git commit -m "feat: transformacion del proyecto a tienda e-commerce completa con carrito, cupones y checkout"

# 4. Enviar los cambios a tu rama principal en GitHub
git push origin main
```

---

## 👤 Autor

* **Estudiante:** Oscar Armando Rodarte Lara
* **Materia:** Desarrollo Web Integral (DWI) — Unidad 3
* **Usuario GitHub:** [@racso3424](https://github.com/racso3424)
* **Fecha:** Octubre 2026

# 📋 Documentación de Metodología Scrum & Esquema de Pruebas
## Proyecto: NexusTech Store (E-Commerce con Laravel 10)
### Asignatura: Desarrollo Web Integral (DWI) — Unidad 3
**Estudiante:** Oscar Armando Rodarte Lara  
**Repositorio GitHub:** [racso3424/RodarteLaraOscarArmando_U3_DWI](https://github.com/racso3424/RodarteLaraOscarArmando_U3_DWI)

---

## 1. 🎯 Visión del Producto (Product Vision)

Desarrollar una plataforma de comercio electrónico de alta fidelidad para la venta de dispositivos tecnológicos y accesorios inteligentes, utilizando el framework **Laravel 10 (MVC)**. La solución integra un catálogo reactivo con filtros avanzados, un carrito de compras interactivo con soporte de cupones de descuento, un proceso de checkout con almacenamiento atómico en base de datos, y un **esquema riguroso de pruebas automatizadas con PHPUnit**.

---

## 2. 👥 Roles del Equipo Scrum

| Rol Scrum | Responsable | Funciones Clave |
| :--- | :--- | :--- |
| **Product Owner (PO)** | Docente / Stakeholder DWI | Define la visión comercial, prioriza los elementos del *Product Backlog* y valida los criterios de aceptación en cada *Sprint Review*. |
| **Scrum Master (SM)** | Oscar Armando Rodarte Lara | Facilita las ceremonias ágiles, elimina impedimentos técnicos, asegura el cumplimiento de la metodología y del *Definition of Done (DoD)*. |
| **Development Team** | Oscar Armando Rodarte Lara | Diseña la arquitectura en Laravel, maquetación HTML5/CSS3, lógica JS ES6+, migraciones, controladores, endpoints y suites de pruebas PHPUnit. |

---

## 3. 🔄 Ceremonias y Ciclo Scrum

* **Cadencia de Sprint:** 3 Sprints de desarrollo incremental e iterativo.
* **Sprint Planning:** Al inicio de cada Sprint para seleccionar los elementos prioritarios del *Product Backlog* y estimar su esfuerzo en *Story Points* (secuencia Fibonacci: 1, 2, 3, 5, 8).
* **Daily Scrum:** Sesión de sincronización diaria respondiendo: ¿Qué se logró ayer? ¿Qué se trabajará hoy? ¿Qué bloqueos u obstáculos existen?
* **Sprint Review:** Demostración del incremento de software potencialmente desplegable al término de cada Sprint.
* **Sprint Retrospective:** Análisis de mejora continua del proceso, herramientas y rendimiento del equipo.

---

## 4. ✅ Definition of Done (DoD)

Para que una Historia de Usuario se considere **TERMINADA (Done)**, debe cumplir estrictamente con:
1. Código fuente implementado bajo el estándar de codificación **PSR-12**.
2. Migraciones y modelos Eloquent ejecutados sin errores en la base de datos.
3. Pruebas Unitarias y de Integración correspondientes escritas y pasando al **100%** en PHPUnit.
4. Interfaz responsiva probada en resoluciones móviles, tablets y monitores de escritorio (*Mobile-First*).
5. Documentación técnica actualizada y commit descriptivo en el repositorio Git.

---

## 5. 📦 Product Backlog & Desglose de Sprints

### 🔷 Sprint 1: Arquitectura Base, Base de Datos y Catálogo de Productos
**Objetivo del Sprint (Sprint Goal):** Establecer la infraestructura base de Laravel 10, modelos de datos, migraciones y un catálogo interactivo con búsqueda y filtrado dinámico.

* **US-01: Configuración de la Arquitectura MVC y Entorno Laravel (5 SP)**
  * *Como* desarrollador, *quiero* configurar el framework Laravel 10 con SQLite/MySQL, *para* contar con una base escalable y modular.
  * **Criterios de Aceptación (Given-When-Then):**
    * **Dado** un entorno con PHP 8.2 y Composer.
    * **Cuando** se ejecuta `php artisan migrate --seed`.
    * **Entonces** las tablas `categories`, `products`, `coupons` y `orders` se crean e inicializan con datos de prueba.

* **US-02: Visualización del Catálogo de Productos (5 SP)**
  * *Como* cliente, *quiero* ver el listado de productos con sus imágenes, precios y especificaciones, *para* explorar los artículos disponibles.
  * **Criterios de Aceptación:**
    * **Dado** que el usuario ingresa a la ruta `/`.
    * **Cuando** el controlador `ProductController@index` procesa la solicitud.
    * **Entonces** se muestran las tarjetas de producto con precio regular, descuento (si aplica), calificación y badges informativos.

* **US-03: Filtrado por Categorías y Búsqueda en Tiempo Real (8 SP)**
  * *Como* cliente, *quiero* filtrar por categorías (Audio, Wearables, Gaming, Accesorios) y buscar por palabras clave, *para* localizar rápidamente un producto.
  * **Criterios de Aceptación:**
    * **Dado** que el usuario selecciona una categoría o escribe en el buscador.
    * **Cuando** se envía la petición con `?category={slug}` o `?search={query}`.
    * **Entonces** el sistema retorna únicamente los productos que coincidan sin recargas bruscas.

---

### 🔷 Sprint 2: Carrito de Compras Reactivo y Sistema de Cupones
**Objetivo del Sprint (Sprint Goal):** Desarrollar la gestión del carrito de compras con persistencia, cálculo dinámico de envío y motor de cupones de descuento.

* **US-04: Carrito de Compras en Panel Lateral Drawer (8 SP)**
  * *Como* cliente, *quiero* añadir productos al carrito y ver un panel lateral deslizante, *para* gestionar mi orden sin abandonar la página actual.
  * **Criterios de Aceptación:**
    * **Dado** un producto en el catálogo.
    * **Cuando** el usuario presiona "Añadir al Carrito".
    * **Entonces** el artículo se suma al carrito (en sesión y `localStorage`), el badge del navbar se actualiza y el drawer se abre mostrando el subtotal.

* **US-05: Modificación de Cantidades y Envío Dinámico (5 SP)**
  * *Como* cliente, *quiero* aumentar/disminuir unidades y saber si mi orden califica para envío gratis, *para* optimizar mi presupuesto de compra.
  * **Criterios de Aceptación:**
    * **Dado** un carrito con artículos.
    * **Cuando** el subtotal acumulado es mayor o igual a $50.00 USD.
    * **Entonces** el costo de envío se establece en **$0.00 USD (GRATIS)**; si es menor a $50.00 USD, se cobra una tarifa fija de **$9.99 USD**.

* **US-06: Aplicación de Cupones de Descuento Promocionales (5 SP)**
  * *Como* cliente, *quiero* ingresar un código promocional (ej. `DWIU3`), *para* recibir un descuento porcentual sobre el subtotal.
  * **Criterios de Aceptación:**
    * **Dado** el código promocional válido `DWIU3`.
    * **Cuando** se envía a la ruta `/api/coupon/apply`.
    * **Entonces** se valida en la tabla `coupons`, se aplica un **15% de descuento** al subtotal y se muestra un mensaje de confirmación; cupones inexistentes o expirados retornan código HTTP 422.

---

### 🔷 Sprint 3: Checkout Seguro, Pruebas Automatizadas y Despliegue
**Objetivo del Sprint (Sprint Goal):** Concretar la captura de pedidos en base de datos con transacciones ACID, ejecutar el esquema de pruebas PHPUnit y documentar el proyecto.

* **US-07: Proceso de Checkout y Registro Atómico de Pedidos (8 SP)**
  * *Como* comprador, *quiero* ingresar mis datos de entrega y método de pago, *para* formalizar la compra de mis artículos.
  * **Criterios de Aceptación:**
    * **Dado** un carrito con artículos y datos de cliente válidos.
    * **Cuando** se envía la orden vía POST a `/api/checkout`.
    * **Entonces** dentro de una transacción `DB::transaction` se genera un registro en `orders`, se asocian sus ítems en `order_items`, se vacía el carrito y se devuelve un número de pedido `ORD-XXXXXX`.

* **US-08: Validación de Seguridad y Esquema de Pruebas PHPUnit (8 SP)**
  * *Como* equipo de desarrollo, *quiero* ejecutar pruebas automatizadas Unitarias y de Integración, *para* garantizar la estabilidad y calidad del software.
  * **Criterios de Aceptación:**
    * **Dado** el entorno de pruebas de Laravel.
    * **Cuando** se ejecuta el comando `php artisan test`.
    * **Entonces** las 29 pruebas seleccionadas (Unitarias y Feature) deben pasar satisfactoriamente con 0 fallos.

---

## 6. 🧪 Esquema de Pruebas Seleccionadas (Test Suite Plan)

El esquema de pruebas combina **Pruebas Unitarias** para reglas de negocio aisladas y **Pruebas de Integración (Feature Tests)** para flujos completos de rutas, controladores, bases de datos y respuestas HTTP.

### Matriz de Ejecución de Pruebas

| ID | Suite | Tipo | Caso de Prueba / Funcionalidad | Resultado Esperado | Estado |
| :---: | :--- | :--- | :--- | :--- | :---: |
| **UT-01** | `ProductTest` | Unitaria | Cálculo del porcentaje de descuento con `old_price` | Retorna 20% para precio $80/$100 | **PASS** |
| **UT-02** | `ProductTest` | Unitaria | Verificación de descuento nulo si no hay `old_price` | Retorna 0% de descuento | **PASS** |
| **UT-03** | `ProductTest` | Unitaria | Verificación de disponibilidad de stock (`isInStock`) | True si stock > 0, False si stock = 0 | **PASS** |
| **UT-04** | `ProductTest` | Unitaria | Relación Eloquent entre Producto y Categoría | Instancia válida de `Category` | **PASS** |
| **UT-05** | `CouponTest` | Unitaria | Cálculo de descuento en cupón activo | Retorna $30.00 sobre $200 (15%) | **PASS** |
| **UT-06** | `CouponTest` | Unitaria | Rechazo de cupón con estado inactivo | Retorna False y $0.00 de descuento | **PASS** |
| **UT-07** | `CouponTest` | Unitaria | Verificación de gasto mínimo requerido en cupón | Rechaza compras menores al umbral | **PASS** |
| **UT-08** | `CouponTest` | Unitaria | Rechazo de cupones con fecha de expiración vencida | Retorna False y $0.00 de descuento | **PASS** |
| **FT-01** | `ProductCatalogTest` | Feature | Carga de página principal de la tienda (`/`) | Código HTTP 200 y renderizado HTML | **PASS** |
| **FT-02** | `ProductCatalogTest` | Feature | Filtrado de catálogo por categoría vía JSON | Retorna solo productos de la categoría | **PASS** |
| **FT-03** | `ProductCatalogTest` | Feature | Búsqueda por palabra clave en título/descripción | Retorna coincidencias exactas | **PASS** |
| **FT-04** | `ProductCatalogTest` | Feature | Ordenamiento ascendente por precio | Ordena de menor a mayor precio | **PASS** |
| **FT-05** | `ProductCatalogTest` | Feature | Consulta de detalles de un producto (`/products/{id}`) | Código HTTP 200 con payload JSON | **PASS** |
| **FT-06** | `CartFeatureTest` | Feature | Consulta de carrito vacío inicial | Retorna total 0 y subtotal 0 | **PASS** |
| **FT-07** | `CartFeatureTest` | Feature | Adición de productos y cálculo de subtotal | Incrementa cantidad y subtotal | **PASS** |
| **FT-08** | `CartFeatureTest` | Feature | Envío gratuito al superar el umbral ($50 USD) | Tarifa de envío = $0.00 USD | **PASS** |
| **FT-09** | `CartFeatureTest` | Feature | Tarifa de envío estándar en compras menores a $50 | Tarifa de envío = $9.99 USD | **PASS** |
| **FT-10** | `CartFeatureTest` | Feature | Actualización de cantidades de un producto | Recalcula total según delta | **PASS** |
| **FT-11** | `CartFeatureTest` | Feature | Eliminación de un artículo específico del carrito | Remueve ítem y recalcula | **PASS** |
| **FT-12** | `CartFeatureTest` | Feature | Vaciado completo del carrito | Deja carrito con 0 artículos | **PASS** |
| **FT-13** | `CouponFeatureTest` | Feature | Aplicación del cupón `DWIU3` (15% OFF) en sesión | Aplica 15% sobre subtotal | **PASS** |
| **FT-14** | `CouponFeatureTest` | Feature | Rechazo de código de cupón inexistente | Código HTTP 422 con error | **PASS** |
| **FT-15** | `CouponFeatureTest` | Feature | Remoción de cupón aplicado en sesión | Remueve cupón y recalcula | **PASS** |
| **FT-16** | `CheckoutFeatureTest` | Feature | Validación de campos obligatorios en el checkout | Código HTTP 422 con errores de validación | **PASS** |
| **FT-17** | `CheckoutFeatureTest` | Feature | Rechazo de checkout con carrito vacío | Código HTTP 422 con mensaje de alerta | **PASS** |
| **FT-18** | `CheckoutFeatureTest` | Feature | Persistencia atómica de orden en tabla `orders` | Registro en BD verificado (`assertDatabaseHas`) | **PASS** |
| **FT-19** | `CheckoutFeatureTest` | Feature | Registro de partidas individuales en `order_items` | Items vinculados al `order_id` en BD | **PASS** |
| **FT-20** | `CheckoutFeatureTest` | Feature | Vaciado automático del carrito tras compra exitosa | Carrito queda en 0 tras checkout | **PASS** |

---

## 7. 🚀 Cómo Ejecutar las Pruebas

Para reproducir la suite de pruebas completa en el entorno local:

```bash
# Ejecutar todas las pruebas con reporte visual
php artisan test

# Ejecutar únicamente las pruebas unitarias
php artisan test --testsuite=Unit

# Ejecutar únicamente las pruebas de integración / feature
php artisan test --testsuite=Feature
```

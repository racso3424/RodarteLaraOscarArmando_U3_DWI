# ⚡ NexusTech Store — E-Commerce en Laravel 10 (Scrum & PHPUnit)

[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![PHPUnit](https://img.shields.io/badge/PHPUnit-10.5-3776AB?style=for-the-badge&logo=php&logoColor=white)](https://phpunit.de)
[![Scrum](https://img.shields.io/badge/Methodology-Scrum%20Agile-orange?style=for-the-badge)](SCRUM.md)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

> Proyecto de **Comercio Electrónico (E-Commerce)** desarrollado con el framework **Laravel 10**, estructurado bajo la **metodología ágil Scrum** y validado con un **esquema riguroso de pruebas automatizadas (PHPUnit)** para la asignatura de **Desarrollo Web Integral (DWI)**, correspondiente a la **Unidad 3**.

---

## 👨‍🎓 Información Académica

| Concepto | Detalle |
| :--- | :--- |
| **Alumno** | Oscar Armando Rodarte Lara |
| **Materia** | Desarrollo Web Integral (DWI) |
| **Unidad de Aprendizaje** | Unidad 3 (U3) — Frameworks & Metodología Scrum |
| **Usuario GitHub** | [@racso3424](https://github.com/racso3424) |
| **Repositorio Oficial** | [RodarteLaraOscarArmando_U3_DWI](https://github.com/racso3424/RodarteLaraOscarArmando_U3_DWI) |

---

## 💡 Concepto del Proyecto

**NexusTech Store** es una tienda online de tecnología y gadgets inteligentes construida sobre una arquitectura modular **Modelo-Vista-Controlador (MVC)** con Laravel.

### Características Principales:
1. **Catálogo Reactivo:** Productos gestionados mediante base de datos con relaciones Eloquent (`Category` -> `Product`), con filtros por categoría, búsqueda por texto predictivo y ordenamiento por precio o valoración.
2. **Carrito de Compras en Panel Lateral (Drawer):** Integración híbrida (Sesión de Laravel + persistencia en cliente con `localStorage`), con cálculo reactivo de subtotales y política de envío gratis para pedidos superiores a $50 USD.
3. **Motor de Cupones de Descuento:** Soporte para cupones dinámicos almacenados en base de datos (`DWIU3` = 15% OFF, `TECH10` = 10% OFF), con validación de fechas de expiración y montos mínimos de compra.
4. **Checkout Atómico y Seguro:** Registro de órdenes e ítems de compra dentro de transacciones de base de datos (`DB::transaction`) y protección contra ataques CSRF.
5. **Esquema de Pruebas PHPUnit:** 29 casos de prueba automatizados entre pruebas Unitarias y de Integración con una tasa de éxito del **100%**.

---

## 🏃 Metodología Ágil Scrum

El proyecto fue planificado y ejecutado siguiendo los principios de la metodología **Scrum**:

* **Roles:**
  * **Product Owner:** Evaluación de requerimientos del cliente y criterios de negocio.
  * **Scrum Master & Developer:** Oscar Armando Rodarte Lara.
* **Ciclo de Desarrollo:** 3 Sprints incrementales:
  * **Sprint 1:** Configuración de Laravel 10, migraciones, modelos Eloquent y catálogo de productos con búsqueda y filtros.
  * **Sprint 2:** Lógica del carrito de compras (sesión/BD), cálculo dinámico de envío y motor de cupones de descuento.
  * **Sprint 3:** Formulario de checkout, registro atómico de órdenes, ejecución del esquema de pruebas PHPUnit y documentación.
* **Definition of Done (DoD):** Cada Historia de Usuario cuenta con criterios de aceptación en formato Gherkin (*Given-When-Then*), pruebas automatizadas en verde y código compatible con PSR-12.

> 📄 **Consulta la documentación completa de Scrum, historias de usuario y matriz de pruebas en:** [SCRUM.md](SCRUM.md)

---

## 🧪 Esquema de Pruebas Seleccionadas (PHPUnit)

Se diseñó una matriz integral de pruebas automatizadas que cubre reglas de negocio críticas:

```bash
php artisan test
```

### Resultados de la Ejecución de Pruebas:
```plaintext
   PASS  Tests\Unit\CouponTest
  ✓ active coupon applies correct discount                                     0.45s  
  ✓ inactive coupon is not valid                                               0.02s  
  ✓ coupon fails when subtotal is below minimum spend                          0.01s  
  ✓ expired coupon is invalid                                                  0.02s  

   PASS  Tests\Unit\ProductTest
  ✓ product calculates discount percentage correctly                           0.02s  
  ✓ product returns zero discount when no old price                            0.01s  
  ✓ product in stock determination                                             0.02s  
  ✓ product belongs to category                                                0.02s  

   PASS  Tests\Feature\CartFeatureTest
  ✓ can get cart contents and empty state                                      0.05s  
  ✓ can add product to cart and calculate subtotal                             0.03s  
  ✓ shipping is free when subtotal is over 50 dollars                          0.02s  
  ✓ shipping is charged when subtotal is under 50 dollars                      0.02s  
  ✓ can update product quantity in cart                                        0.02s  
  ✓ can remove product from cart                                               0.03s  
  ✓ can clear entire cart                                                      0.02s  

   PASS  Tests\Feature\CouponFeatureTest
  ✓ can apply valid coupon and recalculate totals                              0.02s  
  ✓ rejects invalid or nonexistent coupon                                      0.02s  
  ✓ can remove applied coupon                                                  0.02s  

   PASS  Tests\Feature\CheckoutFeatureTest
  ✓ checkout validates required customer fields                                0.03s  
  ✓ checkout rejects empty cart                                                0.03s  
  ✓ successful checkout creates order and order items in database              0.02s  
  ✓ successful checkout clears session cart                                    0.03s  

   PASS  Tests\Feature\ProductCatalogTest
  ✓ shop page returns status 200 and renders products                          0.02s  
  ✓ can filter products by category                                            0.02s  
  ✓ can search products by keyword                                             0.02s  
  ✓ can sort products by price ascending                                       0.02s  
  ✓ can view single product details                                            0.02s  

  Tests:    29 passed (68 assertions)
  Duration: 1.30s
```

---

## 📁 Arquitectura del Proyecto

```plaintext
RodarteLaraOscarArmando_U3_DWI/
│
├── app/
│   ├── Http/Controllers/
│   │   ├── ProductController.php    # Catálogo, filtrado, búsqueda y orden
│   │   ├── CartController.php       # Gestión reactiva del carrito
│   │   ├── CouponController.php     # Validación y aplicación de cupones
│   │   └── CheckoutController.php   # Procesamiento seguro de órdenes
│   └── Models/
│       ├── Category.php             # Modelo Eloquent de categorías
│       ├── Product.php              # Modelo de productos y métodos de stock
│       ├── Coupon.php               # Modelo de cupones y validación
│       ├── Order.php                # Modelo de pedidos
│       └── OrderItem.php            # Modelo de partidas del pedido
│
├── database/
│   ├── migrations/                  # Esquema relacional de la BD
│   ├── seeders/
│   │   └── EcommerceSeeder.php      # Datos de prueba para la tienda
│   └── database.sqlite              # Base de datos ligera portable
│
├── resources/
│   └── views/
│       └── shop.blade.php           # Vista Blade principal con componentes
│
├── routes/
│   └── web.php                      # Rutas web y endpoints API
│
├── tests/
│   ├── Unit/                        # Pruebas unitarias de modelos (Product, Coupon)
│   └── Feature/                     # Pruebas de integración (Catalog, Cart, Checkout)
│
├── public/                          # Activos compilados (CSS, JS, imágenes)
├── SCRUM.md                         # Documentación Scrum y Matriz de Pruebas
└── README.md                        # Guía principal del proyecto
```

---

## 💻 Instrucciones para Ejecutar Localmente

### 1. Clonar el repositorio
```bash
git clone https://github.com/racso3424/RodarteLaraOscarArmando_U3_DWI.git
cd RodarteLaraOscarArmando_U3_DWI
```

### 2. Instalar dependencias con Composer
```bash
composer install
```

### 3. Configurar el archivo de entorno `.env`
```bash
# Si no existe .env, copia el archivo de ejemplo
cp .env.example .env

# Generar la clave de la aplicación
php artisan key:generate
```

### 4. Ejecutar las migraciones y poblar la base de datos
```bash
php artisan migrate --seed
```

### 5. Ejecutar la suite de pruebas automatizadas
```bash
php artisan test
```

### 6. Iniciar el servidor local de desarrollo
```bash
php artisan serve
```
Abre tu navegador web e ingresa a: **`http://localhost:8000`**

---

## 📤 Comandos Git para Sincronizar con GitHub

Para enviar las actualizaciones al repositorio remoto:

```powershell
# 1. Comprobar archivos modificados
git status

# 2. Agregar cambios al área de preparación
git add .

# 3. Crear commit descriptivo
git commit -m "feat: integracion de framework Laravel 10, metodologia Scrum y suite de pruebas PHPUnit"

# 4. Enviar a GitHub
git push origin main
```

---

## 👤 Autor

* **Estudiante:** Oscar Armando Rodarte Lara
* **Asignatura:** Desarrollo Web Integral (DWI) — Unidad 3
* **Usuario GitHub:** [@racso3424](https://github.com/racso3424)
* **Fecha:** Octubre 2026

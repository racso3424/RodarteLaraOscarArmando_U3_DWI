<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="NexusTech Store - Tienda de tecnología desarrollada en Laravel con arquitectura MVC, pruebas automatizadas y metodología Scrum.">
    <meta name="author" content="Oscar Armando Rodarte Lara">
    <title>{{ config('app.name', 'NexusTech Store') }} | E-commerce Laravel</title>
    
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="NexusTech Store | Laravel E-commerce">
    <meta property="og:description" content="Plataforma de comercio electrónico con arquitectura MVC en Laravel 10.">
    
    <!-- Favicon SVG -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⚡</text></svg>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <!-- Barra Superior de Promociones -->
    <div class="announcement-bar">
        <div class="container announcement-content">
            <span class="promo-badge">PROYECTO LARAVEL</span>
            <span>🚀 Framework Laravel 10 (MVC) • Metodología Scrum • Cupón 15% OFF: <strong class="coupon-code">DWIU3</strong></span>
        </div>
    </div>

    <!-- Barra de Navegación Principal -->
    <header class="navbar-wrapper" id="navbar">
        <nav class="navbar container">
            <a href="#inicio" class="brand-logo" aria-label="NexusTech Inicio">
                <span class="logo-icon">⚡</span>
                <span class="logo-text">Nexus<span class="gradient-text">Tech</span></span>
            </a>

            <!-- Barra de Búsqueda Rápida -->
            <div class="search-box">
                <span class="search-icon">🔍</span>
                <input type="text" id="catalog-search" placeholder="Buscar productos en la base de datos..." aria-label="Buscar productos">
                <button class="clear-search-btn" id="clear-search" style="display:none;" aria-label="Limpiar búsqueda">&times;</button>
            </div>

            <button class="mobile-menu-btn" id="mobile-toggle" aria-label="Alternar menú de navegación" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>

            <div class="nav-menu" id="nav-menu">
                <ul class="nav-links">
                    <li><a href="#inicio" class="nav-link active">Inicio</a></li>
                    <li><a href="#catalogo" class="nav-link">Catálogo</a></li>
                    <li><a href="#ofertas" class="nav-link">Ofertas</a></li>
                    <li><a href="#beneficios" class="nav-link">Garantía</a></li>
                    <li><a href="#contacto" class="nav-link">Soporte</a></li>
                </ul>

                <div class="nav-actions">
                    <!-- Selector de Tema -->
                    <button id="theme-toggle" class="action-icon-btn" aria-label="Cambiar tema claro/oscuro" title="Cambiar tema">
                        <span id="theme-icon">🌙</span>
                    </button>

                    <!-- Lista de Deseos / Favoritos -->
                    <button id="wishlist-btn" class="action-icon-btn" aria-label="Ver favoritos" title="Favoritos">
                        <span>❤️</span>
                        <span class="badge-count" id="wishlist-count">0</span>
                    </button>

                    <!-- Carrito de Compras -->
                    <button id="cart-toggle-btn" class="cart-btn" aria-label="Abrir carrito de compras">
                        <span class="cart-icon">🛒</span>
                        <div class="cart-info">
                            <span class="cart-text">Carrito</span>
                            <span class="cart-total-badge" id="cart-nav-total">$0.00</span>
                        </div>
                        <span class="badge-count" id="cart-count">0</span>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <main id="main-content">
        <!-- Hero Section con Banner Promocional -->
        <section class="hero-section" id="inicio">
            <div class="container hero-grid">
                <div class="hero-content">
                    <div class="badge-pill">
                        <span class="badge-dot"></span>
                        <span class="badge-text">Desarrollo Web Integral • U3 • Laravel & Scrum</span>
                    </div>

                    <h1 class="hero-title">
                        Tecnología que <span class="gradient-text">transforma</span> tu estilo de vida
                    </h1>

                    <p class="hero-description">
                        Tienda de comercio electrónico respaldada por un backend modular en Laravel 10, base de datos SQLite/MySQL y arquitectura MVC probada mediante PHPUnit.
                    </p>

                    <div class="hero-cta-group">
                        <a href="#catalogo" class="btn btn-primary">
                            <span>Explorar Catálogo</span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                        <a href="#ofertas" class="btn btn-secondary">
                            <span>Ofertas Flash 🔥</span>
                        </a>
                    </div>

                    <!-- Indicadores de Confianza -->
                    <div class="trust-indicators">
                        <div class="trust-item">
                            <span class="trust-icon">🚚</span>
                            <span>Envío Gratis > $50</span>
                        </div>
                        <div class="trust-item">
                            <span class="trust-icon">🔒</span>
                            <span>Laravel CSRF & SSL</span>
                        </div>
                        <div class="trust-item">
                            <span class="trust-icon">🧪</span>
                            <span>Pruebas PHPUnit Pass</span>
                        </div>
                    </div>
                </div>

                <div class="hero-visual">
                    <div class="hero-card-wrapper">
                        <div class="glow-effect"></div>
                        <img src="{{ asset('assets/ecommerce_hero.jpg') }}" alt="Showcase de auriculares premium y smartwatch de alta tecnología" class="hero-img" loading="eager">
                        
                        <div class="floating-chip chip-top">
                            <div class="chip-icon">🎧</div>
                            <div class="chip-info">
                                <span class="chip-title">Aura Pro Series</span>
                                <span class="chip-val">50h Batería + ANC</span>
                            </div>
                        </div>

                        <div class="floating-chip chip-bottom">
                            <div class="chip-icon">⌚</div>
                            <div class="chip-info">
                                <span class="chip-title">Elite Watch Ultra</span>
                                <span class="chip-val">Titanio Aeroespacial</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Barra de Categorías Dinámicas desde Laravel -->
        <section class="quick-categories-section">
            <div class="container categories-strip">
                <button class="category-pill-btn active" data-category="all">
                    <span class="cat-icon">🌐</span>
                    <span>Todos los Productos</span>
                </button>
                @foreach($categories as $category)
                    <button class="category-pill-btn" data-category="{{ $category->slug }}">
                        <span class="cat-icon">{{ $category->icon ?? '⚡' }}</span>
                        <span>{{ $category->name }}</span>
                    </button>
                @endforeach
            </div>
        </section>

        <!-- Catálogo de Productos -->
        <section class="section-padding" id="catalogo">
            <div class="container">
                <div class="catalog-header">
                    <div>
                        <span class="section-tag">Colección Laravel 2026</span>
                        <h2 class="section-title">Productos Destacados</h2>
                    </div>

                    <!-- Filtros y Ordenamiento -->
                    <div class="catalog-controls">
                        <div class="sort-wrapper">
                            <label for="sort-select" class="sort-label">Ordenar por:</label>
                            <select id="sort-select" class="styled-select">
                                <option value="featured">Destacados</option>
                                <option value="price-asc">Precio: Menor a Mayor</option>
                                <option value="price-desc">Precio: Mayor a Menor</option>
                                <option value="rating">Mejor Calificados</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Rejilla de Productos -->
                <div class="products-grid" id="products-grid">
                    <!-- Se renderiza reactivamente y soporta fallback Blade -->
                </div>

                <!-- Mensaje cuando no hay resultados de búsqueda -->
                <div class="no-results" id="no-results" style="display: none;">
                    <span class="no-results-icon">🔎</span>
                    <h3>No se encontraron productos</h3>
                    <p>Intenta con otra palabra clave o limpia el filtro de búsqueda.</p>
                    <button class="btn btn-secondary btn-sm" id="reset-search-btn">Restablecer Búsqueda</button>
                </div>
            </div>
        </section>

        <!-- Sección de Oferta Flash con Temporizador -->
        <section class="flash-sale-section" id="ofertas">
            <div class="container flash-grid">
                <div class="flash-info">
                    <span class="flash-badge">⚡ OFERTA RELÁMPAGO DE LA SEMANA</span>
                    <h2 class="flash-title">Bundle CyberGamer Pro: Teclado Mecánico + Auriculares Aura Pro</h2>
                    <p class="flash-desc">
                        Ahorra más del 30% comprando en combo. Equipamiento competitivo con baja latencia, switches ópticos y sonido envolvente 7.1.
                    </p>

                    <!-- Temporizador Dinámico -->
                    <div class="countdown-wrapper">
                        <div class="countdown-box">
                            <span class="countdown-num" id="countdown-hours">12</span>
                            <span class="countdown-lbl">Horas</span>
                        </div>
                        <span class="countdown-colon">:</span>
                        <div class="countdown-box">
                            <span class="countdown-num" id="countdown-minutes">45</span>
                            <span class="countdown-lbl">Minutos</span>
                        </div>
                        <span class="countdown-colon">:</span>
                        <div class="countdown-box">
                            <span class="countdown-num" id="countdown-seconds">30</span>
                            <span class="countdown-lbl">Segundos</span>
                        </div>
                    </div>

                    <div class="flash-pricing">
                        <span class="flash-old-price">$319.98 USD</span>
                        <span class="flash-new-price">$219.99 USD</span>
                        <span class="save-tag">Ahorras $100 USD</span>
                    </div>

                    <button class="btn btn-primary" id="add-bundle-btn">
                        <span>Añadir Bundle al Carrito</span>
                        <span>🛒</span>
                    </button>
                </div>

                <div class="flash-card-preview">
                    <div class="bundle-visual-box">
                        <span class="bundle-badge">Combo Exclusivo</span>
                        <div class="bundle-icons">
                            <div class="bundle-item-icon">🎧</div>
                            <span class="bundle-plus">+</span>
                            <div class="bundle-item-icon">⌨️</div>
                        </div>
                        <h4 class="bundle-name">Aura Pro + CyberDeck RGB</h4>
                        <p class="bundle-sub">Incluye garantía extendida y envío prioritario gratuito.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Beneficios y Metodología -->
        <section class="section-padding bg-surface" id="beneficios">
            <div class="container">
                <div class="section-header text-center">
                    <span class="section-tag">Garantía & Arquitectura</span>
                    <h2 class="section-title">Desarrollado con Excelencia Técnica</h2>
                    <p class="section-subtitle">
                        Cumpliendo con los estándares de ingeniería de software requeridos en la Unidad 3 de DWI.
                    </p>
                </div>

                <div class="benefits-grid">
                    <div class="benefit-card">
                        <div class="benefit-icon">⚙️</div>
                        <h3 class="benefit-title">Framework Laravel 10 (MVC)</h3>
                        <p class="benefit-text">Separación estricta de responsabilidades entre Modelos Eloquent, Controladores RESTful y Vistas Blade.</p>
                    </div>

                    <div class="benefit-card">
                        <div class="benefit-icon">🏃</div>
                        <h3 class="benefit-title">Metodología Ágil Scrum</h3>
                        <p class="benefit-text">Planificado en 3 Sprints con Historias de Usuario, Criterios de Aceptación INVEST y Definition of Done.</p>
                    </div>

                    <div class="benefit-card">
                        <div class="benefit-icon">🧪</div>
                        <h3 class="benefit-title">Pruebas con PHPUnit</h3>
                        <p class="benefit-text">Esquema integral de pruebas Unitarias y de Integración (Feature) que garantizan cero regresiones.</p>
                    </div>

                    <div class="benefit-card">
                        <div class="benefit-icon">💳</div>
                        <h3 class="benefit-title">Transacciones Seguras</h3>
                        <p class="benefit-text">Persistencia atómica de pedidos en base de datos mediante transacciones DB::transaction y protección CSRF.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonios de Clientes -->
        <section class="section-padding" id="testimonios">
            <div class="container">
                <div class="section-header text-center">
                    <span class="section-tag">Casos de Éxito</span>
                    <h2 class="section-title">Opiniones de Usuarios</h2>
                    <p class="section-subtitle">La calidad técnica se traduce en una experiencia de usuario rápida y confiable.</p>
                </div>

                <div class="testimonials-grid">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-quote">"El sistema responde al instante. La integración del carrito con los cupones de descuento y la verificación del pedido es sumamente fluida."</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">👨‍💻</div>
                            <div class="author-details">
                                <h4 class="author-name">Santiago Morales</h4>
                                <span class="author-role">Cliente Verificado • CDMX</span>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-card featured-testimonial">
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-quote">"Excelente implementación de Laravel y Scrum. El código está muy limpio, las migraciones corren a la primera y las pruebas automatizadas pasan al 100%."</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">👩‍💼</div>
                            <div class="author-details">
                                <h4 class="author-name">Camila Ortega</h4>
                                <span class="author-role">Evaluación Técnica • Monterrey</span>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-stars">★★★★★</div>
                        <p class="testimonial-quote">"Compré los auriculares Aura Pro usando el cupón DWIU3 del 15% y todo el flujo de compra fue impecable."</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">🎮</div>
                            <div class="author-details">
                                <h4 class="author-name">David Silva</h4>
                                <span class="author-role">Cliente Verificado • Guadalajara</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Centro de Contacto & Datos del Proyecto -->
        <section class="section-padding bg-surface" id="contacto">
            <div class="container">
                <div class="section-header text-center">
                    <span class="section-tag">Contacto & Soporte</span>
                    <h2 class="section-title">Atención al Alumno y Proyecto</h2>
                    <p class="section-subtitle">¿Dudas sobre el funcionamiento de la plataforma o la arquitectura de software?</p>
                </div>

                <div class="contact-grid">
                    <div class="contact-info-panel">
                        <h3 class="panel-title">Información Académica</h3>
                        <p class="panel-desc">Proyecto desarrollado bajo la metodología Scrum para la evaluación de la Unidad 3.</p>

                        <div class="info-items">
                            <div class="info-item">
                                <span class="info-icon">🎓</span>
                                <div>
                                    <h5>Alumno & Asignatura</h5>
                                    <p>Oscar Armando Rodarte Lara — Desarrollo Web Integral (U3)</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <span class="info-icon">⚡</span>
                                <div>
                                    <h5>Stack Tecnológico</h5>
                                    <p>Laravel 10, Blade, SQLite/MySQL, PHPUnit, CSS3 & JS ES6+</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <span class="info-icon">📋</span>
                                <div>
                                    <h5>Metodología</h5>
                                    <p>Scrum (Product Backlog, 3 Sprints, User Stories & DoD)</p>
                                </div>
                            </div>
                        </div>

                        <div class="academic-badge-box">
                            <span class="academic-badge-title">Repositorio GitHub Oficial:</span>
                            <a href="https://github.com/racso3424/RodarteLaraOscarArmando_U3_DWI" target="_blank" rel="noopener noreferrer" class="github-repo-link">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                                <span>racso3424/RodarteLaraOscarArmando_U3_DWI</span>
                            </a>
                        </div>
                    </div>

                    <div class="contact-form-panel">
                        <form id="contact-form" class="styled-form" novalidate>
                            <h4 class="form-title">Envíanos un Mensaje de Soporte</h4>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="form-name">Tu Nombre *</label>
                                    <input type="text" id="form-name" required placeholder="Ej. Ana Gómez">
                                    <span class="error-msg" id="name-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="form-email">Correo Electrónico *</label>
                                    <input type="email" id="form-email" required placeholder="ana@ejemplo.com">
                                    <span class="error-msg" id="email-error"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form-subject">Asunto</label>
                                <select id="form-subject">
                                    <option value="duda-producto">Dudas sobre un Producto</option>
                                    <option value="estado-pedido">Consultar Estado de Mi Pedido</option>
                                    <option value="garantia">Solicitud de Garantía / Devolución</option>
                                    <option value="otro">Otro Asunto</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="form-message">Mensaje *</label>
                                <textarea id="form-message" rows="4" required placeholder="Describe tu consulta o requerimiento..."></textarea>
                                <span class="error-msg" id="message-error"></span>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" id="form-submit-btn">
                                <span>Enviar Consulta</span>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Drawer Lateral del Carrito de Compras -->
    <div class="cart-drawer-overlay" id="cart-drawer-overlay" aria-hidden="true">
        <aside class="cart-drawer" id="cart-drawer" role="dialog" aria-labelledby="cart-drawer-title">
            <div class="cart-drawer-header">
                <div class="cart-drawer-title-group">
                    <span class="cart-drawer-icon">🛒</span>
                    <h3 id="cart-drawer-title">Mi Carrito de Compras</h3>
                    <span class="cart-drawer-badge" id="cart-drawer-badge">0 items</span>
                </div>
                <button class="drawer-close-btn" id="cart-drawer-close" aria-label="Cerrar carrito">&times;</button>
            </div>

            <!-- Lista de Artículos -->
            <div class="cart-drawer-items" id="cart-items-container">
                <!-- Se inyecta dinámicamente vía JS -->
            </div>

            <!-- Footer con Cupón, Totales y Checkout -->
            <div class="cart-drawer-footer">
                <!-- Cupón de Descuento -->
                <div class="coupon-box">
                    <input type="text" id="coupon-input" placeholder="Cupón (ej. DWIU3)" aria-label="Código de cupón">
                    <button id="apply-coupon-btn" class="btn btn-secondary btn-sm">Aplicar</button>
                </div>
                <div class="coupon-msg" id="coupon-msg"></div>

                <!-- Desglose de Precios -->
                <div class="cart-price-breakdown">
                    <div class="price-row">
                        <span>Subtotal:</span>
                        <span id="cart-subtotal">$0.00 USD</span>
                    </div>
                    <div class="price-row discount-row" id="cart-discount-row" style="display: none;">
                        <span>Descuento (<span id="discount-pct">0%</span>):</span>
                        <span id="cart-discount">-$0.00 USD</span>
                    </div>
                    <div class="price-row">
                        <span>Envío:</span>
                        <span id="cart-shipping">Calculando...</span>
                    </div>
                    <div class="price-divider"></div>
                    <div class="price-row total-row">
                        <span>Total:</span>
                        <div class="total-values">
                            <span class="total-usd" id="cart-total-usd">$0.00 USD</span>
                            <span class="total-mxn" id="cart-total-mxn">Aprox. $0 MXN</span>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-block checkout-trigger-btn" id="open-checkout-btn">
                    <span>Proceder al Pago Seguro</span>
                    <span>🔒</span>
                </button>
                <button class="btn-clear-cart" id="clear-cart-btn">Vaciar Carrito</button>
            </div>
        </aside>
    </div>

    <!-- Modal para Vista Rápida de Producto -->
    <div class="modal-backdrop" id="quick-view-modal" aria-hidden="true" role="dialog" aria-labelledby="modal-product-title">
        <div class="modal-card modal-product-card">
            <button class="modal-close-btn" id="modal-close" aria-label="Cerrar modal">&times;</button>
            <div class="modal-body" id="modal-content">
                <!-- Inyectado vía JS -->
            </div>
        </div>
    </div>

    <!-- Modal de Checkout / Finalizar Pedido -->
    <div class="modal-backdrop" id="checkout-modal" aria-hidden="true" role="dialog" aria-labelledby="checkout-title">
        <div class="modal-card modal-checkout-card">
            <button class="modal-close-btn" id="checkout-close" aria-label="Cerrar checkout">&times;</button>
            <div class="checkout-header">
                <span class="checkout-icon">🛍️</span>
                <h3 id="checkout-title">Finalizar Pedido</h3>
                <p class="checkout-sub">Procesamiento seguro con validación backend en Laravel.</p>
            </div>

            <form id="checkout-form" class="checkout-form">
                <div class="checkout-order-summary" id="checkout-summary-box">
                    <!-- Resumen del pedido -->
                </div>

                <h4 class="checkout-subtitle">1. Datos de Envío</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label for="checkout-name">Nombre y Apellido *</label>
                        <input type="text" id="checkout-name" name="customer_name" required placeholder="Carlos Mendoza">
                    </div>
                    <div class="form-group">
                        <label for="checkout-email">Correo Electrónico *</label>
                        <input type="email" id="checkout-email" name="customer_email" required placeholder="carlos@ejemplo.com">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="checkout-phone">Teléfono Móvil *</label>
                        <input type="tel" id="checkout-phone" name="customer_phone" required placeholder="55 1234 5678">
                    </div>
                    <div class="form-group">
                        <label for="checkout-address">Dirección de Entrega Completa *</label>
                        <input type="text" id="checkout-address" name="delivery_address" required placeholder="Calle, Número, Ciudad, CP">
                    </div>
                </div>

                <h4 class="checkout-subtitle">2. Método de Pago</h4>
                <div class="payment-methods">
                    <label class="payment-option">
                        <input type="radio" name="payment-method" value="card" checked>
                        <span class="payment-box">💳 Tarjeta de Crédito/Débito</span>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment-method" value="paypal">
                        <span class="payment-box">🅿️ PayPal</span>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment-method" value="cash">
                        <span class="payment-box">🏪 Pago en OXXO / Transferencia</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg" id="confirm-order-btn">
                    <span>Confirmar y Pagar Pedido</span>
                    <span id="checkout-pay-total">$0.00 USD</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Contenedor de Notificaciones Toast -->
    <div class="toast-container" id="toast-container" aria-live="polite"></div>

    <!-- Pie de Página (Footer) -->
    <footer class="footer-wrapper">
        <div class="container footer-content">
            <div class="footer-top">
                <div class="footer-brand">
                    <a href="#inicio" class="brand-logo">
                        <span class="logo-icon">⚡</span>
                        <span class="logo-text">Nexus<span class="gradient-text">Tech</span></span>
                    </a>
                    <p class="footer-tagline">
                        Plataforma de comercio electrónico desarrollada con el framework Laravel 10 bajo la metodología ágil Scrum y pruebas automatizadas PHPUnit.
                    </p>
                    <div class="secure-badges">
                        <span>🔒 Laravel Security</span>
                        <span>🧪 PHPUnit Testing</span>
                    </div>
                </div>

                <div class="footer-col">
                    <h5 class="footer-title">Categorías</h5>
                    <ul class="footer-links">
                        @foreach($categories as $cat)
                            <li><a href="#catalogo" onclick="filterByCategory('{{ $cat->slug }}')">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="footer-col">
                    <h5 class="footer-title">Metodología Scrum</h5>
                    <ul class="footer-links">
                        <li><span>Sprint 1: Catálogo & Base de Datos</span></li>
                        <li><span>Sprint 2: Carrito & Cupones</span></li>
                        <li><span>Sprint 3: Checkout & PHPUnit</span></li>
                        <li><span>Definition of Done (DoD)</span></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h5 class="footer-title">Datos Académicos</h5>
                    <div class="student-card">
                        <p class="student-label">Alumno:</p>
                        <p class="student-value">Oscar Armando Rodarte Lara</p>
                        <p class="student-label">Materia:</p>
                        <p class="student-value">Desarrollo Web Integral</p>
                        <p class="student-label">Unidad:</p>
                        <p class="student-value">Unidad 3 (U3) — Laravel & Scrum</p>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 NexusTech Store. Desarrollado con Laravel 10, PHPUnit y metodología Scrum para Desarrollo Web Integral.</p>
                <div class="footer-socials">
                    <a href="https://github.com/racso3424/RodarteLaraOscarArmando_U3_DWI" target="_blank" rel="noopener noreferrer" title="GitHub Repository">
                        Repositorio GitHub Oficial
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Inyección de datos de productos de Laravel hacia JavaScript -->
    <script>
        window.LARAVEL_PRODUCTS = @json($products);
        window.CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    </script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>

/**
 * NexusTech Store - E-Commerce Logic & Reactivity
 * Desarrollo Web Integral (DWI) - Unidad 3
 * Alumno: Oscar Armando Rodarte Lara
 */

// --- Base de Datos de Productos (Sincronizada con Laravel o fallback local) ---
let DEFAULT_PRODUCTS = [
    {
        id: 1,
        title: "Aura Pro Wireless Headphones",
        category: "audio",
        price: 189.99,
        oldPrice: 239.99,
        badge: "sale",
        badgeText: "-20% OFF",
        rating: 4.9,
        reviews: 142,
        emoji: "🎧",
        shortDesc: "Cancelación Activa de Ruido (ANC), Audio Espacial 360° y hasta 50h de autonomía.",
        specs: ["Bluetooth 5.3 + Códec LDAC", "Cancelación híbrida -42dB", "Carga rápida USB-C", "Almohadillas viscoelásticas"]
    },
    {
        id: 2,
        title: "Elite Watch Ultra 2",
        category: "wearables",
        price: 249.99,
        oldPrice: 299.99,
        badge: "hot",
        badgeText: "TOP VENTAS",
        rating: 4.8,
        reviews: 98,
        emoji: "⌚",
        shortDesc: "Caja de titanio aeroespacial, pantalla AMOLED Retina y sensores médicos de ECG y SpO2.",
        specs: ["Pantalla AMOLED 1.96\"", "Resistencia al agua 50m (5ATM)", "GPS de doble frecuencia", "Batería de hasta 7 días"]
    },
    {
        id: 3,
        title: "CyberDeck RGB Mechanical Keyboard",
        category: "gaming",
        price: 129.99,
        oldPrice: null,
        badge: "new",
        badgeText: "NUEVO",
        rating: 5.0,
        reviews: 64,
        emoji: "⌨️",
        shortDesc: "Switches mecánicos lubricados de fábrica, chasis de aluminio CNC e iluminación RGB por tecla.",
        specs: ["Conexión triple (2.4GHz/BT/Cable)", "Keycaps PBT Double-Shot", "Hot-swappable de 5 pines", "Batería interna 4000mAh"]
    },
    {
        id: 4,
        title: "Vortex Pro Wireless Gaming Mouse",
        category: "gaming",
        price: 79.99,
        oldPrice: 99.99,
        badge: "sale",
        badgeText: "-20%",
        rating: 4.7,
        reviews: 87,
        emoji: "🖱️",
        shortDesc: "Sensor óptico de 26,000 DPI, ultraligero de 58g y polling rate competitivo de 4000Hz.",
        specs: ["Switches ópticos Gen 3", "Sensor PixArt PAW3395", "Pies de teflón 100% PTFE", "80 horas de duración continua"]
    },
    {
        id: 5,
        title: "PulseSound 360 Smart Speaker",
        category: "audio",
        price: 89.99,
        oldPrice: 119.99,
        badge: "sale",
        badgeText: "OFERTA",
        rating: 4.6,
        reviews: 53,
        emoji: "🔊",
        shortDesc: "Altavoz inteligente con graves profundos en 360 grados, Wi-Fi, Bluetooth y asistente de voz.",
        specs: ["Sonido omnidireccional 40W", "Resistencia IPX7 al agua", "Emparejamiento estéreo True Wireless", "Halo de luz RGB reactivo"]
    },
    {
        id: 6,
        title: "TitanCharge MagSafe Powerbank 10K",
        category: "accessories",
        price: 49.99,
        oldPrice: null,
        badge: null,
        badgeText: "",
        rating: 4.9,
        reviews: 112,
        emoji: "🔋",
        shortDesc: "Batería magnética inalámbrica con soporte plegable de aluminio y puerto USB-C PD 30W.",
        specs: ["Capacidad 10,000 mAh", "Carga inalámbrica rápida 15W", "Pantalla LED de porcentaje digital", "Compatible con iPhone y Android"]
    },
    {
        id: 7,
        title: "VisionStream 4K Pro Webcam",
        category: "accessories",
        price: 119.99,
        oldPrice: 149.99,
        badge: "new",
        badgeText: "NUEVO",
        rating: 4.8,
        reviews: 41,
        emoji: "📷",
        shortDesc: "Sensor Sony STARVIS 4K a 60fps con enfoque por IA y micrófonos duales con cancelación de ruido.",
        specs: ["Resolución 4K Ultra HD", "HDR dinámico en tiempo real", "Tapa física de privacidad", "Conector USB-C Plug & Play"]
    },
    {
        id: 8,
        title: "NeoPad RGB Charging Deskmat",
        category: "accessories",
        price: 39.99,
        oldPrice: null,
        badge: null,
        badgeText: "",
        rating: 4.7,
        reviews: 76,
        emoji: "⚡",
        shortDesc: "Alfombrilla gamer XXL con superficie de microfibra de baja fricción y módulo de carga inalámbrica.",
        specs: ["Dimensiones 900 x 400 x 4 mm", "Carga Qi de 15W integrada", "14 modos de iluminación RGB", "Base de goma antideslizante"]
    }
];

const PRODUCTS_DATA = (typeof window !== 'undefined' && window.LARAVEL_PRODUCTS && window.LARAVEL_PRODUCTS.length > 0)
    ? window.LARAVEL_PRODUCTS.map(p => ({
        id: p.id,
        title: p.title,
        category: p.category ? (p.category.slug || p.category) : 'accessories',
        price: parseFloat(p.price),
        oldPrice: p.old_price ? parseFloat(p.old_price) : null,
        badge: p.badge,
        badgeText: p.badge_text || '',
        rating: parseFloat(p.rating || 5),
        reviews: p.reviews_count || 0,
        emoji: p.emoji || '📦',
        shortDesc: p.short_desc,
        specs: Array.isArray(p.specs) ? p.specs : []
    }))
    : DEFAULT_PRODUCTS;

// --- Estado Global de la Tienda ---
let cart = JSON.parse(localStorage.getItem('nexustech_cart')) || [];
let wishlist = JSON.parse(localStorage.getItem('nexustech_wishlist')) || [];
let activeCategory = 'all';
let searchQuery = '';
let currentSort = 'featured';
let appliedCoupon = null; // { code: 'DWIU3', discountPercent: 15 }

// --- Inicialización Principal ---
document.addEventListener('DOMContentLoaded', () => {
    initTheme();
    initMobileNav();
    initCatalog();
    initCartDrawer();
    initWishlist();
    initSearch();
    initCountdownTimer();
    initCheckoutModal();
    initQuickViewModal();
    initContactForm();
    updateCartUI();
    updateWishlistUI();
});

/* ==========================================================================
   1. Tema Claro / Oscuro con LocalStorage
   ========================================================================== */
function initTheme() {
    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const currentTheme = localStorage.getItem('nexus_theme') || 'dark';

    setTheme(currentTheme);

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            const activeTheme = document.documentElement.getAttribute('data-theme');
            const nextTheme = activeTheme === 'dark' ? 'light' : 'dark';
            setTheme(nextTheme);
            showToast(`Modo ${nextTheme === 'dark' ? 'Oscuro' : 'Claro'} activado`, 'info');
        });
    }

    function setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('nexus_theme', theme);
        if (themeIcon) {
            themeIcon.textContent = theme === 'dark' ? '🌙' : '☀️';
        }
    }
}

/* ==========================================================================
   2. Menú Móvil
   ========================================================================== */
function initMobileNav() {
    const mobileBtn = document.getElementById('mobile-toggle');
    const navMenu = document.getElementById('nav-menu');
    const navLinks = document.querySelectorAll('.nav-link');

    if (!mobileBtn || !navMenu) return;

    mobileBtn.addEventListener('click', () => {
        const isOpen = navMenu.classList.toggle('active');
        mobileBtn.setAttribute('aria-expanded', isOpen);
    });

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                mobileBtn.setAttribute('aria-expanded', 'false');
            }
        });
    });
}

/* ==========================================================================
   3. Catálogo de Productos (Renderizado, Filtrado y Orden)
   ========================================================================== */
function initCatalog() {
    renderProducts();

    // Filtros de categoría rápida
    const categoryBtns = document.querySelectorAll('.category-pill-btn');
    categoryBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            categoryBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            activeCategory = btn.getAttribute('data-category');
            renderProducts();
        });
    });

    // Ordenamiento
    const sortSelect = document.getElementById('sort-select');
    if (sortSelect) {
        sortSelect.addEventListener('change', (e) => {
            currentSort = e.target.value;
            renderProducts();
        });
    }

    // Botón de restablecer búsqueda
    const resetSearchBtn = document.getElementById('reset-search-btn');
    if (resetSearchBtn) {
        resetSearchBtn.addEventListener('click', () => {
            const searchInput = document.getElementById('catalog-search');
            if (searchInput) searchInput.value = '';
            searchQuery = '';
            document.getElementById('clear-search').style.display = 'none';
            renderProducts();
        });
    }
}

function filterByCategory(cat) {
    activeCategory = cat;
    const categoryBtns = document.querySelectorAll('.category-pill-btn');
    categoryBtns.forEach(btn => {
        btn.classList.toggle('active', btn.getAttribute('data-category') === cat);
    });
    renderProducts();
    const catalogSection = document.getElementById('catalogo');
    if (catalogSection) {
        catalogSection.scrollIntoView({ behavior: 'smooth' });
    }
}

function renderProducts() {
    const grid = document.getElementById('products-grid');
    const noResults = document.getElementById('no-results');
    if (!grid) return;

    // 1. Filtrar por categoría
    let filtered = PRODUCTS_DATA.filter(item => {
        if (activeCategory === 'all') return true;
        return item.category === activeCategory;
    });

    // 2. Filtrar por búsqueda
    if (searchQuery.trim() !== '') {
        const q = searchQuery.toLowerCase().trim();
        filtered = filtered.filter(item => 
            item.title.toLowerCase().includes(q) || 
            item.shortDesc.toLowerCase().includes(q) ||
            item.category.toLowerCase().includes(q)
        );
    }

    // 3. Ordenar
    if (currentSort === 'price-asc') {
        filtered.sort((a, b) => a.price - b.price);
    } else if (currentSort === 'price-desc') {
        filtered.sort((a, b) => b.price - a.price);
    } else if (currentSort === 'rating') {
        filtered.sort((a, b) => b.rating - a.rating);
    }

    // Comprobar si hay resultados
    if (filtered.length === 0) {
        grid.innerHTML = '';
        if (noResults) noResults.style.display = 'block';
        return;
    }

    if (noResults) noResults.style.display = 'none';

    // Generar HTML de tarjetas
    grid.innerHTML = filtered.map(prod => {
        const isFav = wishlist.includes(prod.id);
        const badgeHTML = prod.badge ? `
            <div class="product-badge-group">
                <span class="product-badge badge-${prod.badge}">${prod.badgeText}</span>
            </div>
        ` : '';

        const oldPriceHTML = prod.oldPrice ? `<span class="old-price">$${prod.oldPrice.toFixed(2)}</span>` : '';

        return `
            <article class="product-card" data-id="${prod.id}">
                ${badgeHTML}
                <button class="wishlist-btn-card ${isFav ? 'active' : ''}" onclick="toggleWishlist(${prod.id})" aria-label="Añadir a favoritos">
                    ${isFav ? '❤️' : '🤍'}
                </button>

                <div class="product-visual-box">
                    <span class="product-emoji">${prod.emoji}</span>
                    <button class="quick-view-btn" onclick="openQuickView(${prod.id})">Vista Rápida 👁️</button>
                </div>

                <div class="product-info">
                    <span class="product-category">${prod.category}</span>
                    <h3 class="product-title">${prod.title}</h3>
                    <div class="product-rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-count">${prod.rating} (${prod.reviews})</span>
                    </div>
                    <p style="font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 1rem; line-height: 1.5;">${prod.shortDesc}</p>
                    <div class="product-pricing">
                        <span class="current-price">$${prod.price.toFixed(2)} USD</span>
                        ${oldPriceHTML}
                    </div>
                    <button class="btn btn-primary add-cart-btn" onclick="addToCart(${prod.id})">
                        <span>Añadir al Carrito</span>
                        <span>🛒</span>
                    </button>
                </div>
            </article>
        `;
    }).join('');
}

/* ==========================================================================
   4. Búsqueda Rápida en Tiempo Real
   ========================================================================== */
function initSearch() {
    const searchInput = document.getElementById('catalog-search');
    const clearBtn = document.getElementById('clear-search');

    if (!searchInput) return;

    searchInput.addEventListener('input', (e) => {
        searchQuery = e.target.value;
        if (clearBtn) {
            clearBtn.style.display = searchQuery ? 'block' : 'none';
        }
        renderProducts();
    });

    if (clearBtn) {
        clearBtn.addEventListener('click', () => {
            searchInput.value = '';
            searchQuery = '';
            clearBtn.style.display = 'none';
            renderProducts();
        });
    }
}

/* ==========================================================================
   5. Carrito de Compras (Gestión y Drawer Lateral)
   ========================================================================== */
function initCartDrawer() {
    const cartToggleBtn = document.getElementById('cart-toggle-btn');
    const drawerOverlay = document.getElementById('cart-drawer-overlay');
    const drawerCloseBtn = document.getElementById('cart-drawer-close');
    const clearCartBtn = document.getElementById('clear-cart-btn');
    const applyCouponBtn = document.getElementById('apply-coupon-btn');
    const openCheckoutBtn = document.getElementById('open-checkout-btn');
    const addBundleBtn = document.getElementById('add-bundle-btn');

    if (cartToggleBtn && drawerOverlay) {
        cartToggleBtn.addEventListener('click', () => openCartDrawer());
    }

    if (drawerCloseBtn) {
        drawerCloseBtn.addEventListener('click', () => closeCartDrawer());
    }

    if (drawerOverlay) {
        drawerOverlay.addEventListener('click', (e) => {
            if (e.target === drawerOverlay) closeCartDrawer();
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && drawerOverlay && drawerOverlay.classList.contains('active')) {
            closeCartDrawer();
        }
    });

    if (clearCartBtn) {
        clearCartBtn.addEventListener('click', () => {
            if (cart.length === 0) return;
            cart = [];
            saveCart();
            updateCartUI();
            showToast('El carrito ha sido vaciado', 'info');
        });
    }

    if (applyCouponBtn) {
        applyCouponBtn.addEventListener('click', handleCouponApply);
    }

    if (openCheckoutBtn) {
        openCheckoutBtn.addEventListener('click', () => {
            if (cart.length === 0) {
                showToast('Tu carrito está vacío. Agrega un producto primero.', 'error');
                return;
            }
            closeCartDrawer();
            openCheckoutModal();
        });
    }

    // Botón para agregar bundle especial de la sección de oferta flash
    if (addBundleBtn) {
        addBundleBtn.addEventListener('click', () => {
            // Agrega Auriculares (ID 1) y Teclado (ID 3)
            addToCart(1, 1, false);
            addToCart(3, 1, false);
            updateCartUI();
            openCartDrawer();
            showToast('¡Combo CyberGamer Pro añadido al carrito con precio especial!', 'success');
        });
    }
}

function openCartDrawer() {
    const drawerOverlay = document.getElementById('cart-drawer-overlay');
    if (drawerOverlay) {
        drawerOverlay.classList.add('active');
        drawerOverlay.setAttribute('aria-hidden', 'false');
    }
}

function closeCartDrawer() {
    const drawerOverlay = document.getElementById('cart-drawer-overlay');
    if (drawerOverlay) {
        drawerOverlay.classList.remove('active');
        drawerOverlay.setAttribute('aria-hidden', 'true');
    }
}

function addToCart(productId, qty = 1, showFeedback = true) {
    const existing = cart.find(item => item.id === productId);
    if (existing) {
        existing.qty += qty;
    } else {
        cart.push({ id: productId, qty: qty });
    }

    saveCart();
    updateCartUI();

    if (showFeedback) {
        const prod = PRODUCTS_DATA.find(p => p.id === productId);
        showToast(`"${prod ? prod.title : 'Producto'}" agregado al carrito 🛒`, 'success');
        openCartDrawer();
    }
}

function updateCartQty(productId, delta) {
    const item = cart.find(i => i.id === productId);
    if (!item) return;

    item.qty += delta;
    if (item.qty <= 0) {
        cart = cart.filter(i => i.id !== productId);
    }

    saveCart();
    updateCartUI();
}

function removeFromCart(productId) {
    cart = cart.filter(i => i.id !== productId);
    saveCart();
    updateCartUI();
    showToast('Producto eliminado del carrito', 'info');
}

function saveCart() {
    localStorage.setItem('nexustech_cart', JSON.stringify(cart));
}

function updateCartUI() {
    const cartItemsContainer = document.getElementById('cart-items-container');
    const cartCountBadge = document.getElementById('cart-count');
    const cartNavTotal = document.getElementById('cart-nav-total');
    const cartDrawerBadge = document.getElementById('cart-drawer-badge');
    
    const cartSubtotalEl = document.getElementById('cart-subtotal');
    const cartDiscountRow = document.getElementById('cart-discount-row');
    const discountPctEl = document.getElementById('discount-pct');
    const cartDiscountEl = document.getElementById('cart-discount');
    const cartShippingEl = document.getElementById('cart-shipping');
    const cartTotalUsdEl = document.getElementById('cart-total-usd');
    const cartTotalMxnEl = document.getElementById('cart-total-mxn');

    // Cantidad total de artículos
    const totalItems = cart.reduce((acc, curr) => acc + curr.qty, 0);
    if (cartCountBadge) cartCountBadge.textContent = totalItems;
    if (cartDrawerBadge) cartDrawerBadge.textContent = `${totalItems} item${totalItems === 1 ? '' : 's'}`;

    // Subtotal
    let subtotal = 0;
    cart.forEach(item => {
        const prod = PRODUCTS_DATA.find(p => p.id === item.id);
        if (prod) {
            subtotal += prod.price * item.qty;
        }
    });

    // Descuento
    let discount = 0;
    if (appliedCoupon) {
        discount = subtotal * (appliedCoupon.discountPercent / 100);
        if (cartDiscountRow) {
            cartDiscountRow.style.display = 'flex';
            if (discountPctEl) discountPctEl.textContent = `${appliedCoupon.discountPercent}%`;
            if (cartDiscountEl) cartDiscountEl.textContent = `-$${discount.toFixed(2)} USD`;
        }
    } else {
        if (cartDiscountRow) cartDiscountRow.style.display = 'none';
    }

    // Costo de Envío: Gratis si subtotal > $50 o si el carrito está vacío
    let shipping = 0;
    if (subtotal > 0) {
        shipping = subtotal >= 50 ? 0 : 9.99;
    }

    if (cartShippingEl) {
        if (subtotal === 0) {
            cartShippingEl.textContent = '$0.00 USD';
        } else if (shipping === 0) {
            cartShippingEl.innerHTML = '<span style="color: var(--success); font-weight: bold;">GRATIS</span>';
        } else {
            cartShippingEl.textContent = `$${shipping.toFixed(2)} USD`;
        }
    }

    // Total final
    const finalTotal = Math.max(0, subtotal - discount + shipping);
    const exchangeRate = 18.0;
    const totalMxn = Math.round(finalTotal * exchangeRate);

    if (cartSubtotalEl) cartSubtotalEl.textContent = `$${subtotal.toFixed(2)} USD`;
    if (cartTotalUsdEl) cartTotalUsdEl.textContent = `$${finalTotal.toFixed(2)} USD`;
    if (cartNavTotal) cartNavTotal.textContent = `$${finalTotal.toFixed(2)}`;
    if (cartTotalMxnEl) cartTotalMxnEl.textContent = `Aprox. $${totalMxn.toLocaleString()} MXN`;

    // Renderizar lista de artículos en el drawer
    if (!cartItemsContainer) return;

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = `
            <div class="empty-cart-state">
                <span class="empty-cart-icon">🛒</span>
                <h4 class="empty-cart-title">Tu carrito está vacío</h4>
                <p class="empty-cart-text">Explora nuestro catálogo y descubre tecnología de vanguardia.</p>
                <button class="btn btn-primary btn-sm" onclick="closeCartDrawer(); document.getElementById('catalogo').scrollIntoView({behavior: 'smooth'})">
                    Explorar Productos
                </button>
            </div>
        `;
        return;
    }

    cartItemsContainer.innerHTML = cart.map(item => {
        const prod = PRODUCTS_DATA.find(p => p.id === item.id);
        if (!prod) return '';

        return `
            <div class="cart-item-row">
                <div class="cart-item-thumb">${prod.emoji}</div>
                <div class="cart-item-info">
                    <h4 class="cart-item-title">${prod.title}</h4>
                    <span class="cart-item-price">$${prod.price.toFixed(2)} USD</span>
                    <div class="cart-item-qty-controls">
                        <button class="qty-btn" onclick="updateCartQty(${prod.id}, -1)">-</button>
                        <span class="qty-count">${item.qty}</span>
                        <button class="qty-btn" onclick="updateCartQty(${prod.id}, 1)">+</button>
                    </div>
                </div>
                <button class="cart-item-remove-btn" onclick="removeFromCart(${prod.id})" aria-label="Eliminar producto" title="Eliminar">
                    🗑️
                </button>
            </div>
        `;
    }).join('');
}

function handleCouponApply() {
    const input = document.getElementById('coupon-input');
    const msg = document.getElementById('coupon-msg');
    if (!input || !msg) return;

    const code = input.value.trim().toUpperCase();

    if (code === 'DWIU3') {
        appliedCoupon = { code: 'DWIU3', discountPercent: 15 };
        msg.className = 'coupon-msg success';
        msg.textContent = '🎉 ¡Cupón del 15% aplicado con éxito!';
        showToast('Cupón "DWIU3" (15% OFF) aplicado', 'success');
    } else if (code === 'TECH10') {
        appliedCoupon = { code: 'TECH10', discountPercent: 10 };
        msg.className = 'coupon-msg success';
        msg.textContent = '🎉 ¡Cupón del 10% aplicado con éxito!';
        showToast('Cupón "TECH10" (10% OFF) aplicado', 'success');
    } else {
        msg.className = 'coupon-msg error';
        msg.textContent = '❌ Cupón inválido o expirado. Prueba con DWIU3.';
        showToast('Código de cupón no válido', 'error');
    }

    updateCartUI();
}

/* ==========================================================================
   6. Lista de Deseos (Wishlist)
   ========================================================================== */
function initWishlist() {
    const wishlistBtn = document.getElementById('wishlist-btn');
    if (wishlistBtn) {
        wishlistBtn.addEventListener('click', () => {
            if (wishlist.length === 0) {
                showToast('Aún no tienes productos en tu lista de deseos ❤️', 'info');
            } else {
                showToast(`Tienes ${wishlist.length} artículo(s) en favoritos`, 'info');
                // Filtramos temporalmente para mostrar favoritos
                const favProducts = PRODUCTS_DATA.filter(p => wishlist.includes(p.id));
                const names = favProducts.map(p => p.title).join(', ');
                alert(`Tus Favoritos:\n\n${names}`);
            }
        });
    }
}

function toggleWishlist(productId) {
    const index = wishlist.indexOf(productId);
    if (index > -1) {
        wishlist.splice(index, 1);
        showToast('Producto removido de favoritos', 'info');
    } else {
        wishlist.push(productId);
        showToast('¡Guardado en tu lista de deseos! ❤️', 'success');
    }

    localStorage.setItem('nexustech_wishlist', JSON.stringify(wishlist));
    updateWishlistUI();
    renderProducts();
}

function updateWishlistUI() {
    const wishlistCountBadge = document.getElementById('wishlist-count');
    if (wishlistCountBadge) {
        wishlistCountBadge.textContent = wishlist.length;
    }
}

/* ==========================================================================
   7. Modal de Vista Rápida
   ========================================================================== */
function initQuickViewModal() {
    const modal = document.getElementById('quick-view-modal');
    const closeBtn = document.getElementById('modal-close');

    if (closeBtn) {
        closeBtn.addEventListener('click', closeQuickView);
    }

    if (modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeQuickView();
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal && modal.classList.contains('active')) {
            closeQuickView();
        }
    });
}

function openQuickView(productId) {
    const prod = PRODUCTS_DATA.find(p => p.id === productId);
    if (!prod) return;

    const modal = document.getElementById('quick-view-modal');
    const modalContent = document.getElementById('modal-content');

    if (modal && modalContent) {
        modalContent.innerHTML = `
            <div class="quick-view-grid">
                <div class="quick-view-visual">
                    <span>${prod.emoji}</span>
                </div>
                <div class="quick-view-details">
                    <span class="section-tag">${prod.category}</span>
                    <h2 style="font-family: var(--font-heading); font-size: 1.6rem; font-weight: 800; margin-top: 0.35rem; margin-bottom: 0.5rem;">${prod.title}</h2>
                    
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                        <span class="stars">★★★★★</span>
                        <span style="font-size: 0.85rem; color: var(--text-muted);">${prod.rating} (${prod.reviews} reseñas de clientes)</span>
                    </div>

                    <p style="color: var(--text-secondary); font-size: 0.95rem; margin-bottom: 1.25rem; line-height: 1.6;">${prod.shortDesc}</p>

                    <h4 style="font-size: 0.9rem; font-weight: 700; margin-bottom: 0.5rem;">Especificaciones Técnicas:</h4>
                    <ul style="display: flex; flex-direction: column; gap: 0.4rem; color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 1.5rem;">
                        ${prod.specs.map(s => `<li style="display: flex; gap: 0.4rem;"><span>⚡</span> ${s}</li>`).join('')}
                    </ul>

                    <div style="display: flex; align-items: baseline; gap: 0.75rem; margin-bottom: 1.5rem;">
                        <span style="font-family: var(--font-heading); font-size: 1.75rem; font-weight: 800; color: var(--secondary);">$${prod.price.toFixed(2)} USD</span>
                        ${prod.oldPrice ? `<span style="text-decoration: line-through; color: var(--text-muted);">$${prod.oldPrice.toFixed(2)}</span>` : ''}
                    </div>

                    <div style="display: flex; gap: 0.75rem;">
                        <button class="btn btn-primary btn-block" onclick="addToCart(${prod.id}); closeQuickView();">
                            <span>Añadir al Carrito</span>
                            <span>🛒</span>
                        </button>
                    </div>
                </div>
            </div>
        `;

        modal.classList.add('active');
        modal.setAttribute('aria-hidden', 'false');
    }
}

function closeQuickView() {
    const modal = document.getElementById('quick-view-modal');
    if (modal) {
        modal.classList.remove('active');
        modal.setAttribute('aria-hidden', 'true');
    }
}

/* ==========================================================================
   8. Modal de Checkout y Simulación de Pago
   ========================================================================== */
function initCheckoutModal() {
    const modal = document.getElementById('checkout-modal');
    const closeBtn = document.getElementById('checkout-close');
    const checkoutForm = document.getElementById('checkout-form');

    if (closeBtn) {
        closeBtn.addEventListener('click', closeCheckoutModal);
    }

    if (modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeCheckoutModal();
        });
    }

    if (checkoutForm) {
        checkoutForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const submitBtn = document.getElementById('confirm-order-btn');
            const originalText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span>Procesando pago seguro... ⏳</span>';

            setTimeout(() => {
                const orderId = 'ORD-' + Math.floor(100000 + Math.random() * 900000);
                showToast(`¡Pedido ${orderId} confirmado con éxito! 🎉`, 'success');
                
                // Vaciar carrito
                cart = [];
                appliedCoupon = null;
                saveCart();
                updateCartUI();

                closeCheckoutModal();
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
                checkoutForm.reset();

                // Notificación adicional con número de seguimiento
                setTimeout(() => {
                    alert(`✅ ¡Gracias por tu compra en NexusTech!\n\nTu número de orden es: ${orderId}\nHemos enviado el comprobante digital y la guía de rastreo a tu correo electrónico.`);
                }, 400);
            }, 1500);
        });
    }
}

function openCheckoutModal() {
    const modal = document.getElementById('checkout-modal');
    const summaryBox = document.getElementById('checkout-summary-box');
    const payTotalBtn = document.getElementById('checkout-pay-total');

    if (!modal) return;

    let subtotal = 0;
    const itemsList = cart.map(item => {
        const prod = PRODUCTS_DATA.find(p => p.id === item.id);
        if (!prod) return '';
        const itemTotal = prod.price * item.qty;
        subtotal += itemTotal;
        return `<div style="display: flex; justify-content: space-between; font-size: 0.85rem; margin-bottom: 0.35rem;">
            <span>${item.qty}x ${prod.title}</span>
            <span style="font-weight: 600;">$${itemTotal.toFixed(2)} USD</span>
        </div>`;
    }).join('');

    let discount = appliedCoupon ? subtotal * (appliedCoupon.discountPercent / 100) : 0;
    let shipping = subtotal >= 50 ? 0 : 9.99;
    let total = Math.max(0, subtotal - discount + shipping);

    if (summaryBox) {
        summaryBox.innerHTML = `
            <h5 style="font-size: 0.9rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--text-primary);">Resumen del Pedido:</h5>
            ${itemsList}
            <div style="height: 1px; background: var(--border-color); margin-block: 0.5rem;"></div>
            ${appliedCoupon ? `<div style="display:flex; justify-content:space-between; font-size:0.85rem; color:var(--success);"><span>Descuento (${appliedCoupon.code}):</span><span>-$${discount.toFixed(2)}</span></div>` : ''}
            <div style="display:flex; justify-content:space-between; font-size:0.85rem; color:var(--text-secondary);"><span>Envío:</span><span>${shipping === 0 ? 'GRATIS' : '$' + shipping.toFixed(2)}</span></div>
            <div style="display:flex; justify-content:space-between; font-size:1rem; font-weight:800; color:var(--secondary); margin-top:0.4rem;"><span>Total Final:</span><span>$${total.toFixed(2)} USD</span></div>
        `;
    }

    if (payTotalBtn) {
        payTotalBtn.textContent = `$${total.toFixed(2)} USD`;
    }

    modal.classList.add('active');
    modal.setAttribute('aria-hidden', 'false');
}

function closeCheckoutModal() {
    const modal = document.getElementById('checkout-modal');
    if (modal) {
        modal.classList.remove('active');
        modal.setAttribute('aria-hidden', 'true');
    }
}

/* ==========================================================================
   9. Temporizador de Oferta Relámpago (Flash Sale)
   ========================================================================== */
function initCountdownTimer() {
    let totalSeconds = 12 * 3600 + 45 * 60 + 30; // 12h 45m 30s

    const hoursEl = document.getElementById('countdown-hours');
    const minutesEl = document.getElementById('countdown-minutes');
    const secondsEl = document.getElementById('countdown-seconds');

    if (!hoursEl || !minutesEl || !secondsEl) return;

    setInterval(() => {
        if (totalSeconds > 0) {
            totalSeconds--;
            const h = Math.floor(totalSeconds / 3600);
            const m = Math.floor((totalSeconds % 3600) / 60);
            const s = totalSeconds % 60;

            hoursEl.textContent = String(h).padStart(2, '0');
            minutesEl.textContent = String(m).padStart(2, '0');
            secondsEl.textContent = String(s).padStart(2, '0');
        }
    }, 1000);
}

/* ==========================================================================
   10. Formulario de Soporte / Contacto
   ========================================================================== */
function initContactForm() {
    const form = document.getElementById('contact-form');
    if (!form) return;

    const nameInput = document.getElementById('form-name');
    const emailInput = document.getElementById('form-email');
    const msgInput = document.getElementById('form-message');

    const nameError = document.getElementById('name-error');
    const emailError = document.getElementById('email-error');
    const msgError = document.getElementById('message-error');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        let valid = true;

        nameError.textContent = '';
        emailError.textContent = '';
        msgError.textContent = '';

        if (!nameInput.value.trim()) {
            nameError.textContent = 'Por favor ingresa tu nombre.';
            valid = false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailInput.value.trim() || !emailRegex.test(emailInput.value.trim())) {
            emailError.textContent = 'Ingresa un correo electrónico válido.';
            valid = false;
        }

        if (!msgInput.value.trim() || msgInput.value.trim().length < 8) {
            msgError.textContent = 'El mensaje debe tener al menos 8 caracteres.';
            valid = false;
        }

        if (valid) {
            const btn = document.getElementById('form-submit-btn');
            const originalText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span>Enviando mensaje...</span>';

            setTimeout(() => {
                showToast('¡Consulta enviada! Nos comunicaremos contigo pronto.', 'success');
                form.reset();
                btn.disabled = false;
                btn.innerHTML = originalText;
            }, 800);
        }
    });
}

/* ==========================================================================
   11. Sistema de Notificaciones Toast
   ========================================================================== */
function showToast(message, type = 'info') {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;

    let icon = 'ℹ️';
    if (type === 'success') icon = '✅';
    if (type === 'error') icon = '⚠️';

    toast.innerHTML = `
        <span style="font-size: 1.2rem;">${icon}</span>
        <span style="font-size: 0.9rem; font-weight: 500;">${message}</span>
    `;

    container.appendChild(toast);

    setTimeout(() => {
        toast.style.animation = 'toastSlideOut 0.35s ease forwards';
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 350);
    }, 3200);
}

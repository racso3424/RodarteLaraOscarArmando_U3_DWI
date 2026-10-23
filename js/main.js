/**
 * NexusCraft Studio - Interactivity & Logic
 * Desarrollo Web Integral (DWI) - Unidad 3
 * Alumno: Oscar Armando Rodarte Lara
 */

document.addEventListener('DOMContentLoaded', () => {
    // Inicialización de todos los módulos
    initTheme();
    initMobileNav();
    initScrollSpy();
    initStatsCounter();
    initPortfolioFilter();
    initCalculator();
    initContactForm();
    initModal();
});

/* ==========================================================================
   1. Tema Claro / Oscuro con LocalStorage
   ========================================================================== */
function initTheme() {
    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const currentTheme = localStorage.getItem('nexus_theme') || 'dark';

    setTheme(currentTheme);

    themeToggleBtn.addEventListener('click', () => {
        const activeTheme = document.documentElement.getAttribute('data-theme');
        const nextTheme = activeTheme === 'dark' ? 'light' : 'dark';
        setTheme(nextTheme);
        showToast(`Modo ${nextTheme === 'dark' ? 'Oscuro' : 'Claro'} activado`, 'info');
    });

    function setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('nexus_theme', theme);
        if (themeIcon) {
            themeIcon.textContent = theme === 'dark' ? '🌙' : '☀️';
        }
    }
}

/* ==========================================================================
   2. Navegación Móvil (Menú Hamburguesa)
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

    // Cerrar el menú al hacer clic en un enlace de navegación
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
   3. Scroll Spy & Barra de Navegación Sticky
   ========================================================================== */
function initScrollSpy() {
    const navbar = document.getElementById('navbar');
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    window.addEventListener('scroll', () => {
        const scrollY = window.pageYOffset;

        // Efecto visual en la barra al hacer scroll
        if (scrollY > 50) {
            navbar.style.boxShadow = 'var(--shadow-md)';
        } else {
            navbar.style.boxShadow = 'none';
        }

        // Detección de sección activa
        sections.forEach(section => {
            const sectionHeight = section.offsetHeight;
            const sectionTop = section.offsetTop - 120;
            const sectionId = section.getAttribute('id');

            if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${sectionId}`) {
                        link.classList.add('active');
                    }
                });
            }
        });
    });
}

/* ==========================================================================
   4. Animación de Contadores de Estadísticas
   ========================================================================== */
function initStatsCounter() {
    const statNumbers = document.querySelectorAll('.stat-number');
    let hasAnimated = false;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !hasAnimated) {
                hasAnimated = true;
                statNumbers.forEach(stat => {
                    const target = parseInt(stat.getAttribute('data-target'), 10);
                    animateCounter(stat, target);
                });
            }
        });
    }, { threshold: 0.5 });

    const statsContainer = document.querySelector('.hero-stats');
    if (statsContainer) {
        observer.observe(statsContainer);
    }

    function animateCounter(element, target) {
        let current = 0;
        const duration = 1500;
        const increment = target / (duration / 25);

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.ceil(current);
            }
        }, 25);
    }
}

/* ==========================================================================
   5. Filtrado Dinámico de Proyectos (Portafolio)
   ========================================================================== */
function initPortfolioFilter() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filterValue = btn.getAttribute('data-filter');

            projectCards.forEach(card => {
                const category = card.getAttribute('data-category');
                if (filterValue === 'all' || category === filterValue) {
                    card.style.display = 'flex';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 50);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(10px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 250);
                }
            });
        });
    });
}

/* ==========================================================================
   6. Cotizador Interactivo de Presupuestos
   ========================================================================== */
function initCalculator() {
    const projectTypeSelect = document.getElementById('project-type');
    const featureCheckboxes = document.querySelectorAll('.feature-checkbox');
    const urgencyRange = document.getElementById('urgency-range');
    const urgencyDisplay = document.getElementById('urgency-display');
    
    // Elementos de resumen
    const summaryBasePrice = document.getElementById('summary-base-price');
    const summaryExtrasPrice = document.getElementById('summary-extras-price');
    const summaryTime = document.getElementById('summary-time');
    const totalPriceEl = document.getElementById('total-price');
    const totalMxnEl = document.getElementById('total-mxn');
    const applyQuoteBtn = document.getElementById('apply-quote-btn');

    if (!projectTypeSelect || !urgencyRange) return;

    function calculate() {
        // 1. Precio base y tiempo
        const selectedOption = projectTypeSelect.options[projectTypeSelect.selectedIndex];
        const basePrice = parseInt(selectedOption.getAttribute('data-base'), 10);
        const baseWeeks = parseInt(selectedOption.getAttribute('data-time'), 10);

        // 2. Extras seleccionados
        let extrasTotal = 0;
        featureCheckboxes.forEach(cb => {
            if (cb.checked) {
                extrasTotal += parseInt(cb.value, 10);
            }
        });

        // 3. Multiplicador de urgencia
        const urgencyVal = parseInt(urgencyRange.value, 10);
        let multiplier = 1;
        let urgencyText = 'Estándar';
        let weeksText = `${baseWeeks} a ${baseWeeks + 1} Semanas`;

        if (urgencyVal === 1) {
            multiplier = 0.90; // 10% descuento
            urgencyText = 'Flexible (-10% dto.)';
            weeksText = `${baseWeeks + 1} a ${baseWeeks + 2} Semanas`;
        } else if (urgencyVal === 2) {
            multiplier = 1.0;
            urgencyText = 'Estándar (Recomendado)';
            weeksText = `${baseWeeks} a ${baseWeeks + 1} Semanas`;
        } else if (urgencyVal === 3) {
            multiplier = 1.25; // 25% extra
            urgencyText = 'Express (+25% prioridad)';
            weeksText = `${Math.max(1, Math.round(baseWeeks * 0.6))} Semanas`;
        }

        urgencyDisplay.textContent = urgencyText;

        // Cálculos finales
        const subtotal = basePrice + extrasTotal;
        const totalUsd = Math.round(subtotal * multiplier);
        const exchangeRate = 18.0; // Tasa estimada USD/MXN
        const totalMxn = Math.round(totalUsd * exchangeRate);

        // Actualizar UI
        summaryBasePrice.textContent = `$${basePrice} USD`;
        summaryExtrasPrice.textContent = `$${extrasTotal} USD`;
        summaryTime.textContent = weeksText;
        totalPriceEl.textContent = `$${totalUsd.toLocaleString()} USD`;
        totalMxnEl.textContent = `$${totalMxn.toLocaleString()} MXN`;
    }

    // Event listeners para cambios reactivos
    projectTypeSelect.addEventListener('change', calculate);
    featureCheckboxes.forEach(cb => cb.addEventListener('change', calculate));
    urgencyRange.addEventListener('input', calculate);

    // Botón de transferir cotización al formulario de contacto
    applyQuoteBtn.addEventListener('click', () => {
        const serviceSelect = document.getElementById('form-service');
        const messageTextarea = document.getElementById('form-message');
        const contactSection = document.getElementById('contacto');

        if (serviceSelect) {
            serviceSelect.value = projectTypeSelect.value;
        }

        const selectedOption = projectTypeSelect.options[projectTypeSelect.selectedIndex].text;
        const total = totalPriceEl.textContent;

        if (messageTextarea) {
            messageTextarea.value = `Hola, me interesa una cotización estimada de ${total} para el servicio de: ${selectedOption}.`;
        }

        if (contactSection) {
            contactSection.scrollIntoView({ behavior: 'smooth' });
            showToast('Cotización precargada en el formulario de contacto', 'success');
        }
    });

    // Calcular valores iniciales
    calculate();
}

/* ==========================================================================
   7. Formulario de Contacto y Validación
   ========================================================================== */
function initContactForm() {
    const form = document.getElementById('contact-form');
    if (!form) return;

    const nameInput = document.getElementById('form-name');
    const emailInput = document.getElementById('form-email');
    const messageInput = document.getElementById('form-message');

    const nameError = document.getElementById('name-error');
    const emailError = document.getElementById('email-error');
    const messageError = document.getElementById('message-error');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        let isValid = true;

        // Limpiar errores previos
        nameError.textContent = '';
        emailError.textContent = '';
        messageError.textContent = '';

        // Validar Nombre
        if (!nameInput.value.trim()) {
            nameError.textContent = 'Por favor ingresa tu nombre completo.';
            isValid = false;
        } else if (nameInput.value.trim().length < 3) {
            nameError.textContent = 'El nombre debe tener al menos 3 caracteres.';
            isValid = false;
        }

        // Validar Email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailInput.value.trim()) {
            emailError.textContent = 'Por favor ingresa tu correo electrónico.';
            isValid = false;
        } else if (!emailRegex.test(emailInput.value.trim())) {
            emailError.textContent = 'Ingresa un correo electrónico válido.';
            isValid = false;
        }

        // Validar Mensaje
        if (!messageInput.value.trim()) {
            messageError.textContent = 'Por favor describe brevemente tu proyecto.';
            isValid = false;
        } else if (messageInput.value.trim().length < 10) {
            messageError.textContent = 'El mensaje debe tener al menos 10 caracteres.';
            isValid = false;
        }

        if (isValid) {
            const submitBtn = document.getElementById('form-submit-btn');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span>Enviando propuesta...</span>';

            setTimeout(() => {
                showToast('¡Gracias! Tu mensaje ha sido enviado exitosamente.', 'success');
                form.reset();
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }, 1000);
        }
    });
}

/* ==========================================================================
   8. Sistema de Modal para Proyectos
   ========================================================================== */
const projectDetailsData = {
    1: {
        title: 'NovaCloud Platform',
        category: 'SaaS & Dashboards',
        description: 'Plataforma completa de analítica en la nube con paneles personalizables, arquitectura desacoplada para microfrontends y visualización en tiempo real.',
        techs: ['HTML5 Semántico', 'CSS Grid & Flexbox', 'JavaScript ES6+', 'Chart.js', 'REST APIs'],
        features: [
            'Soporte nativo para modo oscuro/claro',
            'Carga asíncrona de datos mediante Fetch API',
            'Exportación de reportes a PDF y CSV',
            'Diseño responsivo optimizado para tablets y móviles'
        ]
    },
    2: {
        title: 'AuraStore Boutique',
        category: 'E-commerce',
        description: 'Tienda en línea de productos de lujo que prioriza la velocidad de carga, experiencia de usuario fluida y persistencia de carrito de compras.',
        techs: ['Vanilla JavaScript', 'LocalStorage API', 'CSS Variables', 'Micro-animaciones'],
        features: [
            'Filtros dinámicos sin recarga de página',
            'Persistencia del estado del carrito en el navegador',
            'Validación en tiempo real del formulario de compra',
            'Imágenes optimizadas en formatos WebP y AVIF'
        ]
    },
    3: {
        title: 'ApexPulse Health Tracker',
        category: 'Web Apps',
        description: 'Aplicación web progresiva orientada a la salud y bienestar físico, permitiendo registrar entrenamientos y metas diarias.',
        techs: ['JavaScript ES6+', 'SVG Graphics', 'CSS Grid', 'PWA Manifest'],
        features: [
            'Cálculo dinámico de estadísticas y promedios semanales',
            'Gráficos interactivos vectoriales en SVG',
            'Notificaciones en pantalla tipo toast',
            'Interfaz accesible bajo estándares WCAG 2.1'
        ]
    },
    4: {
        title: 'EcoLogix Supply',
        category: 'Landing Pages',
        description: 'Landing page corporativa para empresa de consultoría sostenible, alcanzando puntajes de 100/100 en Google Lighthouse.',
        techs: ['HTML5 Semántico', 'CSS Moderno', 'SEO Técnico', 'Open Graph'],
        features: [
            'Puntaje perfecto en Core Web Vitals',
            'Estructura de encabezados H1-H6 estrictamente jerárquica',
            'Formulario con validación interactiva del lado del cliente',
            'Animaciones sutiles sin penalización de rendimiento'
        ]
    },
    5: {
        title: 'CryptoSphere Terminal',
        category: 'SaaS & Dashboards',
        description: 'Terminal web minimalista para seguimiento de cotizaciones y conversor multimoneda en vivo.',
        techs: ['Fetch API', 'CSS Glassmorphism', 'Flexbox', 'Async/Await'],
        features: [
            'Actualización periódica de precios vía API',
            'Calculadora interactiva de conversión de divisas',
            'Diseño futurista con efectos de cristal (backdrop-filter)'
        ]
    },
    6: {
        title: 'TaskFlow Agile Kanban',
        category: 'Web Apps',
        description: 'Tablero interactivo para gestión ágil de proyectos con columnas Por Hacer, En Proceso y Terminado.',
        techs: ['HTML5 Drag & Drop API', 'JavaScript ES6+', 'CSS Modularity'],
        features: [
            'Arrastrar y soltar elementos de forma nativa',
            'Filtrado instantáneo por etiquetas de prioridad',
            'Creación rápida de tarjetas de tareas'
        ]
    }
};

function initModal() {
    const modal = document.getElementById('project-modal');
    const modalContent = document.getElementById('modal-content');
    const modalCloseBtn = document.getElementById('modal-close');
    const openModalBtns = document.querySelectorAll('.open-modal-btn');

    if (!modal || !modalContent) return;

    openModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const projectId = btn.getAttribute('data-id');
            const data = projectDetailsData[projectId];

            if (data) {
                modalContent.innerHTML = `
                    <div style="margin-bottom: 1.25rem;">
                        <span class="section-tag">${data.category}</span>
                        <h2 style="font-family: var(--font-heading); font-size: 1.85rem; margin-top: 0.5rem;">${data.title}</h2>
                    </div>
                    <p style="color: var(--text-secondary); margin-bottom: 1.5rem; line-height: 1.7;">${data.description}</p>
                    
                    <h4 style="font-size: 1rem; margin-bottom: 0.75rem;">Tecnologías Empleadas:</h4>
                    <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1.5rem;">
                        ${data.techs.map(t => `<span class="tag" style="background: var(--bg-surface-elevated); padding: 0.35rem 0.75rem;">${t}</span>`).join('')}
                    </div>

                    <h4 style="font-size: 1rem; margin-bottom: 0.75rem;">Funcionalidades Destacadas:</h4>
                    <ul style="display: flex; flex-direction: column; gap: 0.5rem; color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 2rem;">
                        ${data.features.map(f => `<li style="display: flex; gap: 0.5rem;"><span>⚡</span> ${f}</li>`).join('')}
                    </ul>

                    <div style="display: flex; gap: 1rem;">
                        <button class="btn btn-primary btn-sm" onclick="closeProjectModal()">Cerrar Ventana</button>
                    </div>
                `;

                modal.classList.add('active');
                modal.setAttribute('aria-hidden', 'false');
            }
        });
    });

    if (modalCloseBtn) {
        modalCloseBtn.addEventListener('click', closeProjectModal);
    }

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeProjectModal();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeProjectModal();
        }
    });
}

function closeProjectModal() {
    const modal = document.getElementById('project-modal');
    if (modal) {
        modal.classList.remove('active');
        modal.setAttribute('aria-hidden', 'true');
    }
}

/* ==========================================================================
   9. Sistema de Notificaciones Toast
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
    }, 3500);
}
